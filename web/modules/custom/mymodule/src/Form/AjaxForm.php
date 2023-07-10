<?php 

/**
 * @file
 * Contains Drupal\mymodule\Form\MyModuleSettingsForm.  
 */
namespace Drupal\mymodule\Form;

use Drupal\Core\Form\FormBase;  
use Drupal\Core\Form\FormStateInterface; 
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Database\Database;

class AjaxForm extends FormBase { 

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
      return 'custom_ajax_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm($form, FormStateInterface $form_state) {

    $form['element'] = [
      '#type' => 'markup',
      '#markup' => "<div class='success'></div>",
    ];

    $form['firstname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name:'),
      '#default_value' => $form_state->getValue('firstname'),
    ];

    $form['lastname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name:'),
      '#default_value' => $form_state->getValue('lastname'),
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email ID:'),
      '#default_value' => $form_state->getValue('email'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#ajax' => [
        'callback' => '::submitData',
      ],
    ];
    
    return $form;
  }

  public function submitData(array &$form, FormStateInterface $form_state) {
    $ajax_response = new AjaxResponse();
    $connection = Database::getConnection();
    $form_val = $form_state->getValues();

    $form_data['firstname'] = $form_val['firstname'];
    $form_data['lastname'] = $form_val['lastname'];
    $form_data['email'] = $form_val['email'];

    $connection->insert('ajaxform')
      ->fields($form_data)
      ->execute();
    
    $ajax_response->addCommand(new HtmlCommand('.success', 'Form submitted successfully'));
    return $ajax_response;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(&$form, FormStateInterface $form_state) {

  }
}
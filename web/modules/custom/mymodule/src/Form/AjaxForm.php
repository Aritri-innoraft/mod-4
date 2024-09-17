<?php 

/**
 * @file
 * Contains Drupal\mymodule\Form\AjaxForm
 */
namespace Drupal\mymodule\Form;

use Drupal\Core\Form\FormBase;  
use Drupal\Core\Form\FormStateInterface; 
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

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

    $form['select_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Select an item'),
      '#options' => [
        'aritri' => $this->t('Aritri'),
        'riya' => $this->t('Riya'),
        'pratyusha' => $this->t('Pratyusha'),
      ],
      '#ajax' => [
        'callback' => '::myAjaxCallback',
        'event' => 'change',
        'wrapper' => 'edit-output',
        'progress' => [
          'type' => 'throbber',
          'message' => $this->t('Verifying entry...'),
        ],
      ],
    ];

    $form['output'] = [
      '#type' => 'textfield',
      '#disabled' => TRUE,
      '#value' => 'Hello',
      '#prefix' => '<div class="edit-output">',
      '#suffix' => '</div>',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      // '#ajax' => [
      //   'callback' => '::submitData',
      // ],
    ];
    
     
    return $form;
  }

  /**
   * Function to get the value from example select field and fill the textbox 
   * with the selected text.
   */
  public function myAjaxCallback(array &$form, FormStateInterface $form_state) {
    $ajax_res = new AjaxResponse();
    // If there's a value submitted for the select list then set the textfield value.
    if ($selectedValue = $form_state->getValue('select_field')) {
      // Get the text of the selected option.
      $selectedText = $form['select_field']['#options'][$selectedValue];
      // Place the text of the selected option in our textfield.
      // $form['output']['#value'] = $selectedText;
      $ajax_res->addCommand(new HtmlCommand('.edit-output', $selectedText));
      
    }
    // Return the prepared textfield.
    // return $form['output']; 
    return $ajax_res;
  }


  

  /**
   * {@inheritdoc}
   */
  public function submitForm(&$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
  }
}

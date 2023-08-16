<?php 

/**
 * @file
 * Contains Drupal\mymodule\Form\BlockTaskForm.  
 */
namespace Drupal\mymodule\Form;

use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface; 

/**
 * Defines a multi-step form.
 */
class BlockTaskForm extends ConfigFormBase { 

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'block_task_form';
  }

  /**
   * {@inheritDoc}
   */
  public function getEditableConfigNames() {
    return [
      'mymodule.block_form_settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['#prefix'] = "<table><tr>";
    
    $form['firstname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name:'),
      '#default_value' => $form_state->getValue('firstname'),
      '#required' => TRUE,
      '#prefix' => '<td>',
      '#suffix' => '</td>',
    ];
    
    $form['middlename'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Middle Name:'),
      '#default_value' => $form_state->getValue('middlename'),
      '#required' => TRUE,
      '#prefix' => '<td>',
      '#suffix' => '</td>',
    ];
    
    $form['lastname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name:'),
      '#default_value' => $form_state->getValue('lastname'),
      '#required' => TRUE,
      '#prefix' => '<td>',
      '#suffix' => '</td>',
    ];
    
    $form['remove'] = [
      '#type' => 'submit',
      '#value' => $this->t('Remove'),
      '#prefix' => '<td>',
      '#suffix' => '</td>',
    ];
    
    $form['add'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add'),
      '#prefix' => '<table><tr>',
      '#suffix' => '</tr></table>',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#prefix' => '<table><tr>',
      '#suffix' => '</tr></table>',
      '#submit' => ['::submitForm'],
    ];
    $form['#suffix'] = "</tr></table>";
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('mymodule.admin_settings');
    $config->delete();
    $config->set('firstname', $form_state->getValue('firstname'));
    $config->set('middlename', $form_state->getValue('middlename'));
    $config->set('lastname', $form_state->getValue('lastname'));
    $config->save();
  }
}

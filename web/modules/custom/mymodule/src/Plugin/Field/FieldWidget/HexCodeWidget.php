<?php

/**
 * @file
 * Contains \Drupal\mymodule\Plugin\Field\FieldWidget\RgbItemWidget.
 */
namespace Drupal\mymodule\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\mymodule\Plugin\Field\FieldWidget\WidgetPermission;

/**
 * Plugin implementation of the 'mymodule_hexcode_widget' widget.
 *
 * @FieldWidget(
 *   id = "mymodule_hexcode_widget",
 *   label = @Translation("Hexcode Widget"),
 *   field_types = {
 *     "mymodule_rgb"
 *   }
 * )
 */
class HexCodeWidget extends WidgetPermission { 

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
  
    $roles = $this->userRole->getRole();
    // Field is only shown to users with administrator role.
    if (in_array('administrator', $roles)) {
      $element['value'] = [
        '#title' => $this->t('Enter proper hex code starting with #'),
        '#type' => 'textfield',
        '#maxlength' => 7,
        '#element_validate' => [
          [$this, 'validateHexCode'],
        ],
      ];
    }

    return $element;
  }

  /**
   * Validates the hex code.
   */
  public function validateHexCode($element, FormStateInterface $form_state) {
    $value = $element['#value'];

    if (!preg_match('/^#[0-9A-Fa-f]{6}$/', $value)) {
      $form_state->setError($element, $this->t('The hex code value must be a valid 6-digit hex code starting with #.'));
    }
  }
  
}

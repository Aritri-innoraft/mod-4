<?php 

/**
 * @file
 * Contains \Drupal\mymodule\Plugin\Field\FieldFormatter\RgbItemFormatter.
 */
namespace Drupal\mymodule\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'mymodule_rgb_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "mymodule_rgb_formatter",
 *   label = @Translation("RGB Item Formatter"),
 *   field_types = {
 *     "mymodule_rgb"
 *   }
 * )
 */
class RgbItemFormatter extends FormatterBase { 

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        // '#type' => 'htmltag',
        // '#markup' => '<div>' . $item->value . '</div>',
        // '#attributes' => [
        //   'style' => 'background-color:' . $item->value . ';',
        // ],
        '#theme' => 'mymodule_custom_formatter',
        '#value' => $item->value,
      ];
    }
    return $elements;
  }

}
  
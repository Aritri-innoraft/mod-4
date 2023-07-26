<?php 

/**
 * @file
 * Contains \Drupal\mymodule\Plugin\Field\FieldFormatter\SnippetsDefaultFormatter.
 */
namespace Drupal\mymodule\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'snippets_default' formatter.
 *
 * @FieldFormatter(
 *   id = "snippets_default",
 *   label = @Translation("Snippets default"),
 *   field_types = {
 *     "snippets_code"
 *   }
 * )
 */
class SnippetsDefaultFormatter extends FormatterBase { 

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();
    foreach ($items as $delta => $item) {
      // $value = $item->value;
      $elements[$delta] = [
        '#type' => 'markup',
        '#markup' => '<p>' . $item->source_description . '<br>' . $item->source_code . '<br>' . $item->source_lang . '</p>',
        // '#source_description' => $item->source_description,
        // '#source_code' => $item->source_code,
      ];
      // dd($item->source_description);
      // $elements[$delta] = ['#markup' => \Drupal::service('renderer')->render($source)];
    }
    return $elements;
  }

}

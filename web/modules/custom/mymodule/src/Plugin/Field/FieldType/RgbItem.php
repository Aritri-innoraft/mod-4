<?php 

/**
 * @file
 * Contains \Drupal\mymodule\Plugin\Field\FieldType\RgbItem.
 */

namespace Drupal\mymodule\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'field_example_rgb' field type.
 *
 * @FieldType(
 *   id = "mymodule_rgb",
 *   label = @Translation("Example Color RGB"),
 *   module = "mymodule",
 *   description = @Translation("Demonstrates a field composed of an RGB color."),
 *   category = @Translation("Text"), 
 *   default_widget = "mymodule_colorpicker_widget",
 *   default_formatter = "mymodule_rgb_formatter"
 * )
 */
class RgbItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'text',
          // 'size' => '',
          'not null' => FALSE,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')->setLabel(t('Color field'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

}

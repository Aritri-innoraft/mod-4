<?php

namespace Drupal\mymodule\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a custom block.
 *
 * @Block(
 *   id = "mymodule_custom_block",
 *   admin_label = @Translation("MyModule Custom Block"),
 *   category = @Translation("Custom Block Category")
 * )
 */
class CustomBlock extends BlockBase {
  public function build() {
    return [
      '#markup' => $this->t('Hi, this is a custom block.'),
    ];
  }

  public function newfunc() {
    
  }
}
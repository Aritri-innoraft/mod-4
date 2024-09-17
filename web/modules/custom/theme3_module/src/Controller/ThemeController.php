<?php 

/**
 * @file
 * Generates markup to be displayed. Functionality in this Controller 
 * is wired to drupal in theme3_module.routing.yml 
 */

namespace Drupal\theme3_module\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\mymodule\CurrentUser;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class to implement controller of theme3_module.
 */
class ThemeController extends ControllerBase {
  
  /**
   * Function to return given message.
   * 
   *  @return array
   *    Returns message.
   */
  public function customPage() {
    return [
      '#type' => 'markup',
      '#markup' => t(string: 'Hello Aritri Dey'),
    ];
  }

}

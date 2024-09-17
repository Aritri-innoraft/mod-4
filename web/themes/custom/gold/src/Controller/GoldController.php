<?php 

use Drupal\Core\Controller\ControllerBase;


/**
 * Class to implement controller of mymodule.
 */
class GoldController extends ControllerBase {

  /**
   * Function to return given message.
   * 
   *  @return array
   *    Returns message.
   */
  public function themeCT() {
    return [
      '#type' => 'markup',
      '#markup' => t(string: 'Hello Aritri Dey'),
    ];
  }
}
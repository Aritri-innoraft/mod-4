<?php 

/**
 * @file
 * Generates markup to be displayed. Functionality in this Controller 
 * is wired to drupal in mymodule.routing.yml 
 */

namespace Drupal\mymodule\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\mymodule\CurrentUser;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class to implement controller of mymodule.
 */
class MyController extends ControllerBase {

  protected $currentUser;

  /**
   * Constructor to initiclise class variable.
   * 
   *  @param object $current_user
   *    Instance of CurrentUser class. 
   */
  public function __construct(CurrentUser $current_user) {
    $this->currentUser = $current_user;
  }

  /**
   * The create() method sets up the dependency injection by fetching the 
   * mymodule.current_user service from the container.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('mymodule.current_user')
    );
  }
  
  public function usernameDI() {
    $username = $this->currentUser->getUsername();
    $cachetags = ['user:' . $this->currentUser->getId()];
    if (!$this->currentUser->getId()) {
      return [
        '#type' => 'markup',
        '#cache' => [
          'tags' => $cachetags,
        ],
        '#markup' => t(string: 'Hello. Please login.'),
      ];
    }
    else {
      return [
        '#type' => 'markup',
        '#cache' => [
          'tags' => $cachetags,
        ],
        '#markup' => t(string: 'Hi @user',
          args: ['@user' => $username]),
      ];
    }
  }

  /**
   * Function to return given message.
   * 
   *  @return array
   *    Returns message.
   */
  public function helloMsg() {
    return [
      '#type' => 'markup',
      '#markup' => t(string: 'Hello Aritri Dey'),
    ];
  }

  /**
   * Function to return message along with names in the url.
   * 
   *  @return array
   */
  public function variableContent($name_1, $name_2) {
    return [
      '#type' => 'markup',
      '#markup' => t(string: 'Hello @name1 and @name2',
        args: ['@name1' => $name_1, '@name2' => $name_2]),
    ];
  }

  /**
   * Function to return message along with currnt logged in user's name.
   * 
   *  @return array
   */
  public function helloUser() {
    return [
      '#type' => 'markup',
      '#markup' => t(string: 'Hello '. \Drupal::currentUser()->getAccountName()),
    ];
  }

  // public function testObj() {
  //   \Drupal::messenger()->addMessage(t("Controller function has been called."));
  // }

  /**
   * Checks access for a specific request.
   *
   *   @param \Drupal\Core\Session\AccountInterface $account
   *     Run access checks for this account.
   *
   *   @return \Drupal\Core\Access\AccessResultInterface
   *     The access result.
   */
  public function accessCheck(AccountInterface $account) {
    // Check for permission'Access custom page'.
    return AccessResult::forbiddenIf($account->hasPermission('access the custom page'));
  }

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function myPage() {
    return [
      '#markup' => t(string: 'Hello World'),
    ];
  }

}

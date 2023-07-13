<?php

namespace Drupal\mymodule\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\mymodule\CurrentUser;
use Drupal\user\Entity\Role;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a custom block.
 *
 * @Block(
 *   id = "mymodule_custom_block",
 *   admin_label = @Translation("MyModule Custom Block"),
 *   category = @Translation("Custom Block Category")
 * )
 */
class CustomBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $userRole;
  /**
    * Constructs a Drupalist object.
    *
    * @param array $configuration
    *   A configuration array containing information about the plugin instance.
    * @param string $plugin_id
    *   The plugin_id for the plugin instance.
    * @param mixed $plugin_definition
    *   The plugin implementation definition.
    * @param \Drupal\Core\Session\AccountInterface $current_user
    *   The current_user.
    */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, CurrentUser $user_role,) {
    $this->userRole = $user_role;
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('mymodule.current_user')
    );
  }
  public function build() {
    $roles = $this->userRole->getRole();
    $role_name = Role::load($roles[1])->label();
    // dd($roles[0]);
    // foreach ($roles as $role) {

    // }
    return [
      '#markup' => $this->t('Welcome, '. $role_name),
    ];
  }

}

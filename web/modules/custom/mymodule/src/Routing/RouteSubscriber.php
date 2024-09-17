<?php 

namespace Drupal\mymodule\Routing ;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  public function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('mymodule.helloUser')) {
      $route->setRequirement('_role', 'administrator + manager');
    }
  }
}

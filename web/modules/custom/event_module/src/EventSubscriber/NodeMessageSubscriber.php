<?php 
/**
 * Contains event_module/src/EventSubscriber/NodeMessageSubscriber.php
 * 
 */

namespace Drupal\event_module\EventSubscriber;
 
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\event_module\Event\NodeMessageEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class NodeMessageSubscriber implements EventSubscriberInterface {

  protected $node;
  protected $entityTypeManager;
  protected $currentRouteMatch;

  // protected $messenger;

  // public function __construct(MessengerInterface $messenger) {
  //   $this->messenger = $messenger;
  // }

  public function __construct(EntityTypeManagerInterface $entityTypeManager, RouteMatchInterface $currentRouteMatch) {
    $this->entityTypeManager = $entityTypeManager;
    $this->currentRouteMatch = $currentRouteMatch;
    
  }

  public static function getSubscribedEvents() {
    $events[NodeMessageEvent::SUBMIT][] = ['onNodeMessage'];
    $events[KernelEvents::VIEW][] = ['onView', 100];
    return $events;
  }

  public function onNodeMessage(NodeMessageEvent $event) {
    $message = $event->getMessage();
    // $this->messenger->addMessage($message);
    \Drupal::messenger()->addStatus(t("This from NodeMessageEvent"));
  }

  public function onView(ViewEvent $event) {
    $node_param = $this->currentRouteMatch->getParameter('node');
    if ($node_param instanceof \Drupal\Core\Entity\EntityInterface) {
      $this->node = $node_param;
    
    if ($this->node->getType() == 'movie_type') {
      // Get the ID of the node.
      $node_id = $this->node->id();
      $source_entity = \Drupal\node\Entity\Node::load($node_id);
      if ($source_entity) {
        // Get the field value from the loaded source entity.
        $field_value = $source_entity->get('field_movie_type_price')->value;
        // Get amount from config form.
        // $config_amount = \Drupal::config('menu_module.admin_settings')->get('amount');
        $config = \Drupal::config('event_module.admin_settings');
        // dump($config);
        // Check whether movie is within budget or over budget.
        if ($config->get('amount') > $field_value) {
          $message = '<p><strong>The movie is under budget (from Event Module)</strong></p>';
        }
        else if ($config->get('amount') < $field_value) {
          $message = '<p><strong>The movie is over budget (from Event Module)</strong></p>';
        }
        else {
          $message = '<p><strong>The movie is within budget (from Event Module)</strong></p>';
        }
        // Add the message to the node's content.
        $build['my_message'] = [
          '#type' => 'markup',
          '#markup' => $message,
          '#prefix' => '<div class="my-message">',
          '#suffix' => '</div>',
          // '#weight' => 1000000000, 
          '#cache' => [
            'tags' => $config->getCacheTags(),
          ],
        ];
        $result = $event->getControllerResult();
        // Merging the result with node contents.
        $event->setControllerResult(array_merge($result, $build));
      }
    }}
  }
}


<?php 
/**
 * Contains event_module/src/Event/NodeMessageEvent.php
 */

namespace Drupal\event_module\Event;

use Drupal\Component\EventDispatcher\Event;

class NodeMessageEvent extends Event {

  const SUBMIT = 'event_module.node_message_event';
  protected $message;

  public function __construct($message) {
    $this->message = $message;
  }

  public function getMessage() {
    return $this->message;
  }

  public function setMessage($message) {
    $this->message = $message;
  }

}

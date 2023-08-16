<?php 

namespace Drupal\movie_award;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface defining the Movie Award entity.
 */
interface MovieAwardInterface extends ConfigEntityInterface {
  public function getDescription();
  public function setDescription($description);
  public function getYear();
  public function setYear($year);
  public function getMovie();
  public function setMovie($movie);
  
}

<?php 

// namespace Drupal\entity_module\Entity;

// use Drupal\Core\Entity\ContentEntityBase;
// use Drupal\Core\Entity\ContentEntityInterface;
// use Drupal\Core\Entity\EntityTypeInterface;
// use Drupal\Core\Field\BaseFieldDefinition;

// /**
//  * Defines the movie entity.
//  *
//  * @ingroup movie
//  *
//  * @ContentEntityType(
//  *   id = "movie_entity",
//  *   label = @Translation("movie"),
//  *   base_table = "movie",
//  *   entity_keys = {
//  *     "id" = "id",
//  *     "uuid" = "uuid",
//  *   },
//  * ) 
//  */

//  class MovieEntity extends ContentEntityBase implements ContentEntityInterface {

//   public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
//     // Standard field, used as unique if primary index.
//     $fields['id'] = BaseFieldDefinition::create('integer')
//       ->setLabel(t('ID'))
//       ->setDescription(t('The ID of the Movie entity.'))
//       ->setReadOnly(TRUE);

//     // Standard field, unique outside of the scope of the current project.
//     $fields['uuid'] = BaseFieldDefinition::create('uuid')
//       ->setLabel(t('UUID'))
//       ->setDescription(t('The UUID of the Movie entity.'))
//       ->setReadOnly(TRUE);
      
//     return $fields;
//   }

//  }

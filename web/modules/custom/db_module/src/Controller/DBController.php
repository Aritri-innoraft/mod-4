<?php 

/**
 * @file
 * Generates markup to be displayed. Functionality in this Controller 
 * is wired to drupal in db_module.routing.yml 
 */

namespace Drupal\db_module\Controller;

use Drupal;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Database\Database;

class DBController extends ControllerBase {

  public function showEvent() {
    
    $database = Drupal::database();

    // $query = $database->select('node__field_events_details', 'n');
    // $query->condition('n.bundle', 'events')
    //       ->fields('n', ['field_events_details_value'])
    //       ->join('node__field_events_type', 'm', 'n.entity_id = m.entity_id');
    // $query->fields('m', ['field_events_type_value'])
    //       ->join('node__field_events_date', 'd', 'm.entity_id = d.entity_id');
    // $query->fields('d', ['field_events_date_value'])
    //       ->join('node_field_data', 's', 'd.entity_id = s.nid');
    // $query->fields('s', [' title']);

    // $result = $query->execute();
    // foreach ($result as $value) {
    //   dd($value);
    //   $build[] = [
    //         '#type' => 'markup',
    //         '#markup' => t("<strong>@label</strong> <br> Event details: @details <br> Event type: @type <br> Event date: @date<br><br>", [
    //           '@label'=>$value->title,
    //           '@details' => $value->field_events_details_value, 
    //           '@type' => $value->field_events_type_value,
    //           '@date' => $value->field_events_date_value
    //         ]),
    //       ];
    // }
    // return $build;

    $query = $database->select('node__field_events_type', 'a');
    $query->fields('a', [' field_events_type_value']);
    $query->addExpression('count(field_events_type_value)', 'field_events_type_value_count');
    $query->groupBy("a.field_events_type_value");
    $result = $query->execute();
    foreach ($result as $value) {
      $build[] = [
        'type' => $value->field_events_type_value,
        'count' => $value->field_events_type_value_count

      ];
    }



    $query = $database->select('node__field_events_date', 'b');  
    $query->fields('b', ['field_events_date_value']);
    $query->addExpression('YEAR(field_events_date_value)', 'year') ;
    // $query->addExpression('QUARTER(field_events_date_value)', 'quarter') ;
    $yearly_count = $query->execute()->fetchAll(\PDO::FETCH_ASSOC);
    // dd($yearly_count[0]['year']);
    $year_arr = [];
    foreach ($yearly_count as $value) {
      $year_arr[$value['year']] = isset($year_arr[$value['year']]) ? ++$year_arr[$value['year']] : 1;
    }
    // dd($year);


    $query = $database->select('node__field_events_date', 'c');  
    $query->fields('c', ['field_events_date_value']);
    $query->addExpression('YEAR(field_events_date_value)', 'year') ;
    $query->addExpression('QUARTER(field_events_date_value)', 'quarter') ;
    $quarter_count = $query->execute()->fetchAll(\PDO::FETCH_ASSOC);
    // dd($quarter_count);
    $quarter_arr = [];
    foreach ($quarter_count as $value) {
      $quarter_arr[$value['year']][$value['quarter']] = isset($quarter_arr[$value['year']][$value['quarter']]) ? ++$quarter_arr[$value['year']][$value['quarter']] : 1;
    }
    // dd($quarter_arr);
    return [
      '#theme' => 'db_module_events',
      '#value' => $build,
      '#yearly' => $year_arr,
      '#quarterly' => $quarter_arr,
    ];

  }

}

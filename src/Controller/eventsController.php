<?php

namespace Drupal\unical\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Database\Query;
use Drupal\taxonomy\Entity\Term;



/**
 * Class eventsController.
 */
class eventsController extends ControllerBase {

  /**
   * Events.
   *
   * @return string
   *   Return Hello string.
   */
  public function events() {
    // print_r($_GET);
    print_r($_GET['sort']);
    print_r($_GET['range']);
    print_r($_GET['filter']);
    print_r($_GET['page']);

    exit;

    if($_SERVER['HTTP_HOST'] == "localhost:8888"){
      $tax = file_get_contents('http://localhost:8888/unical8/web/api/v1/events' . $id);
    }else{
      $tax =  json_decode(file_get_contents("http://". $_SERVER['SERVER_NAME'] .'/api/v1.0/events/' . $id ) );
      if(!$tax){
        print 'API contection issue check taxonomy controller in unical module';
        exit;
      }
    }

    $value['count'] = count(json_decode($tax));
    $value['data'] = json_decode($tax);
    print json_encode($value);

    exit;
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: events')
    ];
  }

}

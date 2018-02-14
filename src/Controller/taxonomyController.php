<?php

namespace Drupal\unical\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Database\Query;
use Drupal\taxonomy\Entity\Term;

/**
 * Class taxonomyController.
 */
class taxonomyController extends ControllerBase {

  /**
   * Taxonomy.
   *
   * @return string
   *   Return Hello string.
   */
  public function taxonomy($id) {

    if($_SERVER['HTTP_HOST'] == "localhost:8888"){
      $tax = file_get_contents('http://localhost:8888/unical8/web/api/v1.0/taxonomies/' . $id);
    }else{
      $tax =  json_decode(file_get_contents("http://". $_SERVER['SERVER_NAME'] .'/api/v1.0/taxonomies/' . $id ) );
      if(!$tax){
        print 'API contection issue check taxonomy controller in unical module';
        exit;
      }
    }

    $taxos = json_decode($tax);
    $value['count'] = count($taxos);
    $value['data'] = $taxos;
    print json_encode($value);

    exit;
  }

}

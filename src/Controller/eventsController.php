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
        // print date( 'U' , strtotime('2018-02-01 00:00:00') ); exit;
// print_r($_REQUEST['filter']['date']['value'][0]); exit;
// print_r($_REQUEST['filter']['date']['value'][1]); exit;

    if($_SERVER['HTTP_HOST'] == "localhost:8888"){
      $tax = file_get_contents('http://localhost:8888/unical8/web/api/v1/events' . $id);
    }else{
      $tax =  json_decode(file_get_contents("http://". $_SERVER['SERVER_NAME'] .'/api/v1.0/events/' . $id ) );
      if(!$tax){
        print 'API contection issue check taxonomy controller in unical module';
        exit;
      }
    }

    $taxos = json_decode($tax);

    foreach($taxos as $key => $value){
      $date[] = explode('</li>',$taxos[$key]->field_date);
    }

    foreach($date as $k => $v){
      foreach($date[$k] as $e => $u){
        $check = explode('-:-', trim( strip_tags($date[$k][$e]) ) );
        //see if between dates
        if(
          !$_REQUEST['filter']['date']['value'][1]
          &&
          date( 'U' , strtotime($_REQUEST['filter']['date']['value'][0]) ) <= date( 'U' , strtotime($check[0]) )
        ){
          $d[$k][] = $check;
        }else if( 
          date( 'U' , strtotime($_REQUEST['filter']['date']['value'][0]) ) <= date( 'U' , strtotime($check[0]) ) 
          &&
          date( 'U' , strtotime($_REQUEST['filter']['date']['value'][1]) ) >= date( 'U' , strtotime($check[1]) )
        ){
          $d[$k][] = $check;
        }
      }
    }

    foreach($d as $key => $value){
      foreach($d[$key] as $k => $v){
        // print date( 'U' , strtotime($_REQUEST['filter']['date']['value'][0]) );
        // print date( 'U' , strtotime($_REQUEST['filter']['date']['value'][1]) );

        $data[$key]['clndrDate'] = date( 'm/d/Y H:i:s' , strtotime($d[$key][$k][0]) );

        $d[$key][$k]['end_addto'] = date( 'm/d/Y h:i:s' , strtotime($d[$key][$k][1]) );
        $d[$key][$k]['end_date'] = date( 'F d, Y' , strtotime($d[$key][$k][1]) );
        $d[$key][$k]['end_time'] = date( 'h:i:s A' , strtotime($d[$key][$k][1]) );
        $d[$key][$k]['end_unix'] = date( 'U' , strtotime($d[$key][$k][1]) );

        $d[$key][$k]['start_addto'] = date( 'm/d/Y h:i:s' , strtotime($d[$key][$k][0]) );
        $d[$key][$k]['start_date'] = date( 'F d, Y' , strtotime($d[$key][$k][0]) );
        $d[$key][$k]['start_time'] = date( 'h:i:s A' , strtotime($d[$key][$k][0]) );
        $d[$key][$k]['start_unix'] = date( 'U' , strtotime($d[$key][$k][0]) );
        $d[$key][$k]['start_day'] = date( 'd' , strtotime($d[$key][$k][0]) );
        $d[$key][$k]['start_month'] = date( 'M' , strtotime($d[$key][$k][0]) );
      }
    }

    foreach($taxos as $key => $value){
      $data[$key]['id'] = $taxos[$key]->nid;
      $data[$key]['address']['administrative_area'] = $taxos[$key]->administrative_area;
      $data[$key]['address']['country'] = $taxos[$key]->country;
      $data[$key]['address']['data'] = $taxos[$key]->data;
      $data[$key]['address']['dependent_locality'] = $taxos[$key]->dependent_locality;
      $data[$key]['address']['first_name'] = $taxos[$key]->first_name;
      $data[$key]['address']['full_address'] = $taxos[$key]->full_address;
      $data[$key]['address']['last_name'] = $taxos[$key]->last_name;
      $data[$key]['address']['locality'] = $taxos[$key]->locality;
      $data[$key]['address']['name_line'] = $taxos[$key]->name_line;
      $data[$key]['address']['organisation_name'] = $taxos[$key]->field_organisation_name;
      $data[$key]['address']['postal_code'] = $taxos[$key]->field_postal_code;
      $data[$key]['address']['premise'] = $taxos[$key]->field_premise;
      $data[$key]['address']['sub_administrative_area'] = $taxos[$key]->field_sub_administrative_area;
      $data[$key]['address']['sub_premise'] = $taxos[$key]->field_sub_premise;
      $data[$key]['address']['locality'] = $taxos[$key]->field_locality;
      $data[$key]['body'] = $taxos[$key]->field_body;
      $data[$key]['body_trimmed'] = $taxos[$key]->field_body_trimmed;
      $data[$key]['cost'] = $taxos[$key]->field_cost;
      $data[$key]['body'] = $taxos[$key]->field_body;
      $data[$key]['date'] = $d[$key];
      $data[$key]['event_facebook'] = $taxos[$key]->field_event_facebook;
      $data[$key]['event_twitter'] = $taxos[$key]->field_event_twitter;
      $data[$key]['exclude_from_main_calendar'] = $taxos[$key]->field_exclude_from_main_calendar;
      $data[$key]['featured'] = $taxos[$key]->field_featured;
      $data[$key]['free'] = $taxos[$key]->field_free;
      $data[$key]['event_facebook'] = $taxos[$key]->field_event_facebook;

      if($taxos[$key]->field_image){
        $data[$key]['image'] = getimagesize('http://' . $_SERVER['HTTP_HOST'] . $taxos[$key]->field_image);   
      }

      $data[$key]['label'] = $taxos[$key]->title;      
      $data[$key]['map_center_lat'] = $taxos[$key]->field_map_center_lat;      
      $data[$key]['map_center_lng'] = $taxos[$key]->field_map_center_lng;      
      $data[$key]['map_zoom'] = $taxos[$key]->field_map_zoom;      
      $data[$key]['organizer_email'] = $taxos[$key]->field_organizer_email;      
      $data[$key]['organizer_facebook'] = $taxos[$key]->field_organizer_facebook;      
      $data[$key]['organizer_name'] = $taxos[$key]->field_organizer_name;      
      $data[$key]['organizer_phone'] = $taxos[$key]->field_organizer_phone;      
      $data[$key]['organizer_same_as_submitter'] = $taxos[$key]->field_organizer_same_as_submitter;      
      $data[$key]['organizer_twitter'] = $taxos[$key]->field_organizer_twitter;      
      $data[$key]['promoted'] = $taxos[$key]->field_promoted;      
      $data[$key]['repeating_date_description'] = $taxos[$key]->field_repeating_date_description;      
      $data[$key]['rsvp_email'] = $taxos[$key]->field_rsvp_email;      
      $data[$key]['rsvp_how_to'] = $taxos[$key]->field_rsvp_how_to;      
      $data[$key]['rsvp_phone'] = $taxos[$key]->field_rsvp_phone;      
      $data[$key]['rsvp_text'] = $taxos[$key]->field_rsvp_text;      
      $data[$key]['rsvp_ticket'] = $taxos[$key]->field_rsvp_ticket;      
      $data[$key]['submitter_email'] = $taxos[$key]->field_submitter_email;      
      $data[$key]['submitter_name'] = $taxos[$key]->field_submitter_name;    
      $data[$key]['submitter_phone'] = $taxos[$key]->field_submitter_phone;    
      $data[$key]['summary'] = $taxos[$key]->field_summary;    
      $data[$key]['taxonomy_1'] = $taxos[$key]->field_taxonomy_1;  
      $data[$key]['taxonomy_2'] = $taxos[$key]->field_taxonomy_2;  
      $data[$key]['taxonomy_3'] = $taxos[$key]->field_taxonomy_3;  
      $data[$key]['taxonomy_4'] = $taxos[$key]->field_taxonomy_4;  
      $data[$key]['taxonomy_5'] = $taxos[$key]->field_taxonomy_5;  
      $data[$key]['taxonomy_6'] = $taxos[$key]->field_taxonomy_6;  
      $data[$key]['taxonomy_8'] = $taxos[$key]->field_taxonomy_8;  
      $data[$key]['taxonomy_9'] = $taxos[$key]->field_taxonomy_9;  
      $data[$key]['taxonomy_10'] = $taxos[$key]->field_taxonomy_10;  
      $data[$key]['taxonomy_11'] = $taxos[$key]->field_taxonomy_11;  
      $data[$key]['timezone'] = $taxos[$key]->field_timezone;  
      $data[$key]['uri'] = $taxos[$key]->field_uri;  
      $data[$key]['venue_name'] = $taxos[$key]->field_venue_name;  
      $data[$key]['venue_url'] = explode('"',$taxos[$key]->field_venue_url)[1];
    }

    $value = [];
    $value['count'] = count( $taxos );
    $value['data'] = $data;
    print json_encode($value);

    exit;
  }

}

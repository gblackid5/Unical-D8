<?php

namespace Drupal\unical\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Database\Query;
use Drupal\taxonomy\Entity\Term;


/**
 * Class siteController.
 */
class siteController extends ControllerBase {

  /**
   * Site.
   *
   * @return string
   *   Return Hello string.
   */
  public function site($id) {
    $node = Node::load($id);

    $v['title'] = $node->title->value;
    $v['field_add_to_calendar_exclude'] = $node->field_add_to_calendar_exclude->value;
    $v['field_allow_archive'] = $node->field_allow_archive->value;
    $v['field_allow_event_submit'] = $node->field_allow_event_submit->value;
    $v['field_allow_featured_events'] = $node->field_allow_featured_events->value;
    $v['field_allow_users_to_choose_taxo'] = $node->field_allow_users_to_choose_taxo->value;
    $v['field_calendar_help_link'] = $node->field_calendar_help_link->value;
    $v['field_custom_text_above_filters'] = $node->field_custom_text_above_filters->value;
    $v['field_custom_text_above_sidebar'] = $node->field_custom_text_above_sidebar->value;
    $v['field_default_event_image'] = $node->field_default_event_image->value;
    $v['field_google_maps_api_key'] = $node->field_google_maps_api_key->value;
    $v['field_main_calendar_site'] = $node->field_main_calendar_site->value;
    $v['field_number_results_per_page'] = $node->field_number_results_per_page->value;
    $v['field_taxonomy_1'] = $node->field_taxonomy_1->value;
    $v['field_taxonomy_9'] = $node->field_taxonomy_9->value;
    $v['field_taxonomy_10'] = $node->field_taxonomy_10->value;
    $v['field_taxonomy_11'] = $node->field_taxonomy_11->value;
    $v['field_taxonomy_1_enabled'] = $node->field_taxonomy_1_enabled->value;
    $v['field_taxonomy_1_label'] = $node->field_taxonomy_1_label->value;
    $v['field_taxonomy_2'] = $node->field_taxonomy_2->value;
    $v['field_taxonomy_2_enabled'] = $node->field_taxonomy_2_enabled->value;
    $v['field_taxonomy_2_label'] = $node->field_taxonomy_2_label->value;
    $v['field_taxonomy_3'] = $node->field_taxonomy_3->value;
    $v['field_taxonomy_3_enabled'] = $node->field_taxonomy_3_enabled->value;
    $v['field_taxonomy_3_label'] = $node->field_taxonomy_3_label->value;
    $v['field_taxonomy_4'] = $node->field_taxonomy_4->value;
    $v['field_taxonomy_4_enabled'] = $node->field_taxonomy_4_enabled->value;
    $v['field_taxonomy_4_label'] = $node->field_taxonomy_4_label->value;
    $v['field_taxonomy_5'] = $node->field_taxonomy_5->value;
    $v['field_taxonomy_5_enabled'] = $node->field_taxonomy_5_enabled->value;
    $v['field_taxonomy_5_label'] = $node->field_taxonomy_5_label->value;
    $v['field_taxonomy_6'] = $node->field_taxonomy_6->value;
    $v['field_taxonomy_6_enabled'] = $node->field_taxonomy_6_enabled->value;
    $v['field_taxonomy_6_label'] = $node->field_taxonomy_6_label->value;
    $v['field_taxonomy_7'] = $node->field_taxonomy_7->value;
    $v['field_taxonomy_7_enabled'] = $node->field_taxonomy_7_enabled->value;
    $v['field_taxonomy_7_label'] = $node->field_taxonomy_7_label->value;
    $v['field_taxonomy_8'] = $node->field_taxonomy_8->value;
    $v['field_taxonomy_8_enabled'] = $node->field_taxonomy_8_enabled->value;
    $v['field_taxonomy_8_label'] = $node->field_taxonomy_8_label->value;
    $v['field_taxonomy_9_enabled'] = $node->field_taxonomy_9_enabled->value;
    $v['field_taxonomy_9_label'] = $node->field_taxonomy_9_label->value;
    $v['field_taxonomy_10_enabled'] = $node->field_taxonomy_10_enabled->value;
    $v['field_taxonomy_10_label'] = $node->field_taxonomy_10_label->value;
    $v['field_taxonomy_11_enabled'] = $node->field_taxonomy_11_enabled->value;
    $v['field_taxonomy_11_label'] = $node->field_taxonomy_11_label->value;

    $value['data'] = [$v];
    print json_encode($value);

    exit;
  }

}

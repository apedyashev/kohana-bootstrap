<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Rss feed controller
 */
class Controller_Rss extends My_AnyUsersController {

  public function action_index(){
    $info = array(
      'title' => Kohana::$config->load('config')->get( 'rss.title', '' ),
      'language' => Kohana::$config->load('config')->get( 'rss.language', '' ),
      'description' => Kohana::$config->load('config')->get( 'rss.description', '' ),
      'link' => URL::site('jobs.rss'),
      'pubDate' => time()
    );

    $jobArray = Model::factory('JobPosting')->getActualJobs();
    $items = array();
    foreach ($jobArray as $job){
      $title        = $job['job']['title'] . ' at ' . $job['job']['organization_name'] . ' - ' . $job['job']['location_str'] ;
      $description  = ucfirst( $job['job']['type'] ) . " job. Posted at " . $job['job']['created_at'];
      $url          = URL::site('jobs/' . $job['job']['seo_id']);
      $date         = $job['job']['created_at'];
      
      $items[] = array(
                'title'       => $title,
                'link'        => $url,
                'guid'        => $url,
                'description' => $description,
                'pubDate'     => $date
            );
    }

    header('Content-Type: text/xml');

    echo Feed::create($info, $items);
    die;
  }
} // End Location

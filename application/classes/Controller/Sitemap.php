<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Sitemap extends My_AnyUsersController {

  public function action_index(){
    header("Content-type: application/xml");
    
    $jobArray = Model::factory('JobPosting')->getActualJobs();
    
    echo '<?xml version="1.0" encoding="UTF-8"?>
      <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    ';
    
    foreach($jobArray as $job ){
      echo '<url>
      <loc>' . URL::site('jobs/' . $job['job']['seo_id']) . '</loc>
      <lastmod>' . Helper_Date::mySqlDateTimeToCustomFormat( $job['job']['created_at_native_format'], 'Y-m-d' ) . '</lastmod>
      <changefreq>weekly</changefreq>
      <priority>1</priority>
      </url> ';
      
    }
 
    echo '
      </urlset>
    '; 
    die;
  }
} // End Location

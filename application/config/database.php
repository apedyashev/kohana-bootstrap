<?php defined('SYSPATH') OR die('No direct access allowed.');

$dev_hosts      = array('localhost', '192.168.0.105', 'designers.loc');
$test_hosts     = array('test.rrs-lab.com');
if( in_array($_SERVER['HTTP_HOST'], $dev_hosts) ) {
  /**
   * Development configuration
   */
  return array
  (
    'default' => array
    (
      'type'       => 'MySQL',
      'connection' => array(
        /**
         * The following options are available for MySQL:
         *
         * string   hostname     server hostname, or socket
         * string   database     database name
         * string   username     database username
         * string   password     database password
         * boolean  persistent   use persistent connections?
         * array    variables    system variables as "key => value" pairs
         *
         * Ports and sockets may be appended to the hostname.
         */
        'hostname'   => 'localhost',
        'database'   => '',
        'username'   => '',
        'password'   => '',
        'persistent' => FALSE,
      ),
      'table_prefix' => '',
      'charset'      => 'utf8',
      'caching'      => FALSE,
    ),
  );
}
else if( in_array($_SERVER['HTTP_HOST'], $test_hosts) ) {
  /**
   * Testing configuration
   */
  return array
  (
    'default' => array
    (
      'type'       => 'MySQL',
      'connection' => array(
        /**
         * The following options are available for MySQL:
         *
         * string   hostname     server hostname, or socket
         * string   database     database name
         * string   username     database username
         * string   password     database password
         * boolean  persistent   use persistent connections?
         * array    variables    system variables as "key => value" pairs
         *
         * Ports and sockets may be appended to the hostname.
         */
        'hostname'   => 'localhost',
        'database'   => '',
        'username'   => '',
        'password'   => '',
        'persistent' => FALSE,
      ),
      'table_prefix' => '',
      'charset'      => 'utf8',
      'caching'      => FALSE,
    ),
  );
}
else{
  /**
   * Production configuration
   */
  return array
  (
    'default' => array
    (
      'type'       => 'MySQL',
      'connection' => array(
        /**
         * The following options are available for MySQL:
         *
         * string   hostname     server hostname, or socket
         * string   database     database name
         * string   username     database username
         * string   password     database password
         * boolean  persistent   use persistent connections?
         * array    variables    system variables as "key => value" pairs
         *
         * Ports and sockets may be appended to the hostname.
         */
        'hostname'   => 'localhost',
        'database'   => '',
        'username'   => '',
        'password'   => '',
        'persistent' => FALSE,
      ),
      'table_prefix' => '',
      'charset'      => 'utf8',
      'caching'      => FALSE,
    ),
    
  );
}

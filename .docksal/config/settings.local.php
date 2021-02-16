<?php

// Docksal DB connection settings.
$databases['default']['default'] = array (
  'database' => 'default',
  'username' => 'user',
  'password' => 'user',
  'host' => 'db',
  'driver' => 'mysql',
);
//Uncaught TypeError: ajaxViews.map is not a function
$settings['file_private_path'] = 'sites/default/files/private';
$settings['cache']['bins']['render'] = 'cache.backend.null';
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
$config['system.file']['path']['temporary'] = '/tmp';

$settings['hash_salt'] = 'PORiQwZvDQPgmKssBeSe5TdRjflmYqL0XBJat94vwlz7DEiNrK0Ghhlp-_1KKnZnF_F7qccrrg';
// Reverse proxy configuration (Docksal vhost-proxy)
if (PHP_SAPI !== 'cli') {
  $settings['reverse_proxy'] = TRUE;
  $settings['reverse_proxy_addresses'] = array($_SERVER['REMOTE_ADDR']);
  // HTTPS behind reverse-proxy
  if (
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' &&
    !empty($settings['reverse_proxy']) && in_array($_SERVER['REMOTE_ADDR'], $settings['reverse_proxy_addresses'])
  ) {
    $_SERVER['HTTPS'] = 'on';}}


/**
 * Enable local development services.
 */
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/local.services.yml';

<?php

require 'vendor/autoload.php';

use Cloudinary\Configuration\Configuration;

Configuration::instance([
  'cloud' => [
    'cloud_name' => getenv("cloudname"),
    'api_key'    => getenv("api_key"),
    'api_secret' => getenv("api_secret")
  ],
  'url' => [
    'secure' => true
  ]
]);

?>

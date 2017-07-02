<?php

# Configuration parameters.
$config = array();

# Database connection settings.
$config['db'] = array(
    'host' => 'localhost',          // MySQL Server address
    'user' => '',                   // User/Login
    'psw' => '',                    // Password
    'scheme' => 'twins_practice'    // Database scheme
);

# Runtime settings.
$config['dataVal'] = true;  // Server-side data validation before INSERT query

return $config;

?>
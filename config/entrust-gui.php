<?php
return [
    "layout" => "entrust-gui::app",
    "route-prefix" => "admin",
    "pagination" => [
        "users" => 5,
        "roles" => 5,
        "permissions" => 5,
    ],
    "middleware" => ['web', 'entrust-gui.admin'],
    "unauthorized-url" => '/login',
    "middleware-role" => 'control-total',
    "confirmable" => false,
    "users" => [
      'fieldSearchable' => [],
    ],
    
    "middlewaree" => ['web'],
    "unauthorized-url" => '/login',
    "middleware-role" => 'control-total',
    "confirmable" => false,
    "users" => [
      'fieldSearchable' => [],
    ],
];

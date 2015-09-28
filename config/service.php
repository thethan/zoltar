<?php


return [
    /*
    |--------------------------------------------------------------------------
    | Server Aliases
    |--------------------------------------------------------------------------
    |
    | This is the base for services bases on the location environment
    |
     */
    /*
     |
     | Base Url for development
     |
     */
    'base' => 'dev.',

    'url' => 'srv.edudyn.com',
    'protocol' => 'http://',
    'Authentication' => 'authentication.',
    'Application' => 'application.',
    'OldAuthentication' => 'authentication25.',
    'Files' => 'digitalfile-',
    'Person' => 'person-',
    'Client' => 'client-',

    'method' => array(
        'get' => 'GET',
        'post' => 'POST',
        'put' => 'PUT',
        'delete' => 'DELETE',
    ),
];
<?php

return array(


    'pdf' => array(
        'enabled' => true,
        //'binary'  => '"../vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64"',
        'binary'  => '"C:\xampp\htdocs\cotisap\vendor\h4cc\wkhtmltopdf-amd64\wkhtmltopdf-amd64"',
        //'binary'  => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        //'binary'  => '"../vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64"',
        'binary'  => '"C:\xampp\htdocs\cotisap\vendor\h4cc\wkhtmltoimage-amd64\wkhtmltoimage-amd64"',
        //'binary'  => base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64'),
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);

<?php defined('SYSPATH') OR die('No direct script access.');

return array(
    /**
     * PHP native method, readfile or fopen=>fread=>fclose (if 'memory_limit' is not empty)
     */
    'default' => array(
        'class_name' => "Download_Readfile",
        'directory' => DOCROOT."downloads",
        /**
         * Default 8192 bytes (8Kb)
         * @see http://php.net/manual/en/function.readfile.php
         */
        //'memory_limit' => 8192 //bytes
    ),

    /**
     * Redirect to Apache (2.0.*, 2.2.*, 2.4.*) with enabled module XSendFile
     * @see https://tn123.org/mod_xsendfile/
     */
    'apache' => array(
        'class_name' => "Download_XSendFile",
        'directory' => DOCROOT."downloads",
    ),

    /**
     * Redirect to Nginx with enabled module NginxXSendfile
     * @see http://wiki.nginx.org/NginxXSendfile
     */
    'nginx' => array(
        'class_name' => "Download_XAccelRedirect",
        'directory' => DOCROOT."downloads",
    ),
);
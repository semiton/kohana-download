<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Kohana_Exception_NotFound extends Kohana_Exception
{
    public function __construct($message = "File not found", array $variables = NULL, $code = 404, Exception $previous = NULL)
    {
        parent::__construct($message, $variables, $code, $previous);
    }
}
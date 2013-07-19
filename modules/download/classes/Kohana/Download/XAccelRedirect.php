<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Kohana_Download_XAccelRedirect
{
    /** @var array */
    protected $config;

    /**
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $this->config = $config;
    }

    /**
     * @param string $file_name
     * @param string $file_path
     * @param string $content_type
     */
    public function execute($file_name, $file_path, $content_type)
    {
        header('X-Accel-Redirect: '.realpath($file_path));
        header('Content-Type: '.$content_type);
        header('Content-Disposition: attachment; filename='.$file_name);
        exit;
    }
}
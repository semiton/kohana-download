<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Kohana_Download_Readfile
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
        while (ob_get_level()) {
            ob_end_clean();
        }
        header('Content-Description: File Transfer');
        header('Content-Type: '.$content_type);
        header('Content-Disposition: attachment; filename='.$file_name);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '.filesize($file_path));
        if (!empty($this->config['memory_limit']) AND ((float) $this->config['memory_limit']) > 0) {
            if ($fd = fopen($file_path, 'rb')) {
                while (!feof($fd)) {
                    print fread($fd, (float) $this->config['memory_limit']);
                }
                fclose($fd);
            }
        } else {
            readfile($file_path);
        }
        exit;
    }
}
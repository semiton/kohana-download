<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Kohana_Download
{
    /** @var object */
    protected $class;

    /** @var  array */
    protected $config;

    /** @var string */
    protected $file_name;

    /** @var string */
    protected $file_real_name;

    /** @var string */
    protected $file_path;

    /** @var string */
    protected $directory;

    /** @var string */
    protected $content_type;

    /**
     * @param string $config_name
     * @return static
     */
    public static function factory($config_name = "default")
    {
        return new static($config_name);
    }

    /**
     * @param string $config_name
     */
    public function __construct($config_name = "default")
    {
        $this->config = (array) Kohana::$config->load("download")->get($config_name, array());
        $class_name = !empty($this->config["class_name"]) ? $this->config["class_name"] : "Download_Readfile";
        $this->class = new $class_name($this->config);
    }

    /**
     * @throws Exception_NotFound
     */
    public function execute()
    {
        if ($this->directory === NULL) {
            $this->directory = $this->config["directory"];
        }
        if ($this->file_real_name === NULL) {
            $this->file_real_name = $this->file_name;
        }
        if ($this->file_path === NULL) {
            $this->file_path = $this->directory.DIRECTORY_SEPARATOR.$this->file_real_name;
        }
        if (!file_exists($this->file_path)) {
            throw new Exception_NotFound("File not ".$this->file_name." found on this server");
        }
        if ($this->content_type === NULL) {
            $info = getimagesize($this->file_path);
            $this->content_type = $info['mime'];
        }

        $this->class->execute($this->file_name, $this->file_path, $this->content_type);
    }

    /**
     * @param string $content_type
     * @return $this
     */
    public function setContentType($content_type)
    {
        $this->content_type = $content_type;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->content_type;
    }

    /**
     * @param string $file_name
     * @return $this
     */
    public function setFileName($file_name)
    {
        $this->file_name = $file_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * @param string $file_path
     * @return $this
     */
    public function setFilePath($file_path)
    {
        $this->file_path = $file_path;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->file_path;
    }

    /**
     * @param string $file_real_name
     * @return $this
     */
    public function setFileRealName($file_real_name)
    {
        $this->file_real_name = $file_real_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileRealName()
    {
        return $this->file_real_name;
    }

    /**
     * @param string $directory
     * @return $this
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
        return $this;
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }
}
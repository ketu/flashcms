<?php
/**
 * User: ketu <ketu.lai@gmail.com>
 * Date: 17-4-9
 */

namespace App\FlashCMS;



use Folklore\Image\Facades\Image as ImageHandler;
use Illuminate\Support\Facades\Config;

class Image
{
    private $width;

    private $height;

    private $options;

    private $defaultOptions = [
        'crop'=> true,
    ];

    private function __construct()
    {

    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function create($config = 'default', $options = [])
    {

        if (!$configs = Config::get('flashcms.image.'.$config)) {
            throw new \InvalidArgumentException('Image config ' . $config . 'not exists');
        }


        if (!$width = Config::get('flashcms.image.'.$config. '.width')) {
            throw new \InvalidArgumentException('Image width config ' . $config . 'not exists');
        }

        if (!$height = Config::get('flashcms.image.'.$config. '.height')) {
            throw new \InvalidArgumentException('Image height config ' . $config . 'not exists');
        }



        $image = new self();

        $image->setWidth($width);
        $image->setHeight($height);
        $image->setOptions($options);
        return $image;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = array_merge($this->defaultOptions, $options);
    }

    public function url($path)
    {


        return ImageHandler::url($path, $this->getWidth(), $this->getHeight(), $this->getOptions());
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }


}
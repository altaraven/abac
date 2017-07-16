<?php

namespace Tests\Abac\Data\Object;

use Abac\Base\ConfigurableTrait;

/**
 * Class Audio
 */
class Audio
{
    use ConfigurableTrait;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $artist;

    /**
     * @var int
     */
    private $length;

    /**
     * @var string
     */
    private $album;

    /**
     * @var string
     */
    private $genre;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return string
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }
}

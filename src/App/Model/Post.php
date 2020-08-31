<?php


namespace App\Model;


class Post
{

    private $id;
    private $date;
    private $title;
    private $image;
    private $text;
    /**
     * @var CachedCommentsHolder
     */
    private $comments;

    /**
     * Post constructor.
     * @param $id
     * @param $date
     * @param $title
     * @param $image
     * @param $text
     */
    public function __construct($id, $date, $title, $image, $text)
    {
        $this->id = $id;
        $this->date = $date;
        $this->title = $title;
        $this->image = $image;
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function hasImage()
    {
        return $this->image != null;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param CachedCommentsHolder $comments
     */
    public function setComments(CachedCommentsHolder $comments) : self
    {
        $this->comments = $comments;
        return $this;
    }

    public function getComments()
    {
        return $this->comments->getValue();
    }

}
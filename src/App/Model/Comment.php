<?php


namespace App\Model;


class Comment
{

    private $userId;
    private $postId;
    private $date;
    private $text;
    /**
     * @var CachedUserHolder
     */
    private $user;

    /**
     * Comment constructor.
     * @param $date
     * @param $text
     */
    public function __construct($userId, $postId, $date, $text)
    {
        $this->userId = $userId;
        $this->postId = $postId;
        $this->date = $date;
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
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
    public function getText()
    {
        return $this->text;
    }

    public function setUser(CachedUserHolder $user) : self
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->user->getValue();
    }

}
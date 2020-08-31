<?php


namespace App\Model;


use App\Model\Repository\BlogRepository;

class CachedCommentsHolder
{

    /**
     * @var BlogRepository
     */
    private $repository;
    private $postId;
    private $value;

    /**
     * CachedCommentsHolder constructor.
     * @param $repository
     * @param $postId
     */
    public function __construct($repository, $postId)
    {
        $this->repository = $repository;
        $this->postId = $postId;
    }

    public function getValue()
    {
        if ($this->value == null) {
            $this->value = $this->repository->getComments($this->postId);
        }
        return $this->value;
    }


}
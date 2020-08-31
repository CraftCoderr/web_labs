<?php


namespace App\Model;


class CachedUserHolder
{

    private $repository;
    private $userId;
    private $value;

    /**
     * CachedUserHolder constructor.
     * @param $repository
     * @param $userId
     */
    public function __construct($repository, $userId)
    {
        $this->repository = $repository;
        $this->userId = $userId;
    }

    public function getValue()
    {
        if ($this->value == null) {
            $this->value = $this->repository->getUserById($this->userId);
        }
        return $this->value;
    }


}
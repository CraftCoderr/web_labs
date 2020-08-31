<?php


namespace App\Model;


class User
{

    private $id;
    private $username;
    private $email;
    private $password;
    private $fio;
    private $isAdmin;

    /**
     * User constructor.
     * @param $id
     * @param $username
     * @param $email
     * @param $password
     * @param $fio
     * @param $isAdmin
     */
    public function __construct($id, $username, $email, $password, $fio, $isAdmin)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->fio = $fio;
        $this->isAdmin = $isAdmin;
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getFio()
    {
        return $this->fio;
    }

    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->isAdmin;
    }

    public function clearCredentials()
    {
        $this->password = null;
    }


}
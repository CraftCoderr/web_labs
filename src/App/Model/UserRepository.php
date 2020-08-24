<?php


namespace App\Model;


use Core\DB;
use PDO;

class UserRepository
{

    public function getUser($username)
    {
        $connection = DB::connect();
        $stmt = $connection->prepare('SELECT * FROM  `user` WHERE username = ?');
        $stmt->bindValue(1, $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user : null;
    }

    public function createUser($userdata) : bool
    {
        $connection = DB::connect();
        $stmt = $connection->prepare('INSERT INTO `user`(username, email, password, fio) VALUES '
            .'(?, ?, ?, ?)');
        $stmt->bindValue(1, $userdata['username']);
        $stmt->bindValue(2, $userdata['email']);
        $stmt->bindValue(3, $userdata['password']);
        $stmt->bindValue(4, $userdata['fio']);
        try {
            $stmt->execute();
            return $stmt->rowCount() == 1;
        } catch (\Exception $e) {
            return false;
        }
    }

}
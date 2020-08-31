<?php


namespace App\Model\Repository;


use App\Model\User;
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
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userData) {
            return new User(
                $userData['user_id'],
                $userData['username'],
                $userData['email'],
                $userData['password'],
                $userData['fio'],
                $userData['is_admin']
            );
        }
        return null;
    }

    public function getUserById($userId)
    {
        $connection = DB::connect();
        $stmt = $connection->prepare('SELECT * FROM  `user` WHERE user_id = ?');
        $stmt->bindValue(1, $userId);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userData) {
            return new User(
                $userData['user_id'],
                $userData['username'],
                $userData['email'],
                $userData['password'],
                $userData['fio'],
                $userData['is_admin']
            );
        }
        return null;
    }

    public function checkUsernameExists($username) {
        $stmt = DB::connect()->prepare('SELECT count(*) FROM  `user` WHERE username = ?');
        $stmt->bindValue(1, $username);
        $stmt->execute();
        $exists = $stmt->fetch(PDO::FETCH_COLUMN);
        return $exists ? true : false;
    }

    public function createUser($userdata)
    {
        $connection = DB::connect();
        $stmt = $connection->prepare('INSERT INTO `user`(username, email, password, fio) VALUES '
            .'(?, ?, ?, ?);');
        $stmt->bindValue(1, $userdata['username']);
        $stmt->bindValue(2, $userdata['email']);
        $stmt->bindValue(3, $userdata['password']);
        $stmt->bindValue(4, $userdata['fio']);
        try {
            $stmt->execute();
            if ($stmt->rowCount()) {
                return new User(
                    $connection->lastInsertId(),
                    $userdata['username'],
                    $userdata['email'],
                    $userdata['password'],
                    $userdata['fio'],
                    false);
            } else {
                return null;
            }
        } catch (\Exception $e) {
            return null;
        }
    }

}
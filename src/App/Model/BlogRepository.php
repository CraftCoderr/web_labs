<?php


namespace App\Model;


use Core\DB;
use PDO;

class BlogRepository
{

    public function getCount()
    {
        $connection = DB::connect();
        $stmt = $connection->prepare('SELECT count(*) FROM blog_post');
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function getPosts($page, $pageSize)
    {
        $connection = DB::connect();
        $stmt = $connection->prepare('SELECT * FROM blog_post ORDER BY date DESC LIMIT ?, ?');
        $stmt->bindValue(1, $pageSize * ($page - 1), PDO::PARAM_INT);
        $stmt->bindValue(2, $pageSize, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPost($data)
    {
        $connection = DB::connect();
        $stmt = $connection->prepare('INSERT INTO blog_post(date, title, image, text) VALUES (?, ?, ?, ?)');
        $stmt->bindValue(1, $data['date']);
        $stmt->bindValue(2, $data['title']);
        $stmt->bindValue(3, $data['image']);
        $stmt->bindValue(4, $data['text']);
        $stmt->execute();
        return $stmt->rowCount() == 1;
    }

}
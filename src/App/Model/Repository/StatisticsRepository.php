<?php


namespace App\Model\Repository;


use Core\DB;
use PDO;

class StatisticsRepository
{

    public function addView($data)
    {
        $connection = DB::connect();
        $stmt = $connection->prepare(
            'INSERT INTO website_view(date, page, ip_address, hostname, browser) VALUES (?, ?, ?, ?, ?)');
        $stmt->bindValue(1, $data['date']);
        $stmt->bindValue(2, $data['page']);
        $stmt->bindValue(3, $data['ip_address']);
        $stmt->bindValue(4, $data['hostname']);
        $stmt->bindValue(5, $data['browser']);
        $stmt->execute();
    }

    public function getCount()
    {
        $connection = DB::connect();
        $stmt = $connection->prepare('SELECT count(*) FROM website_view');
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function getStatistics($page, $pageSize)
    {
        $connection = DB::connect();
        $stmt = $connection->prepare('SELECT * FROM website_view ORDER BY date DESC LIMIT ?, ?');
        $stmt->bindValue(1, $pageSize * ($page - 1), PDO::PARAM_INT);
        $stmt->bindValue(2, $pageSize, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
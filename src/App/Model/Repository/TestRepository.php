<?php


namespace App\Model\Repository;


use Core\DB;
use PDO;

class TestRepository
{

    public function addTestResult($result)
    {
        $connection = DB::connect();
        $stmt = $connection->prepare(
            'INSERT INTO test_result(date, full_name, student_group, answer1, answer2, answer3, result) VALUES '
            .'(?, ?, ?, ?, ?, ?, ?)');
        $stmt->bindValue(1, $result['date']);
        $stmt->bindValue(2, $result['fio']);
        $stmt->bindValue(3, $result['group']);
        $stmt->bindValue(4, $result['answer1']);
        $stmt->bindValue(5, $result['answer2']);
        $stmt->bindValue(6, $result['answer3']);
        $stmt->bindValue(7, $result['result'], PDO::PARAM_BOOL);
        $stmt->execute();
        return $stmt->rowCount() == 1;
    }

    public function getResults()
    {
        $connection = DB::connect();
        $stmt = $connection->prepare(
            'SELECT date, full_name AS fio, student_group AS `group`, answer1, answer2, answer3, result FROM test_result');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
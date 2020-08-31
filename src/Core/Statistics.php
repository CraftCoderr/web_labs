<?php


namespace Core;


use App\Model\Repository\StatisticsRepository;

class Statistics
{

    public static function commit()
    {
        $repository = new StatisticsRepository();
        $data = [];
        $data['date'] = (new \DateTime())->format('Y-m-d H:i:s');
        $data['page'] = explode('?', $_SERVER['REQUEST_URI'])[0];
        $data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $data['hostname'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $data['browser'] = $_SERVER['HTTP_USER_AGENT'];
        $repository->addView($data);
    }

}
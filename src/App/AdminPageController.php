<?php


namespace App;


use App\Model\StatisticsRepository;
use Core\AdminController;
use Core\Routing\RouteNotFound;

class AdminPageController extends AdminController
{

    private static $PAGE_SIZE = 20;

    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new StatisticsRepository();
    }

    public function showStatistics($page)
    {
        $this->checkAdmin();

        $pageCount = ceil($this->repository->getCount()/ self::$PAGE_SIZE) ?: 1;
        if (($page > $pageCount) || $page < 1 ) {
            throw new RouteNotFound();
        }
        $stats = $this->repository->getStatistics($page, self::$PAGE_SIZE);
        $this->render('stats', ['data' => $stats, 'page' => $page, 'pages' => $pageCount]);
    }

}
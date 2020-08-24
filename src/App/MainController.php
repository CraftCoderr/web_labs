<?php


namespace App;


use Core\Controller;
use Core\Routing\Request;

class MainController extends Controller
{

    public function index()
    {
        $this->render('index');
    }

    public function aboutme()
    {
        $this->render('aboutme');
    }

    public function interests()
    {
        $this->render('interests');
    }

    public function education()
    {
        $this->render('education');
    }

    public function history()
    {
        $this->render('history');
    }

}
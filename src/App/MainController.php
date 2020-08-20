<?php


namespace App;


use Core\Routing\Request;

class MainController
{

    public function index()
    {
        global $renderer;
        $renderer->render('index');
    }

    public function aboutme()
    {
        global $renderer;
        $renderer->render('aboutme');
    }

    public function interests()
    {
        global $renderer;
        $renderer->render('interests');
    }

    public function education()
    {
        global $renderer;
        $renderer->render('education');
    }

    public function photos()
    {
        global $renderer;
        $renderer->render('photos');
    }

    public function test()
    {
        global $renderer;
        $renderer->render('test');
    }

    public function contacts()
    {
        global $renderer;
        $renderer->render('contacts');
    }

    public function history()
    {
        global $renderer;
        $renderer->render('history');
    }

}
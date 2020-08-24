<?php


namespace Core;


class ProtectedController extends Controller
{
    private $authPage = '/auth';
    private $user;

    protected function authenticate()
    {
        session_start();
        if (isset($_SESSION['auth']) && isset($_SESSION['user']) && $_SESSION['auth'] == true) {
            $user = $_SESSION['user'];
        } else {
            $this->redirect($this->authPage);
        }
    }

}
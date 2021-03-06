<?php


namespace Core;


class AdminController extends ProtectedController
{

    public function checkAdmin()
    {
        $this->authenticate();
        if (!$this->user()->isAdmin()) {
            $this->redirect('/');
        }
    }

}
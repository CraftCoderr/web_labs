<?php


namespace App;


use Core\Routing\Request;

class TestController
{

    public function test(Request $request) {
        global $renderer;
        $renderer->render('base', ['test' => 'TEST MESSAGE from TestController'.$request->get('data'), 'valid' => true]);
    }

}
<?php


namespace App;


use Core\Controller;

class PhotosController extends Controller
{

    public function showPhotos()
    {
        $this->render('photos', [
            [ 'title' => '27.08.2017', 'photo' => '21041672.jpg' ],
            [ 'title' => '15.10.2017', 'photo' => '22430178.jpg' ],
            [ 'title' => '15.10.2017', 'photo' => '22580631.jpg' ],
            [ 'title' => '22.10.2017', 'photo' => '22710566.jpg' ],
            [ 'title' => '22.10.2017', 'photo' => '22636999.jpg' ],
            [ 'title' => '08.11.2017', 'photo' => '23347999.jpg' ],
            [ 'title' => '24.12.2017', 'photo' => '25015541.jpg' ],
            [ 'title' => '29.08.2018', 'photo' => '39301472.jpg' ],
            [ 'title' => '21.10.2018', 'photo' => '43201094.jpg' ],
            [ 'title' => '11.11.2018', 'photo' => '5.jpg' ],
            [ 'title' => '28.11.2018', 'photo' => '4.jpg' ],
            [ 'title' => '03.12.2018', 'photo' => '3.jpg' ],
            [ 'title' => '02.01.2019', 'photo' => '2.jpg' ],
            [ 'title' => '08.03.2019', 'photo' => '1.jpg' ],
            [ 'title' => '28.09.2019', 'photo' => '69941812.jpg' ],
        ]);
    }

}
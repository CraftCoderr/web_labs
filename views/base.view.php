<!DOCTYPE html>
<?php require_once __DIR__ . '/ti.php' ?>
<?php require_once __DIR__ . '/util.php' ?>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>L/W Home page</title>
    <link href='/css/normalize.css' rel='stylesheet'>
    <link href='/css/font-awesome.min.css' rel='stylesheet'>
    <link href='/css/<?=$view ?>.css' rel='stylesheet'>
    <script src='/js/visit-monitor.js'></script>
    <?php emptyblock('styles') ?>
</head>
<body>
<header>
    <nav class='topnav' id='mainNav'>
        <a class='active' href='/' id='index'>Home</a>
        <a href='/aboutme' id='aboutme'>About me</a>
        <div class='dropdown'>
            <button class='dropbtn'>
                Interests
                <i class='fa fa-caret-down'></i>
            </button>
            <div class='dropdown-content'>
                <a href='/interests#hobby'>Hobby</a>
                <a href='/interests#book'>Book</a>
                <a href='/interests#music'>Music</a>
                <a href='/interests#film'>Film</a>
            </div>
        </div>
        <a href='/education' id='education'>Education</a>
        <a href='/photos' id='photos'>Photos</a>
        <a href='/test' id='test'>Test</a>
        <a href='/contacts' id='contacts'>Contacts</a>
        <a href='/history' id='history'>History</a>
        <a href='/feedback' id='feedback'>Feedback</a>
        <a href='https://time100.ru/' id='timer'></a>
        <a class='icon' href='javascript:void();' onclick='toggleNav()' style='font-size:15px;'>%#9776;</a>
    </nav>
</header>
<main>
    <?php emptyblock('content') ?>
</main>
<?php emptyblock('dynamic') ?>
<script src='js/header.js'></script>
<script src='js/jquery-3.4.1.js'></script>
<?php emptyblock('scripts') ?>
</body>
</html>

<?php
switch($data['nav']){
    case 'home': $home = 'active" aria-current="page';break;
    case 'score': $score = 'active" aria-current="page';break;
    case 'package': $package = 'active" aria-current="page';break;
    case 'course': $course = 'active" aria-current="page';break;
    case 'user': $user = 'active" aria-current="page';break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'];?></title>
    <link rel="stylesheet" href="<?=BASE_URL."/asset/bootstrap-5.3.2-dist/css/bootstrap.min.css"?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL."/home" ?>">ACE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link <?= $home ?>" href="<?= BASE_URL."/home" ?>">Home</a>
                <a class="nav-link <?= $score ?>" href="<?= BASE_URL."/score" ?>">Score</a>
                <a class="nav-link <?= $package ?>" href="<?= BASE_URL."/package" ?>">Package</a>
                <a class="nav-link <?= $course ?>" href="<?= BASE_URL."/course" ?>">Course</a>
                <a class="nav-link <?= $user ?>" href="<?= BASE_URL."/user" ?>">User</a>
            </div>
            </div>
        </div>
    </nav>

    <script src="<?= BASE_URL ?>/asset/jQuery/jquery-3.7.1.min.js"></script>
    
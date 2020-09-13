<?php
    use Core\Helpers\Html_Helper as H;
?>
<!doctype html>
<html lang="en">
<head>
    <base href="<?= WEBPATH;?>">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blood Bank Management System | <?= ($title) ? $title : SUBTITLE;?></title>
    <?= H::link('stylesheet','vendor/bootstrap/css/bootstrap.min')?>
    <?= H::link('stylesheet','vendor/owl-carousel/owl.carousel.min')?>
    <?= H::link('stylesheet','css/style')?>
    <?= $this->section('head');?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="<?= $this->assets('images/logo-reverse.png');?>"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNav" aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="myNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= WEBPATH;?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Home/WhyToBeDonor">Why To Become Donor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Home/BecomeDonor">Become Donor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Home/SearchDonor">Search Donor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Home/ContactUs">Contact Us</a>
            </li>
        </ul>
    </div>
</nav>
    <?= $this->section('body');?>
    <section class="container-fluid">
        <section class="row bg-dark text-white">
            <div class="col-12">
                <p class="pt-3">Copyright &copy; <?= date('Y')?> | Blood Bank Management</p>
            </div>
        </section>
    </section>
    <?= H::script('vendor/jquery/jquery-3.3.1.min')?>
    <?= H::script('vendor/bootstrap/js/bootstrap.bundle')?>
    <?= H::script('vendor/owl-carousel/owl.carousel.min')?>
    <?= $this->section('footer');?>
</body>
</html>

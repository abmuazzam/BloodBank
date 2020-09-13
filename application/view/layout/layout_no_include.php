<?php
    use Core\Helpers\Html_Helper as H;
?>
<!doctype html>
<html lang="en">
<base href="<?= WEBPATH;?>" />
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <?= H::link('stylesheet','vendor/bootstrap/css/bootstrap.min');?>
    <?= H::link('stylesheet','vendor/fonts/circular-std/style');?>
    <?= H::link('stylesheet','libs/css/style');?>
    <?= H::link('stylesheet','vendor/fonts/fontawesome/css/fontawesome-all');?>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
    <?= $this->section('head')?>
</head>

<body>
<!-- ============================================================== -->
<!-- login page  -->
<!-- ============================================================== -->
<?= $this->section('body');?>

<?= H::script('vendor/jquery/jquery-3.3.1.min') ?>
<?= H::script('vendor/bootstrap/js/bootstrap.bundle') ?>
<?= $this->section('footer');?>
</body>

</html>
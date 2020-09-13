<?php
    use Core\Session;
    use Core\Helpers\Form_Helper as FH;
    $this->start('body');
?>
    <div class="splash-container">
    <div class="card ">
        <div class="card-header text-center">
            <a href="<?= WEBPATH;?>">
                <img class="logo-img" src="<?= $this->assets('images/logo.png');?>" alt="logo">
            </a>
        </div>
        <div class="card-body">
            <?= Session::getMessage();?>
            <form method="post" action="Admin/Login">
                <div class="form-group">
                   <?= FH::inputBlock('text','username',$user->username,'',["class"=>"form-control form-control-lg","autocomplete"=>"off","placeholder"=>"Username"],['text'=>'text-danger','message'=>FH::displayError($errors,'username')]);?>
                </div>
                <div class="form-group">
                    <?= FH::inputBlock('password','password',$user->password,'',["class"=>"form-control form-control-lg","autocomplete"=>"off","placeholder"=>"Password"],['text'=>'text-danger','message'=>FH::displayError($errors,'password')]);?>
                </div>
                <!--<div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                    </label>
                </div>-->
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
            </form>
        </div>
    </div>
</div>
<?php
    $this->end();
?>

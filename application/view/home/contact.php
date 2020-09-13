<?php
    use Core\Helpers\Form_Helper as FH;
    use Core\Session;
    $this->start('body');
?>
    <main class="container-fluid">
        <div class="row banner-img" style="background: url('<?= $this->assets('img/bg-contact.jpg') ?>')">

        </div>
    </main>
    <main class="container-fluid">
        <section class="row mt-2">
            <div class="col-12 col-sm-8">
               <div class="card rounded-0 mb-2">
                   <div class="card-header">
                       <h5>Reach Us</h5>
                   </div>
                   <div class="card-body p-0">
                       <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d26431.449822541632!2d74.8096617!3d34.0969022!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38e1855686e3c5ef%3A0x66244b7cc1e305c6!2sSrinagar!5e0!3m2!1sen!2sin!4v1599964234678!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                   </div>
               </div>
                <div class="card rounded-0 mb-2">
                    <div class="card-header">
                        <h5>Have a Query?</h5>
                    </div>
                    <div class="card-body">
                        <?= Session::getMessage();?>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <?=
                                        FH::inputBlock('text','fullName',$model->fullName,'',
                                            ["class"=>"form-control","placeholder"=>"Full Name"],
                                            ["text"=>"text-danger","message"=>FH::displayError($errors,'fullName')]
                                        )
                                    ?>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <?=
                                    FH::inputBlock('text','mobile',$model->mobile,'',
                                        ["class"=>"form-control","placeholder"=>"Mobile"],
                                        ["text"=>"text-danger","message"=>FH::displayError($errors,'mobile')]
                                    )
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <?=
                                    FH::inputBlock('email','email',$model->email,'',
                                        ["class"=>"form-control","placeholder"=>"Email"],
                                        ["text"=>"text-danger","message"=>FH::displayError($errors,'email')]
                                    )
                                    ?>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <?=
                                    FH::inputBlock('text','subject',$model->subject,'',
                                        ["class"=>"form-control","placeholder"=>"Subject"],
                                        ["text"=>"text-danger","message"=>FH::displayError($errors,'subject')]
                                    )
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <?=
                                        FH::textarea('message',$model->message,'',
                                            ["class"=>"form-control","placeholder"=>"Message"],
                                            ["text"=>"text-danger","message"=>FH::displayError($errors,'message')]
                                        )
                                    ?>
                                    <div class="form-group">
                                        <?=
                                            FH::submit('Send',["class"=>"btn btn-primary rounded-0"])
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card border-primary rounded-0">
                    <div class="card-header bg-primary rounded-0">
                        <h5 class="text-white">Contact Us</h5>
                    </div>
                    <div class="card-body">
                        <strong>Blood Bank Management</strong>
                        <ul class="list-unstyled">
                            <li><strong>Mobile: </strong> (+91) 123 456 7890</li>
                            <li><strong>Email: </strong> query@bloodbankmanagement.com</li>
                        </ul>
                    </div>
                </div>
                <div class="card border-primary rounded-0 mt-2">
                    <div class="card-header bg-primary rounded-0">
                        <h5 class="text-white">Address</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>Srinagar, Kashmir</li>
                            <li> Jammu & Kashmir</li>
                            <li> 192101</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
$this->end();
?>
<?php
use Core\Session;
use Core\Helpers\Form_Helper as FH;
$this->start('body');
?>
<div class="dashboard-content">
    <div class="card">
        <div class="card-body">
            <?= Session::getMessage();?>
            <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?=$model->id;?>">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <?=
                        FH::inputBlock('text','fullName',$model->fullName,'',["class"=>"form-control form-control-lg","placeholder"=>"Donor Name"],['text'=>'text-danger',"message"=> FH::displayError($errors,'fullName')])
                        ?>
                    </div>
                    <div class="col-12 col-sm-4">
                        <?=
                        FH::inputBlock('text','mobile',$model->mobile,'',["class"=>"form-control form-control-lg","placeholder"=>"Mobile"],['text'=>'text-danger',"message"=> FH::displayError($errors,'mobile')])
                        ?>
                    </div>
                    <div class="col-12 col-sm-4">
                        <?=
                        FH::inputBlock('email','email',$model->email,'',["class"=>"form-control form-control-lg","placeholder"=>"Email"],['text'=>'text-danger',"message"=> FH::displayError($errors,'email')])
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <?=
                        FH::inputBlock('number','age',$model->age,'',["class"=>"form-control form-control-lg","placeholder"=>"Age"],['text'=>'text-danger',"message"=> FH::displayError($errors,'age')])
                        ?>
                    </div>
                    <div class="col-12 col-sm-4">
                        <?=
                        FH::select(
                            'gender',
                            [
                                "male"=>'Male',
                                "female"=>'Female',
                                "transgender"=>'Transgender'
                            ],
                            $model->gender,
                            '',
                            ["class"=>"form-control form-control-lg"],
                            ["text"=>"text-danger","message"=>FH::displayError($errors,'gender')]
                        );
                        ?>
                    </div>
                    <div class="col-12 col-sm-4">
                        <?=
                        FH::select(
                            'bloodGroupId',
                            $bloodGroups
                            ,
                            $model->bloodGroupId,
                            '',
                            ["class"=>"form-control form-control-lg"],
                            ["text"=>"text-danger","message"=>FH::displayError($errors,'bloodGroupId')]
                        );
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?=
                        FH::textarea('address',$model->address,'',
                            [
                                "class"=>"form-control form-control-lg",
                                "placeholder"=>"Address"
                            ],
                            [
                                "text"=>"text-danger",
                                "message"=> FH::displayError($errors,'address')
                            ]
                        )
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?=
                        FH::textarea('message',$model->message,'',
                            [
                                "class"=>"form-control form-control-lg",
                                "placeholder"=>"Message"
                            ],
                            [
                                "text"=>"text-danger",
                                "message"=> FH::displayError($errors,'message')
                            ]
                        )
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <?=
                        FH::inputBlock('text','pincode',$model->pincode,'',
                            [
                                "class"=>"form-control form-control-lg",
                                "placeholder"=>"Pincode"
                            ],
                            [
                                "text"=>"text-danger",
                                "message"=> FH::displayError($errors,'pincode')
                            ]
                        )
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <?= FH::submit('Update Donor',["class"=>"btn btn-outline-primary"])?>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <a href="Donor/" class="btn btn-link">&laquo; Back To List</a>
        </div>
    </div>
</div>
<?php
$this->end();
?>

<?php
    use Core\Helpers\Form_Helper as FH;
    $this->start('body');
?>
<main class="container-fluid">
    <div class="row banner-img">

    </div>
</main>
<main class="container-fluid mt-4">
    <form action="" method="post">
        <div class="row no-gutters">
            <div class="col-12 col-sm-4">
                <?=
                FH::select(
                    'bloodGroupId',
                    $bloodGroups
                    ,
                    '',
                    '',
                    ["class"=>"form-control form-control-lg  rounded-0 border-right-0"],
                    ["text"=>"text-danger","message"=>FH::displayError($errors,'bloodGroupId')]
                );
                ?>
            </div>
            <div class="col-12 col-sm-4">
                <?=
                    FH::inputBlock('text','pincode','','',["class"=>"form-control form-control-lg  rounded-0 border-left-0","placeholder"=>"Enter Pincode"]);
                ?>
            </div>
            <div class="col-12 col-sm-4">
                <?=
                    FH::submit('Search',["class"=>"btn btn-outline-primary rounded-0 btn-lg"])
                ?>
            </div>
        </div>
    </form>
    <hr />
</main>
<main class="container-fluid">
   <div class="row">
       <div class="col-12 col-sm-8">
           <div class="row">
               <?php
               if($donors){
                   $count=0;
                   foreach($donors as $donor){
                       $count++;
                       switch ($donor->gender){
                           case "male":
                               $avatar = "img/male.png";
                               break;
                           case "female":
                               $avatar = "img/female.png";
                               break;
                           default:
                               $avatar = "img/default.png";
                               break;
                       }
                       ?>
                       <div class="col-6 col-sm-6 mt-2 mb-2">
                           <div class="card">
                               <div class="card-header" data-toggle="collapse" data-target="#collapse<?=$count?>">
                                   <h4><?= $donor->fullName?> +</h4>
                               </div>
                               <div class="card-body collapse" id="collapse<?=$count?>">
                                   <div class="text-center">
                                       <img src="<?= $this->assets($avatar);?>" />
                                   </div>
                                   <ul class="list-group mt-2">
                                       <li class="list-group-item">
                                           <strong>Blood Group: </strong> <?= $donor->bloodGroup->bloodGroup?>
                                       </li>
                                       <li class="list-group-item">
                                           <strong>Mobile: </strong> <?= $donor->mobile?>
                                       </li>
                                       <li class="list-group-item">
                                           <strong>Email: </strong> <br /> <?= $donor->email?>
                                       </li>
                                       <li class="list-group-item">
                                           <strong>Age: </strong>  <?= $donor->age?>
                                       </li>
                                       <li class="list-group-item">
                                           <strong>Address: </strong> <br /> <?= $donor->address?>
                                       </li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                       <?php
                   }
               }else{
                   ?>
                   <div class="col-12">
                       <h1>No Donors Found</h1>
                   </div>
                   <?php
               }
               ?>
           </div>
       </div>
        <div class="col-12 col-sm-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3>Request Blood</h3>
                </div>
                <div class="card-body">
                    <form action="" id="requestForm" name="requestForm" method="post">
                        <div class="form-group">
                            <?=
                                FH::inputBlock('text','fullName','','',
                                ["class"=>"form-control rounded-0","placeholder"=>"Name"]
                                )
                            ?>
                        </div>
                        <div class="form-group">
                            <?=
                                FH::textarea('address','','',
                                    ["class"=>"form-control rounded-0","placeholder"=>"Address with Pin"]
                                )
                            ?>
                        </div>
                        <div class="form-group">
                            <?=
                            FH::textarea('purpose','','',
                                ["class"=>"form-control rounded-0","placeholder"=>"Purpose"]
                            )
                            ?>
                        </div>
                        <div class="form-group">
                            <?=
                            FH::inputBlock('date','dated','','',
                                ["class"=>"form-control rounded-0"]
                            )
                            ?>
                        </div>
                        <div class="form-group">
                            <?=
                            FH::inputBlock('time','timing','','',
                                ["class"=>"form-control rounded-0"]
                            )
                            ?>
                        </div>
                        <div class="form-group">
                            <?=
                            FH::inputBlock('text','mobile','','',
                                ["class"=>"form-control rounded-0","placeholder"=>"Mobile"]
                            )
                            ?>
                        </div>
                        <div class="form-group">
                            <?=
                            FH::select(
                                'bloodGroupId',
                                $bloodGroups
                                ,
                                '',
                                '',
                                ["class"=>"form-control rounded-0"]
                            );
                            ?>
                        </div>
                        <div class="form-group">
                            <?=
                            FH::inputBlock('number','points','','',
                                ["class"=>"form-control rounded-0","placeholder"=>"Points"]
                            )
                            ?>
                        </div>
                        <div c
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary rounded-0" id="btnRequestBtn">
                                <span id="btnRequest">Request</span> <img src="<?= $this->assets('img/loader.gif')?>" id="btnLoader" />
                            </button>
                        </div>
                        <div class="form-group">
                            <div id="error"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>
</main>
<?php
    $this->end();
    $this->start('footer');
?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#requestForm').on('submit',function (e) {
                e.preventDefault();
                $.ajax({
                   url  : "Home/request_blood",
                   type : "POST",
                   data : new FormData(this),
                   processData: false,
                   contentType: false,
                   beforeSend: function () {
                        $('#btnLoader').show();
                        $('#btnRequest').text('Requesting...');
                        $('#btnRequestBtn').attr('disabled','true');
                   },
                   success: function(s){
                       s = $.trim(s);
                       if(s=="1"){
                           $('#error').html('<div class="alert alert-success">Blood Request Sent! We will contact you soon</div>');
                            setTimeout(function(){
                                $('#error').html('');
                                requestForm.reset();
                            },1500);
                       }else{
                           $('#error').html(s);
                       }
                   },
                   complete: function(){
                       $('#btnLoader').hide();
                       $('#btnRequest').text('Request');
                       $('#btnRequestBtn').removeAttr('disabled');
                   }
                });
            });
        });
    </script>
<?php
    $this->end();
?>

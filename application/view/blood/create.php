<?php
use Core\Helpers\Html_Helper as H;
use Core\Session as Session;
use Core\Helpers\Form_Helper as FH;
$this->start('body');
?>
<div class="dashboard-content">
    <div class="card">
        <div class="card-body">
            <?= Session::getMessage();?>
           <div class="row">
               <div class="col-12 col-sm-6">
                   <form action="" method="post">
                       <?= FH::inputBlock('text','bloodGroup',$model->bloodGroup,'',["class"=>"form-control form-control-lg","placeholder"=>"Enter Blood Group"],['text'=>'text-danger','message'=>FH::displayError($errors,'bloodGroup')]);?>
                       <?= FH::submit('Add Blood Group',["class"=>"btn btn-outline-primary"])?>
                   </form>
               </div>
           </div>
        </div>
        <div class="card-footer">
            <ul class="list-unstyled list-inline">
                <li class="list-inline-item">
                    <a href="Blood/" class="btn btn-link">&laquo; Back To List</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php
$this->end();
$this->start('footer');
echo H::script('js/blood');
$this->end();
?>

<?php
    $this->start('head');
?>
    <style type="text/css">
        .text{
            font-size: 3em;
        }
    </style>
<?php
    $this->end();
    $this->start('body');
?>
<div class="dashboard-ecommerce">
    <div class="container">
        <div class="row  mt-5">
            <div class="col-12 col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Total Donors</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="text">
                            <?= count(\Application\Model\Donors::find());?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Total Blood Groups</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="text">
                            <?= count(\Application\Model\BloodGroup::find());?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Total Queries</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="text">
                            <?= count(\Application\Model\ContactUs::find(["conditions"=>"status=?","bind"=>["0"]]));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $this->end();
    $this->start('footer');
?>
<!-- chart chartist js -->
<script src="<?= $this->assets('vendor/charts/chartist-bundle/chartist.min.js');?>"></script>
<!-- sparkline js -->
<script src="<?= $this->assets('vendor/charts/sparkline/jquery.sparkline.js');?>"></script>
<!-- morris js -->
<script src="<?= $this->assets('vendor/charts/morris-bundle/raphael.min.js');?>"></script>
<script src="<?= $this->assets('vendor/charts/morris-bundle/morris.js');?>"></script>
<!-- chart c3 js -->
<script src="<?= $this->assets('vendor/charts/c3charts/c3.min.js');?>"></script>
<script src="<?= $this->assets('vendor/charts/c3charts/d3-5.4.0.min.js');?>"></script>
<script src="<?= $this->assets('vendor/charts/c3charts/C3chartjs.js');?>"></script>
<script src="<?= $this->assets('libs/js/dashboard-ecommerce.js');?>"></script>
<?php
    $this->end();
?>

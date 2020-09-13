<?php
    $this->start('body');
?>
<div class="dashboard-content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Name: </th>
                        <td colspan="3"><?= ucwords($donor->fullName);?></td>
                    </tr>
                    <tr>
                        <th>Mobile</th><td><?= $donor->mobile;?></td>
                        <th>Email</th><td><?= $donor->email;?></td>
                    </tr>
                    <tr>
                        <th>Age</th><td><?= $donor->age;?></td>
                        <th>Gender</th><td><?= ucwords($donor->gender);?></td>
                    </tr>
                    <tr>
                        <th>Address</th><td><?= $donor->address;?></td>
                        <th>Pincode</th><td><?= $donor->pincode;?></td>
                    </tr>
                    <tr>
                        <th>Blood Group</th><td><?= $donor->bloodGroup->bloodGroup;?></td>
                        <th>Message</th><td><?= ($donor->message) ? $donor->message : "NA";?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <a href="Donor/" class="btn btn-link">&laquo; Back To List</a>
            <a href="Donor/Edit/<?=\Core\Helpers\Encryption_Helper::encrypt($donor->id)?>" class="btn btn-link"> Edit &raquo;</a>
        </div>
    </div>
</div>
<?php
    $this->end();
?>

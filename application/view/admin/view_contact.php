<?php
    use Core\Helpers\Encryption_Helper as EH;
    $this->start('body');
?>
<div class="dashboard-content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Name: </th>
                        <td><?= ucwords(strtolower($model->fullName));?></td>
                        <th>Subject: </th>
                        <td><?= $model->subject;?></td>
                    </tr>
                    <tr>
                        <th>Mobile: </th>
                        <td><?= $model->mobile;?></td>
                        <th>Email: </th>
                        <td><?= $model->email;?></td>
                    </tr>
                    <tr>
                        <th>Message: </th>
                        <td colspan="3">
                            <?= $model->message;?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date & Time</th>
                        <?php
                            $date = $model->created_at;
                            $dated = date('dS F, Y',strtotime($date));
                            $time = date('h:i A',strtotime($date));
                        ?>
                        <td colspan="3"><?= $dated." ".$time?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <a href="Admin/Contact" class="btn btn-link">&laquo; Back To List</a>
            <?php
            if($model->status=="0"){
                ?>
                <a href="Admin/UpdateContact/<?= EH::encrypt($model->id) ?>" class="btn btn-sm btn-outline-success">
                    <i class="fa fa-check"></i>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
    $this->end();
?>

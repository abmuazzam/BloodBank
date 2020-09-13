<?php
    use Core\Session;
    use Core\Helpers\Html_Helper as H;
    use Core\Helpers\Encryption_Helper as EH;
    $this->start('body');
?>
<div class="dashboard-content">
    <div class="card">
        <div class="card-header">
            <a href="Donor/Create" class="btn btn-outline-primary">Add Donor</a>
        </div>
        <div class="card-body">
            <?= Session::getMessage();?>
            <div class="table-responsive">
                <table class="table table-striped" id="datatable-for-donors">
                    <thead>
                        <tr>
                            <th>S. No</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Blood Group</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $count=0;
                        foreach($donors as $donor){
                            $count++;
                    ?>
                            <tr>
                                <th><?= $count;?></th>
                                <td><?= $donor->fullName;?></td>
                                <td><?= $donor->mobile;?></td>
                                <td><?= $donor->bloodGroup->bloodGroup;?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="Donor/Edit/<?= EH::encrypt($donor->id) ?>" class="btn btn-outline-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="Donor/View/<?= EH::encrypt($donor->id) ?>" class="btn btn-outline-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="Donor/Delete/<?= EH::encrypt($donor->id) ?>" class="btn btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
    $this->end();
    $this->start('footer');
    echo H::script('js/donor');
    $this->end();
?>

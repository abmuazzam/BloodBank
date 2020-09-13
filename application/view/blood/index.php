<?php
    use Core\Helpers\Html_Helper as H;
    use Core\Session;
    use Core\Helpers\Encryption_Helper as EH;
    $this->start('body');
?>
    <div class="dashboard-content">
        <div class="card">
            <div class="card-header">
                <a href="Blood/Create" class="btn btn-outline-primary">Add Blood Group</a>
            </div>
            <div class="card-body">
                <?= Session::getMessage();?>
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable-for-blood">
                        <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Blood Group</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $count =0;
                            foreach($bloodGroups as $bloodGroup):
                                $count++;
                        ?>
                            <tr>
                                <th><?=$count;?></th>
                                <td><?= $bloodGroup->bloodGroup?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="Blood/Edit/<?= EH::encrypt($bloodGroup->id)?>" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript: void(0);" onclick="javascript: return deleteBlood('<?= EH::encrypt($bloodGroup->id)?>');" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            endforeach;
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
    echo H::script('js/blood');
    $this->end();
?>

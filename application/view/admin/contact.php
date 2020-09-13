<?php
    use Core\Helpers\Encryption_Helper as EH;
    use Core\Session;
    $this->start('body');
?>
<div class="dashboard-content">
    <div class="card">
        <div class="card-body">
            <?= Session::getMessage();?>
            <div class="table-responsive">
                <table class="table table-striped" id="datatable-for-contacts">
                    <thead>
                        <tr>
                            <th>S. No</th>
                            <th>Full Name</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $count=0;
                        foreach($contacts as $contact){
                            $count++;
                    ?>
                            <tr>
                                <th><?= $count;?></th>
                                <td><?= ucwords(strtolower($contact->fullName))  ?></td>
                                <td><?= $contact->message?></td>
                                <td><?= ($contact->status=="1") ? "Contacted" : "Not Contacted"?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="Admin/ViewContact/<?= EH::encrypt($contact->id) ?>" class="btn btn-outline-primary">
                                    <i class="fa fa-eye"></i>
                                        </a>
                                        <?php
                                            if($contact->status=="0"){
                                        ?>
                                                <a href="Admin/UpdateContact/<?= EH::encrypt($contact->id) ?>" class="btn btn-outline-success">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                        <?php
                                            }
                                        ?>
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
?>
    <script type="text/javascript">
        $(document).ready(function(){
           $('#datatable-for-contacts').DataTable();
        });
    </script>
<?php
    $this->end();
?>

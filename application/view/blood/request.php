<?php
    $this->start('body');
?>
<div class="dashboard-content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="datatable-for-requests">
                    <thead>
                        <tr>
                            <th>S. No</th>
                            <th>Name</th>
                            <th>Address (Purpose)</th>
                            <th>Blood (Points)</th>
                            <th>Mobile</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $count=0;
                        if($requests){
                            foreach($requests as $request){
                                $count++;
                    ?>
                                <tr>
                                    <th><?= $count;?></th>
                                    <td><?= $request->fullName;?></td>
                                    <td><?= $request->address;?><br />
                                        <small><strong>Purpose: </strong><?= $request->purpose?></small>
                                    </td>
                                    <td><?= $request->bloodGroup->bloodGroup." ( ".$request->points." )";?></td>
                                    <td><?= $request->mobile;?></td>
                                    <?php
                                        $dated = date('dS F, Y',strtotime($request->dated));
                                        $time = date('h:i A',strtotime($request->timing));
                                    ?>
                                    <td><?= $dated."  <br />".$time ?></td>
                                </tr>
                    <?php
                            }
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
           $('#datatable-for-requests').DataTable();
        });
    </script>
<?php
    $this->end();
?>

<?php
use App\Models\Package;
use App\Models\User;

$sn = 1;
?>
<h1 class="dash-title">Investments</h1>

<?php if (User::isMember()) : ?>
    <?php include_once 'investment_form.php'; ?>
<?php endif; ?>
<hr>
<div class="text-center">
    <b class="">Deposit here : <i>3BQGWBqvh14enk88QiKSBUYTe84jequcsm</i></b>
</div>
<hr>
<div class="row">
<div class="col-lg-12">
    <div class="card spur-card">
        <div class="card-header">
            <div class="spur-card-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="">Pending investment</div>
        </div>
        <div class="card-body card-body-with-dark-table">
            <?php if (array_key_first($params) == 'user') : ?>
            <table class="table table-dark table-in-card">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Package</th>
                        <th scope="col">Amount</th>
                        <th scope="col">ROI</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($params['user'] as $investment) : ?>
                        <tr>
                            <td><?= $sn++; ?></td>
                            <td><?= Package::package($investment['package_id'])[0]['package_name'] ?></td>
                            <td>$<?= number_format($investment['amount']) ?></td>
                            <td>$<?= number_format($investment['expected_amount']) ?></td>
                            <td><?= !$investment['is_active'] ? '<button class="btn btn-outline-warning btn-sm">pending</button>' : '' ?></td>
                            
                            <td>
                                <?php if ($investment['is_paid']) : ?>
                                    <i class="btn btn-outline-warning btn-sm" >Awaiting Confirmation</i>
                                <?php else : ?>
                                    <button class="btn btn-primary btn-sm" inv-id="<?= $investment['id']; ?>">has paid</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php elseif (array_key_first($params) == 'admin') : ?>
                <table class="table table-dark table-in-card">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Package</th>
                            <th scope="col">Amount</th>
                            <th scope="col">ROI</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($params['admin'] as $investment) : ?>
                            <tr>
                                <td><?= $sn++; ?></td>
                                <td><?= User::find(User::$table, 'id', $investment['user_id'])[0]['email'] ?></td>
                                <td><?= Package::package($investment['package_id'])[0]['package_name'] ?></td>
                                <td><?= '$'.number_format($investment['amount']) ?></td>
                                <td><?= '$'.number_format($investment['expected_amount']) ?></td>
                                <td><button class="btn btn-outline-warning btn-sm">pending</button></td>
                                <td>    
                                    <button class="btn btn-success btn-sm" inv-id="<?= $investment['id'] ?>">confirm</button>
                                </td>
                                    
                                    
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

</div>

<?php if (User::isMember()) : ?>
<script>
    $('button').click((e) => {
        
        var formdata = $(e.target).attr('inv-id');
        
        if (formdata) {
            $(e.target).prop('disabled', 'true').html('processing . . .');
            $.ajax({
                type : 'POST',
                url : '/investment/pay',
                data : {
                    inv_id : formdata
                },
                success : (response) => {
                    if (response) {
                        alert('confirmation request has been sent')
                        location.reload();
                    } else {
                        alert('An error occurred');
                        location.reload();
                    }
                }
            })
        }
    });
</script>

<?php elseif (User::isAdmin()) : ?>
    <script>
        $('button').click((e) => {

            var form = $(e.target).attr('inv-id');
            
            if (form) {
                $(e.target).prop('disabled', 'true').html('processing . . .');
                $.ajax({
                    type : 'POST',
                    url : '/investment/activate',
                    data : {
                        inv_id : form
                    },
                    success : (response) => {
                        if (response) {
                            alert('Investment has been confirmed');
                            location.reload();
                        } else {
                            alert('An error occurred');
                        }
                    }
                })
            }
            
        })
    </script>
<?php endif; ?>
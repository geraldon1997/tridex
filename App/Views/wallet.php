<?php
use App\Models\User;

$sn = 1;
?>

<h1 class="dash-title">Wallet</h1>

<?php if (User::isMember()) : ?>
<div class="row">
    <div class="col-lg-12">
        <form id="waf" class="form">
            <div class="form-row">
                <div class="col-lg-10">
                    <input type="text" name="wa" class="form-control" placeholder="Enter Wallet address" required>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-primary" id="updateaddress">update address</button>
                </div>
            </div>
            
        </form>
    </div>
</div>
<?php endif; ?>
<hr>

<div class="row">
<div class="col-lg-12">
    <div class="card spur-card">
        <div class="card-header">
            <div class="spur-card-icon">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="spur-card-title"></div>
        </div>
        <div class="card-body card-body-with-dark-table">
            <?php if (User::isMember()) : ?>
                <table class="table table-dark table-in-card">
                    <thead>
                        <tr>
                            <th scope="col">Wallet Address</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($params['user']) : ?>
                            <?php foreach ($params['user'] as $wallet) : ?>
                                <tr>
                                    <td><?= $wallet['wallet_address']; ?></td>
                                    <td><?= '$'.number_format($wallet['balance']); ?></td>
                                    
                                    <td><input type="number" id="amount" placeholder="amount to withdraw" required></td>
                                    <td>
                                        <?php if ($wallet['withdrawable'] && $wallet['balance'] > 1) : ?>
                                            <input type="hidden" id="max" value="<?= $wallet['balance']; ?>">
                                            <button class="btn btn-primary btn-sm" id="request">request</button>   
                                        <?php elseif (!$wallet['withdrawable']) : ?>
                                            <button class="btn btn-outline-info">update wallet address</button>
                                        <?php elseif ($wallet['withdrawable'] && $wallet['balance'] < 1) : ?>
                                            <button class="btn btn-outline-warning">insuffucient funds</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php elseif (User::isAdmin()) : ?>
                <table class="table table-dark table-in-card">
                    <thead>
                        <tr>
                            <th scope="col">Wallet Address</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>

<script>
    $('#waf').submit((e) => {
        e.preventDefault();
        $('#updateaddress').prop('disabled', 'true').html('processing . . .');
        $.ajax({
            type : 'POST',
            url : '/wallet/updateaddress',
            data : $('#waf').serialize(),
            success : (response) => {
                if (response) {
                    $('#updateaddress').html('address updated');
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                } else {
                    alert('An error occurred, wallet address could not but updated');
                    $('#updateaddress').removeAttr('disabled').html('update address');
                }
            }
        })
    })

    $('#request').click(() => {
        var amount = $('#amount').val();
        var max = $('#max').val();

        if (amount === '' || amount === ' ' || amount === null || amount === undefined) {
            alert('your withdrawal amount cannot be empty');
            return;
        }

        if (amount < 1) {
            alert('you cannot withdraw negative balance');
            return;
        }

        if (parseInt(amount) > parseInt(max)) {
            alert('you cannot withdraw what you do not have');
            return;
        }
        $('#request').prop('disabled', 'true').html('processing . . .');

        $.ajax({
            type : 'POST',
            url : '/wallet/withdraw',
            data : {
                amount : amount
            },
            success : (response) => {
                if (response) {
                    $('#request').html('request sent');
                    setTimeout(() => {
                        location.reload();
                    })
                } else {
                    $('#request').removeAttr('disabled').html('request');
                }
            }
        })
    })
</script>
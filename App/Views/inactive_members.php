<?php $sn = 1; ?>
<h1 class="dash-title">Users</h1>
<div class="row">
<div class="col-lg-12">
    <div class="card spur-card">
        <div class="card-header">
            <div class="spur-card-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="">Inactive members</div>
        </div>
        <div class="card-body card-body-with-dark-table">
            <table class="table table-dark table-in-card">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($params as $inactive) : ?>
                    <tr>
                        <th scope="row"><?= $sn++; ?></th>
                        <td><?= $inactive['user']['email'] ?></td>
                        <td><?= $inactive['auth']['is_active'] ? '<button class="btn btn-outline-success btn-sm mb-1">active</button>' : '<button class="btn btn-outline-danger btn-sm mb-1">inactive</button>'; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" title="Activate user">
                                <i class="fa fa-angle-double-right"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" title="delete user">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

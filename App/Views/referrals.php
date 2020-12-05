<?php
use App\Models\User;
?>
<h1 class="dash-title">Referrals</h1>

<div class="row">
    <div class="col-lg-10">
        <div class="form-group">
            <input type="text" id="reflink" class="form-control" value="<?= APP_URL.ltrim(SIGNUP, '/').'/'.User::ref($_SESSION['email']) ?>">
        </div>
    </div>
    <div class="col-lg-2">
        <div class="form-group">
            <button class="form-control btn btn-outline-primary" id="copylink">copy link</button>
        </div>
    </div>
</div>

<script>
    $('#copylink').click(() => {
        var link = $('#reflink');

        link.select();

        document.execCommand('copy');

        $('#copylink').html('link copied');

        setTimeout(() => {
            $('#copylink').html('copy link')
        }, 5000);
    });
</script>
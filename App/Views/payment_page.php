<?php
$xpub = "xpub6CAbpLW1aGsoBChWuKMZXAJbBg8nXygBAcBpssuP8sk8sEwzRp4fhA43bnfSRf71rhF3SdSTPVnZYuAoEv7Z3mVMoiGqLZUHWDuFxiV55Db";
$url = "https://api.smartbit.com.au/v1/blockchain/address/".$xpub;
$data = json_decode(file_get_contents($url), true);
$next = $data['address']['extkey_next_receiving_address'];

?>

<h1>new address <?= $next; ?></h1>

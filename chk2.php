<?php
$h = getenv('HOME');
require "$h/store-app-sh/public/connect/lib.php";
$kp = sodium_crypto_box_keypair();
$s = sodium_crypto_box_seal('relay-ok', sodium_crypto_box_publickey($kp));
echo 'seal roundtrip: ', sodium_crypto_box_seal_open($s, $kp), ' native=', extension_loaded('sodium') ? 'yes' : 'no', "\n";

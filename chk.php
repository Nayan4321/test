<?php
$h = getenv('HOME');
echo 'sodium: ', function_exists('sodium_crypto_box_seal') ? 'yes' : 'NO', ' php ', PHP_VERSION, "\n";
foreach (['/health', '/connect/start.php', '/connect/refresh.php', '/google/start?t=x', '/assets/app.js?v=1.6.0'] as $p) {
	$c = curl_init('https://sh.laghavi.site' . $p);
	curl_setopt_array($c, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 15]);
	$b = (string) curl_exec($c);
	echo $p, ' => ', curl_getinfo($c, CURLINFO_HTTP_CODE), ' ', substr(preg_replace('/\s+/', ' ', strip_tags($b)), 0, 120), "\n";
}
foreach (['src/Search.php', 'src/Controllers/App.php', 'public/connect/lib.php', 'connect-config.php'] as $f) {
	echo $f, ': ', is_file("$h/store-app-sh/$f") ? 'ok ' . substr(sprintf('%o', fileperms("$h/store-app-sh/$f")), -4) : 'MISSING', "\n";
}
echo 'backup: ', is_file("$h/sh-150-bak.tgz") ? filesize("$h/sh-150-bak.tgz") : 'missing', "\n";
$cfg = require "$h/store-app-sh/connect-config.php";
echo 'state_key length: ', strlen($cfg['state_key'] ?? ''), "\n";

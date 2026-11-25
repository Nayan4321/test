<?php
// Read-only: lists published pages and the images each one uses, with pixel sizes.
$up = wp_get_upload_dir();
$pages = get_posts(['post_type' => 'page', 'post_status' => 'publish', 'numberposts' => -1, 'orderby' => 'ID', 'order' => 'ASC']);
echo "== PAGES ==\n";
foreach ($pages as $p) { echo $p->ID, ' | ', $p->post_name, ' | ', $p->post_title, "\n"; }
$seen = [];
foreach ($pages as $p) {
    $raw = (string) $p->post_content . ' ' . (string) get_post_meta($p->ID, '_elementor_data', true);
    $raw = str_replace('\\/', '/', $raw);
    preg_match_all('#https?://[^"\'\s\\\\)]+\.(?:png|jpe?g|webp|gif|svg)#i', $raw, $m);
    $u = array_values(array_unique($m[0]));
    if (! $u) { continue; }
    echo "\n== ", $p->ID, ' ', $p->post_name, " ==\n";
    foreach ($u as $url) {
        $sz = '';
        if (strpos($url, $up['baseurl']) === 0) { $f = $up['basedir'] . substr($url, strlen($up['baseurl'])); $g = @getimagesize($f); $sz = $g ? $g[0] . 'x' . $g[1] : 'missing'; }
        else { $sz = 'EXTERNAL'; }
        echo $sz, ' ', $url, "\n";
    }
}

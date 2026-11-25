<?php
// Read-only: prints the visible text of the main English pages (post content + Elementor text), one page after another.
$ids = [17, 7790, 7769, 2008, 7821, 7806, 9130, 2028, 2020, 2044, 7721, 7727];
function lgx_walk($n, &$out) {
    if (is_array($n)) {
        foreach ($n as $k => $v) {
            if (is_string($v) && in_array($k, ['title', 'editor', 'text', 'html', 'description', 'title_text', 'description_text', 'button_text', 'tab_title', 'tab_content', 'item_description', 'testimonial_content', 'heading', 'sub_title', 'content', 'inner_text', 'prefix', 'suffix', 'price', 'period', 'link_text', 'alert_title', 'alert_description', 'before_text', 'highlighted_text', 'after_text', 'ending_number', 'subtitle', 'list_title', 'list_content', 'question', 'answer'], true)) {
                $t = trim(preg_replace('/\s+/', ' ', html_entity_decode(wp_strip_all_tags(preg_replace('/<(script|style)\b.*?<\/\1>/is', '', $v)))));
                if ($t !== '') { $out[] = $t; }
            } elseif (is_array($v)) { lgx_walk($v, $out); }
        }
    }
}
foreach ($ids as $id) {
    $p = get_post($id);
    if (! $p) { continue; }
    echo "\n===== ", $id, ' /', $p->post_name, '/ ', $p->post_title, " =====\n";
    $c = preg_replace('/<(script|style)\b.*?<\/\1>/is', '', (string) $p->post_content);
    $txt = trim(preg_replace("/\n\s*\n+/", "\n", html_entity_decode(wp_strip_all_tags(str_replace(['</p>', '</h1>', '</h2>', '</h3>', '</li>', '<br>', '</div>', '</td>', '</th>'], ["\n", "\n", "\n", "\n", "\n", "\n", "\n", ' | ', ' | '], $c)))));
    if ($txt !== '') { echo $txt, "\n"; }
    $e = get_post_meta($id, '_elementor_data', true);
    if ($e) { $out = []; lgx_walk(json_decode(is_string($e) ? $e : wp_json_encode($e), true), $out); if ($out) { echo "--- elementor ---\n", implode("\n", array_unique($out)), "\n"; } }
}

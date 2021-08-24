<?php
include '../core/i.php';
header('Content-Type: application/xml');

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <?php
    foreach ($supported_langs_file as $key => $value) {
    ?>
            <url>
            <loc><?= BASE ?>/<?= $key ?></loc>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>

            <?php
                foreach ($supported_langs_file as $key_i => $value) {
                if ($key === $key_i) continue;
            ?>
                <xhtml:link rel="alternate" hreflang="<?= (empty($key_i) ? "x-default" : $key_i) ?>" href="<?= BASE ?>/<?= $key_i ?>" />
            <?php
                }
            ?>

            </url>
    <?php
        }
    ?>

</urlset>
<?php
include '../core/i.php';
header('Content-Type: application/xml');

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">

    <url>

        <loc><?= BASE ?>/</loc>

        <changefreq>weekly</changefreq>

        <priority>0.8</priority>

        <?php
        foreach ($supported_langs_file as $key => $value) {
            if (empty($key)) continue;
        ?>
            <xhtml:link rel="alternate" hreflang="<?= $key ?>" href="<?= BASE ?>/<?= $key ?>" />
        <?php
        }
        ?>

    </url>

</urlset>
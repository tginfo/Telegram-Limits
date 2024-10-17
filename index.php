<?php
require "./core/i.php";

setLang($_GET["hl"] ?? false);
if (!isset($_GET["hl"]) || $lang !== $_GET["hl"]) {
    $lang = (empty($lang) ?  $supported_langs[""] : $lang);
    header("Location: /$lang");
    exit();
}

if ($lang === "ru-RU") {
    header("Location: https://tginfo.me/limity/");
    exit();
}

$structure = json_decode(file_get_contents(__DIR__ . "/data/structure.json"), true);
$data = json_decode(file_get_contents(__DIR__ . "/localization/$lang/data.json"), true);

if (!$data && $lang !== $supported_langs[""]) {
    header("Location: /{$supported_langs[""]}");
    exit();
}

/*
$main_qa = [];

$main_qa[] = [
    "@type" => "Question",
    "name" => __("article_name"),
    "acceptedAnswer" => [
        "@type" => "Answer",
        "text" => __("article_p1") . "\n\n" . __("article_p2"),
    ],
];

foreach ($data as $section) {
    foreach ($section["items"] as $item) {
        $main_qa[] = [
            "@type" => "Question",
            "name" => $section["name"] . ": " . $item["name"] . (!isset($item["hint"]) || empty($item["hint"]) ? "" : " {$item["hint"]}"),
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => mb_ucfirst($item["text"], "utf8"),
            ],
        ];
    }
}

$markup = [
    "@context" => "https://schema.org",
    "@type" => "FAQPage",
    "name" => __("big_title"),
    "mainEntity" => $main_qa,
];
*/


?>
<!DOCTYPE html>
<html lang="<?= $lang ?>" dir="<?= ($isRtl ? "rtl" : "ltr") ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Primary Meta Tags -->
    <meta name="title" content="<?= __("title", UCOMP) ?>" data-lang="title">
    <meta name="description" content="<?= __("description", UCOMP, ["year" => date("Y")]) ?>" data-lang="description">


    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:title" content="<?= __("title", UCOMP) ?>" data-lang="title">
    <meta property="og:description" content="<?= __("description_short", UCOMP) ?>" data-lang="description_short">
    <meta property="og:image" content="<?= BASE ?>/assets/images/previews/en/preview.png" data-lang="preview">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $_SERVER['REQUEST_URI'] ?>">
    <meta property="twitter:title" content="<?= __("title", UCOMP) ?>" data-lang="title">
    <meta property="twitter:description" content="<?= __("description_short", UCOMP) ?>" data-lang="description_short">
    <meta property="twitter:image" content="<?= BASE ?>/assets/images/previews/en/twitter.png" data-lang="preview_twitter">
    
    <link rel="canonical" href="<?= BASE ?>/<?= $lang ?>" />
    <link rel="alternate" href="<?= BASE ?>/" hreflang="x-default" />
    <?php
    foreach ($supported_langs as $key => $value) {
        if (strlen($key) == 0) continue;
    ?>
        <link rel="alternate" hreflang="<?= $key ?>" href="<?= BASE ?>/<?= ($value === true ? $key : $value) ?>" />
    <?php
    }
    ?>

    <title data-lang="title"><?= __("title", UCOMP) ?></title>
    <style>
        <?= file_get_contents("./assets/styles/style.css"); ?>
    </style>
    <link rel="stylesheet" href="<?= BASE ?>/assets/styles/dark.css" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" href="<?= BASE ?>/assets/styles/print.css" media="print">
    <script>
        window.data =
            <?= json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_UNICODE) ?>
    </script>
    <script>
        <?= file_get_contents("./assets/scripts/screen.js") ?>
    </script>
    <script >
    window.requestIdleCallback =
    window.requestIdleCallback || window.requestAnimationFrame || function(f) {setTimeout(f, 0)};
    window.addEventListener("load", function() {
        var s = document.createElement("script");
        s.src = "https://www.googletagmanager.com/gtag/js?id=UA-38971936-4";
        s.async = true;
        setTimeout(function() {requestIdleCallback(function(){document.head.appendChild(s);});}, 3000);
    }, false);
    </script>
    <script>window.dataLayer = window.dataLayer || [];function gtag() {dataLayer.push(arguments);};gtag('js', new Date());gtag('config', 'UA-38971936-4', {'page_path': '/limits'});</script>
    <?php
    /*<script type="application/ld+json">
        <?= json_encode($markup); ?>
    </script>*/
    ?>
</head>

<body>
    <header>
        <div class="header-box">
            <div class="title">
                <div class="logo">
                    <a href="https://tginfo.me">
                        <picture>
                            <source srcset="<?= BASE ?>/assets/images/tginfo.webp" type="image/webp">
                            <source srcset="<?= BASE ?>/assets/images/tginfo.jpg" type="image/jpeg"> 
                            <img src="<?= BASE ?>/assets/images/tginfo.png" alt="Telegram Info logo">
                        </picture>
                        <span class="bold">Telegram</span>
                        <span class="middle">Info</span>
                    </a>
                    <span class="name" data-lang="study"><?= __("study", UCOMP) ?></span>
                </div>
                <h1 class="name" data-lang="big_title"><?= __("big_title", UCOMP) ?></h1>
            </div>
            <article class="explanator">
                <h2 class="title" data-lang="article_name"><?= __("article_name", UCOMP) ?></h2>
                <div class="content">
                    <p data-lang="article_p1"><?= __("article_p1", UCOMP) ?></p>
                    <p data-lang="article_p2"><?= __("article_p2", UCOMP) ?></p>
                </div>
            </article>
        </div>
    </header>
    <div class="backgrounder">
        <main>
            <div class="content">
                <label class="searchbox" for="search">
                    <md-icon aria-hidden="true">&#xe8b6;</md-icon>
                    <input type="search" id="search" placeholder="<?= __("search", UCOMP) ?>" autocomplete="off" value="<?= htmlentities($_GET["q"] ?? "") ?>">
                </label>

                    <script> 
                        if ( document.querySelector("main>.content").clientWidth >= 1390 && !matchMedia("print").matches) {
                        document.querySelector("main>.content").classList.add("hide");
                        } 
                    </script>

                <div id="results">
                    <?php
                    foreach ($structure as $section) {
                        if (!isset($data[$section["id"]])) continue;
                        $cur_section = $data[$section["id"]];
                    ?>

                        <div role="table" aria-label="<?= htmlentities($cur_section["name"]) ?>" class="collection" style="--vcolor:<?= htmlentities($section["color"]) ?>;">
                            <div class="header">
                                <md-icon aria-hidden="true"><?= $section["icon"] ?></md-icon>
                                <div class="name"><?= $cur_section["name"] ?></div>
                            </div>
                            <div class="card" role="rowgroup">
                                <?php
                                foreach ($section["items"] as $item) {
                                    if (!isset($cur_section["items"][$item["id"]])) continue;
                                    $cur_item = $cur_section["items"][$item["id"]];
                                ?>

                                    <div class="item" role="row">
                                        <md-icon aria-hidden="true"><?= $item["icon"] ?></md-icon>
                                        <div class="content">
                                            <div class="title" role="columnheader"><?= $cur_item["name"] ?> <span class="info"><?= $cur_item["hint"] ?></span></div>
                                            <div class="data" role="cell"><?= $cur_item["text"] ?></div>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>
    <footer>
        <div class="logo">
            <picture>
                <source srcset="<?= BASE ?>/assets/images/tginfologo.webp" type="image/webp">
                <source srcset="<?= BASE ?>/assets/images/tginfologo.jpg" type="image/jpeg"> 
                <img src="<?= BASE ?>/assets/images/tginfologo.jpg" alt="Telegram Info logo">
            </picture>
        </div>
        <div class="side">
            <div class="name">
                <span class="bold">Telegram</span>
                <span class="middle">Info</span>
                <a href="https://github.com/tginfo/Telegram-Limits/" rel="noopener" target="_blank" class="giticon footericon">
                    <img src="<?= BASE ?>/assets/images/git.svg" alt="GitHub">
                </a>
                <a title="Crowdin" target="_blank" href="https://crowdin.com/project/telegram-limits" class="footericon">
                    <img src="https://badges.crowdin.net/telegram-limits/localized.svg">
                </a>
            </div>
            <div class="data">
                <div class="content-side">
                    Proudly powered by <a href="https://t.me/tginfo" rel="noopener" target="_blank">@tginfo</a>
                </div>
            </div>
            <div class="data"><a href="https://tginfo.me/" data-lang="homepage"><?= __("homepage", UCOMP) ?></a> |
                <a href="#" onclick="return langSwitch(this, event)" id="langswitchlabel">
                    <md-icon id="langicon" aria-hidden="true">&#xe894;</md-icon>
                    <?= strtoupper(substr($lang, 0, 2)) ?>
                </a>
            </div>
            <ul id="langlist">
                <?php
                foreach ($supported_langs_file as $key => $value) {
                    if (strlen($key) == 0 || !is_array($value)) continue;
                ?>
                    <li class="lang-link<?= ($key === $lang ? " active-lang" : "") ?>">
                        <a href="/<?= $key ?>">
                            <div class="lang-code"><?= strtoupper(substr($key, 0, 2)) ?></div><?= ($value[0]) ?>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>

        </div>
    </footer>
    <script>
        <?= file_get_contents("./assets/scripts/main.js"); ?>
    </script>
</body>

</html>

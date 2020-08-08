<?php
require "./core/i.php";

setLang($_GET["hl"]);
if ($lang !== $_GET["hl"]) {
    header("Location: /$lang/");
}

$data = json_decode(file_get_contents(__DIR__ . "/data/$lang.json"), UCOMP);

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
            "name" => $section["name"] + ": " + $item["name"] + (empty($item["hint"] ? "" : " {$item["hint"]}")),
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


?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Roboto:wght@400;500&family=Material+Icons+Outlined&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE ?>/assets/styles/style.css">
    <link rel="stylesheet" href="<?= BASE ?>/assets/styles/dark.css" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" href="<?= BASE ?>/assets/styles/print.css" media="print">
    <!-- Primary Meta Tags -->
    <meta name="title" content="<?= __("title", UCOMP) ?>" data-lang="title">
    <meta name="description" content="<?= __("description", UCOMP) ?>" data-lang="description">


    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:title" content="<?= __("title", UCOMP) ?>" data-lang="title">
    <meta property="og:description" content="<?= __("description_short", UCOMP) ?>" data-lang="description_short">
    <meta property="og:image" content="<?= BASE ?>/assets/images/previews/<?= $lang ?>/preview.png" data-lang="preview">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $_SERVER['REQUEST_URI'] ?>">
    <meta property="twitter:title" content="<?= __("title", UCOMP) ?>" data-lang="title">
    <meta property="twitter:description" content="<?= __("description_short", UCOMP) ?>" data-lang="description_short">
    <meta property="twitter:image" content="<?= BASE ?>/assets/images/previews/<?= $lang ?>/twitter.png" data-lang="preview_twitter">

    <link rel="alternate" href="/<?= $supported_langs[""] ?>" hreflang="x-default" />
    <?php
    foreach ($supported_langs as $key => $value) {
        if (strlen($key) == 0) continue;
    ?>
        <link rel="alternate" hreflang="<?= $key ?>" href="/<?= ($value === true ? $key : $value) ?>" />
    <?php
    }
    ?>

    <title data-lang="title"><?= __("title", UCOMP) ?></title>
    <script>
        window.data =
            <?= json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_UNICODE) ?>
    </script>
    <script src="<?= BASE ?>/assets/scripts/screen.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-38971936-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-38971936-4', {
            'page_path': '/limits'
        });
    </script>
    <script type="application/ld+json">
        <?= json_encode($markup); ?>
    </script>
</head>

<body>
    <header>
        <div class="header-box">
            <div class="title">
                <div class="logo">
                    <a href="https://tginfo.me">
                        <img src="<?= BASE ?>/assets/images/tginfo.png" alt="Telegram Info logo">
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
                    <md-icon>search</md-icon>
                    <input type="search" id="search" placeholder="<?= __("search", UCOMP) ?>" autocomplete="off" value="<?= htmlentities($_GET["q"]) ?>">
                </label>
                <div id="results">
                    <?php
                    foreach ($data as $section) {
                    ?>

                        <div role="table" aria-label="<?= htmlentities($section["name"]) ?>" class="collection" style="--vcolor:<?= htmlentities($section["color"]) ?>;">
                            <div class="header">
                                <md-icon><?= $section["icon"] ?></md-icon>
                                <div class="name"><?= $section["name"] ?></div>
                            </div>
                            <div class="card" role="rowgroup">
                                <?php
                                foreach ($section["items"] as $item) {
                                ?>

                                    <div class="item" role="row">
                                        <md-icon><?= $item["icon"] ?></md-icon>
                                        <div class="content">
                                            <div class="title" role="columnheader"><?= $item["name"] ?> <span class="info"><?= $item["hint"] ?></span></div>
                                            <div class="data" role="cell"><?= $item["text"] ?></div>
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
            <img src="<?= BASE ?>/assets/images/tginfologo.jpg" alt="Telegram Info logo">
        </div>
        <div class="side">
            <div class="name">
                <span class="bold">Telegram</span>
                <span class="middle">Info</span>
                <a href="https://github.com/tginfo/Telegram-Limits/" target="_blank" class="giticon">
                    <img src="<?= BASE ?>/assets/images/git.svg" alt="GitHub">
                </a>
            </div>
            <div class="data">Proudly powered by <a href="https://t.me/tginfo" target="_blank">@tginfo</a></div>
            <div class="data"><a href="https://tginfo.me/" data-lang="homepage"><?= __("homepage", UCOMP) ?></a> |
                <label for="lang-switch">
                    <md-icon id="langicon">language</md-icon>
                    <select id="lang-switch">
                        <?php
                        foreach ($supported_langs_file as $key => $value) {
                            if (strlen($key) == 0 || !is_array($value)) continue;
                        ?>
                            <option value="<?= $key ?>" <?= ($key === $lang ? " selected" : "") ?>><?= ($value[0]) ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>
            </div>
        </div>
    </footer>
    <script src="<?= BASE ?>/assets/scripts/main.js"></script>
</body>

</html>
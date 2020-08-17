<?php

header("Strict-Transport-Security: max-age=63072000; includeSubDomains; preload");

if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' ||
    $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

define("BASE", "https://" . $_SERVER['HTTP_HOST']);

$lang = false;
$isRtl = false;
$lang_lib = [];


const UCOMP = 1;

function __($path = "", $opts = 0, $replacements = [])
{
    global $lang, $lang_lib;
    if ($lang === false) setLang();

    $current = $lang_lib;

    $way = explode("/", $path);
    foreach ($way as $dir) {
        $current = $current[$dir];
    }

    if (!$current) return '[' . $path . ']';

    $current = lang_replace($current, $replacements);

    return ($opts & UCOMP ? htmlspecialchars($current) : $current);
}

$supported_langs_file = json_decode(file_get_contents(__DIR__ . "/../localization/languages.json"), true);
$supported_langs = [];
foreach ($supported_langs_file as $key => $i) {
    $supported_langs[$key] = (is_array($i) ? true : $i);
}

function lang_replace($s, $o)
{
    foreach ($o as $key => $value) {
        $s = str_replace("{%" . $key . "%}", $value, $s);
    }
    return $s;
}

function lang_analyze_headers()
{
    global $supported_langs, $lang_vars;
    $header = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $langs = explode(",", $header);
    $lang_vars = [];
    $preffered = [array_keys($supported_langs)[0], 0.0];
    foreach ($langs as $v) {
        $a = explode(";", $v);
        $a[0] = substr($a[0], 0, 2);
        $a[1] = (float) str_replace("q=", "", $a[1]);
        if ($a[1] == 0) $a[1] = 1;
        if ($a[1] !== 0) {
            $lang_vars[$a[0]] = $a[1];
            if ($a[1] > $preffered[1] && in_array($a[0], array_keys($supported_langs))) $preffered = $a;
        }
    }
    return $preffered[0];
}


function setLang($l = false)
{
    global $lang, $supported_langs, $supported_langs_file, $lang_lib, $isRtl;

    if ($l !== false && in_array($l, array_keys($supported_langs))) {
        if ($supported_langs[$l] === true) {
            $lang_path = __DIR__ . "/../localization";
            if (file_exists($lang_path . '/' . $l . '/lang.json')) {
                $lang = $l;
                $isRtl = $supported_langs_file[$l][1]['isRtl'] ?? false;
                $gl = file_get_contents($lang_path . '/' . $l . '/lang.json');
                $gl = json_decode($gl, true);
                if (json_last_error() !== JSON_ERROR_NONE) exit("Language corrupted (CODE: " . $l . ")");
                $lang_lib = $gl;
            }
        } else {
            setLang($supported_langs[$l]);
        }
    } else {
        setLang(lang_analyze_headers());
    }
}

function mb_ucfirst($string, $encoding)
{
    return mb_strtoupper(mb_substr($string, 0, 1, $encoding), $encoding)
        . mb_substr($string, 1, mb_strlen($string, $encoding) - 1, $encoding);
}

<?php 
function seo($text) {
    $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
    $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
    $text = strtolower(str_replace($find, $replace, $text));
    $text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
    $text = trim(preg_replace('/\s+/', ' ', $text));
    $text = str_replace(' ', '-', $text);

    return $text;
}

 ?>

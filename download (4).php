<?php 

function canonicalpath($p) {
	$p = str_replace('//' ,'/',$p);
	$p = str_replace('/./','/',$p);
	$p = preg_replace("/\/[\w ]*\/..\//","/",$p);
	return $p;
}

$script = explode('/',str_replace('.php','.txt',$_SERVER["SCRIPT_NAME"]));
$DOWNLOAD_COUNT_FILE = $script[count($script)-1];

if(file_exists($DOWNLOAD_COUNT_FILE)) $count = @unserialize(file_get_contents($DOWNLOAD_COUNT_FILE));
else $count = array();

$fn = str_replace('%20','\ ',$_GET['FILE']);

$filename   = basename($fn);
list($n,$e) = explode(".",$filename);
$p = dirname($fn);

if(!isset($_SESSION[$n])) { if(array_key_exists($n,$count)) $count[$n]++; else $count[$n] = 1; }
else $_SESSION[$n] = 'già scaricato durante la sessione';

#$absfn = canonicalpath(str_replace(dirname($_SERVER['PHP_SELF']),"",getcwd())."$fn");
$absfn = $_SERVER["DOCUMENT_ROOT"].$fn;

#print_r($_SERVER["HTTP_REFERER"]."<br />$p<br />");
#print_r($absfn."<br />");
/*
print_r(substr($fn,1,-1)."<br />");
print_r("Location: http://{$_SERVER['HTTP_HOST']}$fn<br />");
print_r("Location: http://{$_SERVER['HTTP_HOST']}".str_replace($_SERVER['DOCUMENT_ROOT'],"",$absfn));
exit;
*/

if (is_dir($absfn)) {
	#	header("Location: http://{$_SERVER['HTTP_HOST']}/".str_replace($DOCUMENT_ROOT,"",$absfn));
		header("Location: http://{$_SERVER['HTTP_HOST']}".$fn);
	exit;
}
#else $fn = $absfn;

	
$f = @fopen($DOWNLOAD_COUNT_FILE,'w') or die('can not open the file');
@fwrite($f,serialize($count)) or die('can not write the file');
fclose($f);

if ($e=="nwc" )
	$content_type = "application/x-mwc";
if ($e=="mscz")
	$content_type = "application/x-musescore";
if ($e=="pdf" )
	$content_type = "application/pdf";
/*
print_r("$absfn<br />");
print_r($_SERVER['SERVER_SOFTWARE']."<br />");
print_r(filesize($absfn));
readfile($absfn);
exit;
*/

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");header("Cache-Control: public");
header("Content-type: $content_type");
header("Content-Disposition: inline; filename=\"$filename\"" );
#header("Content-Disposition: attachment; filename=\"$filename\"" );
header("Content-Length: ".filesize($absfn));
header("Accept-Ranges: bytes");
#readfile($filename);
readfile($absfn);
?>

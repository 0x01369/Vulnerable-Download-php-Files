<?php
$file = $_GET['file'];

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
	ini_set('zlib.output_compression', 'Off');

$path_info = pathinfo($file);
switch ($path_info['extension'])
{
	case 'pdf': $ctype="application/pdf"; break;
	default: $ctype="application/force-download";
}
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header("Content-Type: ".$ctype);
header("Content-Disposition: attachment; filename=\"".basename($file)."\";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($file));
readfile($file);
exit();
?>
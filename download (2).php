<?php

$filename = '';
$fullpath = '';
if(isset($_GET['file'])) 
{
	$fullpath = $_GET['file'];
	$filename = $fullpath;
	$index = strpos( $filename , '/' );
	if( $index != false )
	{
		$filename = substr( $filename, $index + 1 );
	}
}

header("Pragma: cache;");
header("Cache-Control: public");
header("Content-type:application/octet-stream; name=\"$fullpath\""); 
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Length: ".filesize($fullpath));

readfile($fullpath);
?>

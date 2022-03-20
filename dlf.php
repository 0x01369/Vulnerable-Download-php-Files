<?php
if(isset($_GET['file']))
{
    // $_GET['file'] 即為傳入要下載檔名的引數
    header("Content-type:application");
    header("Content-Length: " .(string)(filesize($_GET['file'])));
	//$path = "../dldldlx/".$_GET['file'];
    header("Content-Disposition: attachment; filename=".$_GET['file']);
	//header("Content-Disposition: attachment; filename=".$path);
    readfile($_GET['file']);
}
?>
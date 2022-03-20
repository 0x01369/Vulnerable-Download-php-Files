<?
$Path="/home/*/www/public_html/$user_file";

if (is_file($Path)) {
Header("Content-type:application/octet-stream");
Header("Content-Length:".filesize($Path));
Header("Content-Disposition:attachment;filename=".$user_file);
Header("Content-type:file/unknown");

Header("Content-Description:PHP3 Generated Data");

Header("Pragma: public");
Header("Expires: 0");

$fp = fopen($Path, "rb");
if (!fpassthru($fp)) fclose($fp);
clearstatcache();

} else {
echo("<script language='JavaScript'>
alert('\\n\\Create the certificate which is.\\n');
</script>");
echo ("<meta http-equiv='Refresh' content='0; URL=/index.php'>");
exit();
}
?>

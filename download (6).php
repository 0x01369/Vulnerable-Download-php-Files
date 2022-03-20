<?
if(isset($_GET['file']))
{
//$filename = $_GET['file1'];
    $basedir = $_GET['filepath']."/"; 

       
		$filename = $_GET['file'];

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression', 'Off');

// addition by Jorg Weske
$file_extension = strtolower(substr(strrchr($basedir.$filename,"."),1));

if( $filename == "" ) 
{
  echo "<html><title>eLouai's Download Script</title><body>ERROR: download file NOT SPECIFIED. USE force-download.php?file=filepath</body></html>";
  exit;
} elseif ( ! file_exists( $basedir.$filename ) ) 
{
  echo "<html><title>eLouai's Download Script</title><body>ERROR: File not found. USE force-download.php?file=filepath</body></html>";
  exit;
};
switch( $file_extension )
{
  case "pdf": $ctype="application/pdf"; break;
  case "exe": $ctype="application/octet-stream"; break;
  case "zip": $ctype="application/zip"; break;
  case "rar": $ctype="application/rar"; break;
  case "doc": $ctype="application/msword"; break;
  case "xls": $ctype="application/vnd.ms-excel"; break;
  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
  case "gif": $ctype="image/gif"; break;
  case "png": $ctype="image/png"; break;
  case "jpeg":
  case "jpg": $ctype="image/jpg"; break;
  default: $ctype="application/force-download";
}
header("Content-Type: $ctype");
header("Content-Disposition: attachment; filename=\"".$_GET['file']."\""); 
        $fp = fopen($basedir.$_GET['file'], "r"); 
        $data = fread($fp, filesize($basedir.$_GET['file'])); 
        fclose($fp); 
        print $data;



  }
?>
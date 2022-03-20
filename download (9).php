<?php

if ((isset($_GET["file"])) && ($_GET["file"] != "")) {
    $filename = $_GET["file"];
    
    
    
    // sanitize the file request, keep just the name and extension
    // also, replaces the file location with a preset one ('./myfiles/' in this example)
    $file_path  = $_REQUEST['file'];
    $path_parts = pathinfo($file_path);
    $file_name  = $path_parts['basename'];
    $file_ext   = $path_parts['extension'];
    $file_path  = '/home/*/public_html/'. $file_name;
    
    // allow a file to be streamed instead of sent as an attachment
    $is_attachment = true;
     
    // make sure the file exists
    if (is_file($file_path)) {
        
    
        $file_size  = filesize($file_path);
        //die("size of ".$file_path." is ".$file_size);
            
        $file = @fopen($file_path,"rb");
        if ($file)
        {
            //die("size of ".$file_path." is ".$file_size);
                // set the mime type based on extension, add yours if needed.
            $ctype_default = "application/pdf";
            $content_types = array(
                    "pdf" => "application/pdf",
                    "zip" => "application/zip",
                    "jpg" => "application/jpeg",
                    "png" => "application/png",
                    "xls" => "application/vnd.ms-excel",
                    "json"=> "application/json"
            );
            $ctype = isset($content_types[$file_ext]) ? $content_types[$file_ext] : $ctype_default;
    
    
    
    
            // set the headers, prevent caching
            header("Pragma: public");
            header("Expires: 0");
            header("Content-Length: " . filesize($file_path));
            header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
            header("Content-Disposition: attachment; filename=\"$filename\"");
    
            header("Content-Type: " . $ctype);
            readfile($file_path);
        
            
    } else { 
    die("file non trovato");
    }	
    
    } else { 
    die("operazione non autorizzata su path: ".$file_path);
    } 
    } else { 
    die("file non trovato");
    }

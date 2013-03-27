<?php
    $allowedExts = array("txt");
    $extension = explode(".", $_FILES["file"]["name"]);
	$extension = end($extension);

    if (($_FILES["file"]["type"] == "text/plain") && in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
            date_default_timezone_set("Asia/Brunei");
            $time = date("Y-m-d H:i:s"); 
        
            if (file_exists("upload/".$_FILES["file"]["name"]))
            {
                echo $_FILES["file"]["name"]." already exists. <br />";
                
                $myFile = "upload/".$_FILES["file"]["name"];
                $fh = fopen($myFile, 'a') or die("Can't open file");                
                $stringData = "\r\nServer updates at ".$time."\r\n";
                fwrite($fh, $stringData);
                fclose($fh);
                
                #$fileContent = readfile($myFile);
                #echo $fileContent."<br />";
            }
            else
            {
                echo "File uploaded successfully. <br />";
                
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES["file"]["name"]);
                
                $myFile = "upload/".$_FILES["file"]["name"];
                $fh = fopen($myFile, 'a') or die("Can't open file");
                $stringData = "\r\nServer updates at ".$time."\r\n";
                fwrite($fh, $stringData);
                fclose($fh);
            }
            
            echo "Upload: ".$_FILES["file"]["name"]."<br />";
            echo "Type: ".$_FILES["file"]["type"]."<br />";
            echo "Size: ".($_FILES["file"]["size"] / 1024)." kB<br />";            
            echo "Stored in: "."upload/".$_FILES["file"]["name"];
        }
    }
    else
    {
        echo "Invalid file format! <br />";
        echo "MIME type: ".$_FILES["file"]["type"]."<br />";
        echo "Uploaded file extension: ".$extension."<br />";
        
        echo "Page would be redirected in 2 seconds. <br />";
        header('Refresh: 2; url=http://172.22.41.63/Pigeon/MA/00_Temp/phonegapAPI/fileUpload.html'); 
    }
?>
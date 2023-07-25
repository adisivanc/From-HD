<?php
include "includes.php";

print_r($_POST);
echo "<br>";
print_r($_FILES);


/*if(isset($_FILES["file"]["type"]))  
{
    $validextensions = array("jpeg", "jpg", "png", "gif");
    $temporary = explode(".", $_FILES["file"]["name"]); 
    $file_extension = end($temporary);
	$newName = $_POST['driver_id'].".".$file_extension;

    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
            ) && ($_FILES["file"]["size"] < 10000000000)//Approx. 100kb files can be uploaded.
            && in_array($file_extension, $validextensions)) 
	{

        if ($_FILES["file"]["error"] > 0)
		{
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        } 
		else 
		{ 
				if (file_exists("upload/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
				} 
				else 
				{					
					$sourcePath = $_FILES['file']['tmp_name'];   // Storing source path of the file in a variable
					$targetPath = "../uploads/driver_images/".$newName;  // Target path where file is to be stored
					move_uploaded_file($sourcePath,$targetPath) ; //  Moving Uploaded file		
					
					if($_POST['driver_id']!="" && $_POST['driver_id']!="undefined") {
						$rs_update = Driver::updateDriverByfield("driver_photo", $newName, $_POST['driver_id']);
					}
					
					echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
						
				}				       
        }        
    }   
	else 
	{
        echo "<span id='invalid'>Please Choose File..!<span>";
    }
}*/
?>

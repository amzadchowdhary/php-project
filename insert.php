<?php
include '_dbconnect.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $file=$_FILES['banner_image'];
    $fileName=$_FILES['banner_image']['name'];
    $tempname=$_FILES['banner_image']['tmp_name'];
    $fileSize=$_FILES['banner_image']['size'];
    $fileError=$file['error'];
    $fileType=$file['type'];

    
    $folder=explode('.',$fileName);
    $folderActualExt=strtolower(end($folder));
    $allowed=array('jpg','jpeg', 'png','gif'); 
    if(in_array($folderActualExt,$allowed)){
        if($fileError===0){
            if($fileSize<1000000){
                $fileNameNew=uniqid('',true).".".$folderActualExt;
                $fileDestination='uploads/'.$fileNameNew;
                move_uploaded_file($tempname,$fileDestination);
                $sqlads="INSERT INTO `ads` (`Title`, `Description`, `img`,`URL` ) VALUES ( '$title', '$description', '$bannerName','$fileDestination');";
                $resultads=mysqli_query($conn, $sqlads);
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Thanks for publishing Your Ad with Us!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }else{
                echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                       <strong>Error!</strong> Your File is too big!!
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                       </div>';
            }
        }else{
            echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong>Error!</strong> There was an Error uploading your file!
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
        }
    }else{
        echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> You cannot upload files of this type!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
}

?>
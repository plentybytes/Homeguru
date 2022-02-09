<?php
$target_dir = "csvfiles/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$csvFileType = pathinfo($target_file,PATHINFO_EXTENSION);


/* Check if file already exists*/
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
/* Check file size */
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
/* Allow certain file formats */
if($csvFileType != "csv") {
    echo "Sorry, only CSV files are allowed.";
    $uploadOk = 0;
}
/* Check if $uploadOk is set to 0 by an error */
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
/* if everything is ok, try to upload file */
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";		
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?><form action="csv_import.php" method="post" ><input type="hidden" id="filename" name="filename" value="<?php echo basename($_FILES["fileToUpload"]["name"]); ?>"><input type="submit" value="Import CSV in Database" name="submit"></form>
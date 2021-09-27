<?php require('db/connect.php'); 
  require('uploadImage.php');
//   require('vendor/autoload.php');

//   use Cloudinary\Api\Upload\UploadApi;
// use Cloudinary\Configuration\Configuration;
// Configuration::instance([
//     'cloud' => [
//       'cloud_name' => 'skittube', 
//       'api_key' => '746839751365628', 
//       'api_secret' => 'Q3EKX99ChZXVRulQ_kFnhA8r1FA'],
//     'url' => [
//       'secure' => true]]);

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Test</title>
    <link rel="icon" href="img/logo.png" type="image/png" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Helvetica:wght@300;400;500;700&display=swap" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- MDB -->

</head>
<body>
      <!--Main Navigation-->

<div style="margin-bottom: 120px;"> </div>

<div class="container">


<h4> Upload Form </h4>
<hr>


<?php
if(isset($_POST['upload'])){

    $name = $_POST['name'];
    $file = $_FILES['file'];
    $resource = true;
   
    $uploaded = uploadImage($file, $resource);


?>




<?php

    
  $filename = $uploaded['original_filename'];
  $size = $uploaded['bytes'];
  $url = $uploaded['secure_url'];
  $type = $uploaded['resource_type'];


  $insert = mysqli_query($dbc, "INSERT INTO `test` VALUES (NULL, '$name', '$filename', '$size', '$type', '$url') ");

  if($insert){

    ?>

<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
  <div class="toast" style="position: absolute; top: 0; right: 0;">
    <div class="toast-header">
      <img src="..." class="rounded mr-2" alt="...">
      <strong class="mr-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>


<?php
  }else{

  }
}
?>








<form name="upload" method="POST" action="index.php"  enctype="multipart/form-data">

<div class="form-group">

<input type="text" name="name" class="form-control" placeholder="Name of the Item" required>

</div>



<div class="form-group">

<input type="file" name="file" class="form-control" required>

</div>


<div class="form-group">
<input type="submit" class="btn btn-success" value="Upload" name="upload">
</div>

</form>




<hr>


<div class="row">


<div class="col-md-6 mb-3">


<?php
$select = mysqli_query($dbc,"SELECT * FROM `test` WHERE 1 ");
if(mysqli_num_rows($select) > 0){
    $u = 1;
 while($rows = mysqli_fetch_assoc($select)){
$name = $rows['name'];
$type = $rows['type'];
$url = $rows['path'];



?>

<?php
if($type === "image"){
?>


<img src="<?php echo $url; ?>" class="img-fluid" width="500px">

<?php
}else{ 
?>

<video width="320" height="240" controls>
<source src="<?php echo $url ?>" type="video/mp4">
</video>
<?php

  }
?>


 </div>

<?php $u++; }} ?>

</div>

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
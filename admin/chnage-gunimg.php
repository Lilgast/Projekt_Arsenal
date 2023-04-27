<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{

$gunid=intval($_GET['gunid']);
$gunimg=$_FILES["gunpic"]["name"];
//currentimage
$cimage=$_POST['curremtimage'];
$cpath="gunimg"."/".$cimage;
// get the image extension
$extension = substr($gunimg,strlen($gunimg)-4,strlen($gunimg));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
//rename the image file
$imgnewname=md5($gunimg.time()).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["gunpic"]["tmp_name"],"gunimg/".$imgnewname);
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
$sql="update  tblGuns set gunImage=:imgnewname where id=:gunid";
$query = $dbh->prepare($sql);
$query->bindParam(':gunname',$gunname,PDO::PARAM_STR);
$query->bindParam(':gunid',$gunid,PDO::PARAM_STR);
$query->execute();
unlink($cpath);
echo "<script>alert('gun image updated successfully');</script>";
echo "<script>window.location.href='manage-guns.php'</script>";

}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Arsenal Management System | Edit gun</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Add gun</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md12 col-sm-12 col-xs-12">
<div class="panel panel-info">
<div class="panel-heading">
gun Info
</div>
<div class="panel-body">
<form role="form" method="post" enctype="multipart/form-data">
<?php 
$gunid=intval($_GET['gunid']);
$sql = "SELECT tblGuns.gunName,tblGuns.id as gunid,tblGuns.gunImage from  tblGuns  where tblGuns.id=:gunid";
$query = $dbh -> prepare($sql);
$query->bindParam(':gunid',$gunid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<input type="hidden" name="curremtimage" value="<?php echo htmlentities($result->gunImage);?>">
<div class="col-md-6">
<div class="form-group">
<label>gun Image</label>
<img src="gunimg/<?php echo htmlentities($result->gunImage);?>" width="100">
</div></div>

<div class="col-md-6">
<div class="form-group">
<label>gun Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="gunname" value="<?php echo htmlentities($result->gunName);?>" readonly />
</div></div>

<div class="col-md-6">  
 <div class="form-group">
 <label>gun Picture<span style="color:red;">*</span></label>
 <input class="form-control" type="file" name="gunpic" autocomplete="off"   required="required" />
 </div>
    </div>
 <?php }} ?><div class="col-md-12">
<button type="submit" name="update" class="btn btn-info">Update </button></div>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>

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
$gunname=$_POST['gunname'];
$category=$_POST['category'];
$manufacturer=$_POST['manufacturer'];
$serial=$_POST['serial'];
$price=$_POST['price'];
$gunid=intval($_GET['gunid']);
$sql="update  tblGuns set GunName=:gunname,CatId=:category,ManufacturerId=:manufacturer,GunPrice=:price where id=:gunid";
$query = $dbh->prepare($sql);
$query->bindParam(':gunname',$gunname,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':manufacturer',$manufacturer,PDO::PARAM_STR);
$query->bindParam(':price',$price,PDO::PARAM_STR);
$query->bindParam(':gunid',$gunid,PDO::PARAM_STR);
$query->execute();
echo "<script>alert('Gun info updated successfully');</script>";
echo "<script>window.location.href='manage-guns.php'</script>";


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="manufacturer" content="" />
    <title>Online Arsenal Management System | Edit Gun</title>
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
                <h4 class="header-line">Edit Firearm</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md12 col-sm-12 col-xs-12">
<div class="panel panel-info">
<div class="panel-heading">
Firearm Info
</div>
<div class="panel-body">
<form role="form" method="post">
<?php 
$gunid=intval($_GET['gunid']);
$sql = "SELECT tblGuns.GunName,tblcategory.CategoryName,tblcategory.id as cid,tblManufacturer.ManufacturerName,tblManufacturer.id as athrid,tblGuns.SERIALNumber,tblGuns.GunPrice,tblGuns.id as gunid,tblGuns.gunImage from  tblGuns join tblcategory on tblcategory.id=tblGuns.CatId join tblManufacturer on tblManufacturer.id=tblGuns.ManufacturerId where tblGuns.id=:gunid";
$query = $dbh -> prepare($sql);
$query->bindParam(':gunid',$gunid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="col-md-6">
<div class="form-group">
<label>Firearm Image</label>
<img src="gunimg/<?php echo htmlentities($result->gunImage);?>" width="100">
<a href="change-gunimg.php?gunid=<?php echo htmlentities($result->gunid);?>">Change Firearm Image</a>
</div></div>

<div class="col-md-6">
<div class="form-group">
<label>Firearm Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="gunname" value="<?php echo htmlentities($result->GunName);?>" required />
</div></div>

<div class="col-md-6">
<div class="form-group">
<label> Category<span style="color:red;">*</span></label>
<select class="form-control" name="category" required="required">
<option value="<?php echo htmlentities($result->cid);?>"> <?php echo htmlentities($catname=$result->CategoryName);?></option>
<?php 
$status=1;
$sql1 = "SELECT * from  tblcategory where Status=:status";
$query1 = $dbh -> prepare($sql1);
$query1-> bindParam(':status',$status, PDO::PARAM_STR);
$query1->execute();
$resultss=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0)
{
foreach($resultss as $row)
{           
if($catname==$row->CategoryName)
{
continue;
}
else
{
    ?>  
<option value="<?php echo htmlentities($row->id);?>"><?php echo htmlentities($row->CategoryName);?></option>
 <?php }}} ?> 
</select>
</div></div>

<div class="col-md-6">
<div class="form-group">
<label> Manufacturer<span style="color:red;">*</span></label>
<select class="form-control" name="manufacturer" required="required">
<option value="<?php echo htmlentities($result->athrid);?>"> <?php echo htmlentities($athrname=$result->ManufacturerName);?></option>
<?php 

$sql2 = "SELECT * from  tblManufacturer ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
foreach($result2 as $ret)
{           
if($athrname==$ret->ManufacturerName)
{
continue;
} else{

    ?>  
<option value="<?php echo htmlentities($ret->id);?>"><?php echo htmlentities($ret->ManufacturerName);?></option>
 <?php }}} ?> 
</select>
</div></div>


<div class="col-md-6">
<div class="form-group">
<label>SERIAL Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="serial" value="<?php echo htmlentities($result->SERIALNumber);?>"  readonly />
<p class="help-block">An SERIAL is an International Standard Gun Number.SERIAL Must be unique</p>
</div></div>


<div class="col-md-6">
 <div class="form-group">
 <label>Price in USD<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->GunPrice);?>"   required="required" />
 </div></div>
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

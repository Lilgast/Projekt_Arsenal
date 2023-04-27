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
$serialnumber=$_POST['serialnumber'];
$price=$_POST['price'];
$gunid=intval($_GET['gunid']);
$sql="update  tblGuns set gunName=:gunname,CatId=:category,manufacturerId=:manufacturer,gunPrice=:price where id=:gunid";
$query = $dbh->prepare($sql);
$query->bindParam(':gunname',$gunname,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':manufacturer',$manufacturer,PDO::PARAM_STR);
$query->bindParam(':price',$price,PDO::PARAM_STR);
$query->bindParam(':gunid',$gunid,PDO::PARAM_STR);
$query->execute();
echo "<script>alert('gun info updated successfully');</script>";
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
<form role="form" method="post">
<?php 
$gunid=intval($_GET['gunid']);
$sql = "SELECT tblGuns.gunName,tblcategory.CategoryName,tblcategory.id as cid,tblManufacturer.manufacturerName,tblManufacturer.id as athrid,tblGuns.serialnumber,tblGuns.gunPrice,tblGuns.id as gunid,tblGuns.gunImage from  tblGuns join tblcategory on tblcategory.id=tblGuns.CatId join tblManufacturer on tblManufacturer.id=tblGuns.manufacturerId where tblGuns.id=:gunid";
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
<label>gun Image</label>
<img src="gunimg/<?php echo htmlentities($result->gunImage);?>" width="100">
<a href="change-gunimg.php?gunid=<?php echo htmlentities($result->gunid);?>">Change gun Image</a>
</div></div>

<div class="col-md-6">
<div class="form-group">
<label>gun Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="gunname" value="<?php echo htmlentities($result->gunName);?>" required />
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
<label> manufacturer<span style="color:red;">*</span></label>
<select class="form-control" name="manufacturer" required="required">
<option value="<?php echo htmlentities($result->athrid);?>"> <?php echo htmlentities($athrname=$result->manufacturerName);?></option>
<?php 

$sql2 = "SELECT * from  tblManufacturer ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
foreach($result2 as $ret)
{           
if($athrname==$ret->manufacturerName)
{
continue;
} else{

    ?>  
<option value="<?php echo htmlentities($ret->id);?>"><?php echo htmlentities($ret->manufacturerName);?></option>
 <?php }}} ?> 
</select>
</div></div>


<div class="col-md-6">
<div class="form-group">
<label>serialnumber Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="serialnumber" value="<?php echo htmlentities($result->serialnumber);?>"  readonly />
<p class="help-block">An serialnumber is an International Standard gun Number.serialnumber Must be unique</p>
</div></div>


<div class="col-md-6">
 <div class="form-group">
 <label>Price in USD<span style="color:red;">*</span></label>
 <input class="form-control" type="text" name="price" value="<?php echo htmlentities($result->gunPrice);?>"   required="required" />
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

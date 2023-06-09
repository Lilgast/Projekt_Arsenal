<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['issue']))
{
$clientid=strtoupper($_POST['clientid']);
$gunid=$_POST['gunid'];
$isissued=1;
$sql="INSERT INTO  issuedgundetails(ClientID,gunId) VALUES(:clientid,:gunid);
update tblGuns set isIssued=:isissued where id=:gunid;";
$query = $dbh->prepare($sql);
$query->bindParam(':clientid',$clientid,PDO::PARAM_STR);
$query->bindParam(':gunid',$gunid,PDO::PARAM_STR);
$query->bindParam(':isissued',$isissued,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Gun issued successfully";
header('location:manage-issued-guns.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:manage-issued-guns.php');
}

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="manufacturer" content="" />
    <title>Online Arsenal Management System | Issue a new gun</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<script>
// function for get client name
function getclient() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_client.php",
data:'clientid='+$("#clientid").val(),
type: "POST",
success:function(data){
$("#get_client_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for gun details
function getgun() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_gun.php",
data:'gunid='+$("#gunid").val(),
type: "POST",
success:function(data){
$("#get_gun_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
<style type="text/css">
  .others{
    color:red;
}

</style>


</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Issue a New Firearm</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
<div class="panel panel-info">
<div class="panel-heading">
Issue a New Firearm
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Client id<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="clientid" id="clientid" onBlur="getclient()" autocomplete="off"  required />
</div>

<div class="form-group">
<span id="get_client_name" style="font-size:16px;"></span> 
</div>





<div class="form-group">
<label>Serial Number of Firearm / Equipement<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="booikid" id="gunid" onBlur="getgun()"  required="required" />
</div>

 <div class="form-group" id="get_gun_name">

 </div>
<button type="submit" name="issue" id="submit" class="btn btn-info">Issue Fireamr </button>

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

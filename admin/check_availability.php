<?php 
require_once("includes/config.php");
//code check email
if(!empty($_POST["serialnumber"])) {
$serialnumber=$_POST["serialnumber"];
$sql ="SELECT id FROM tblGuns WHERE serialnumber=:serialnumber";
$query= $dbh -> prepare($sql);
$query-> bindParam(':serialnumber', $serialnumber, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
 
if($query -> rowCount() > 0){
echo "<span style='color:red'> serialnumber already exists with another gun. .</span>"; 
echo "<script>$('#add').prop('disabled',true);</script>";
} else { echo "<script>$('#add').prop('disabled',false);</script>";}
}
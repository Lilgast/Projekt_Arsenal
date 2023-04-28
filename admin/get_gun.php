<?php 
require_once("includes/config.php");
if(!empty($_POST["gunid"])) 
  $gunid=$_POST["gunid"];
 
    $sql ="SELECT distinct tblGuns.gunName,tblGuns.id,tblManufacturer.manufacturerName,tblGuns.gunImage,tblGuns.isIssued FROM tblGuns
join tblManufacturer on tblManufacturer.id=tblGuns.manufacturerId
     WHERE (SerialNumber=:gunid || gunName like '%$gunid%')";
$query= $dbh -> prepare($sql);
$query-> bindParam(':gunid', $gunid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0){
?>
<table border ="1">

  <tr>
<?php foreach ($results as $result) {?>
    <th style="padding-left:5%; width: 10%;">
<img src="gunimg/<?php echo htmlentities($result->gunImage); ?>" width="120"><br />
      <?php echo htmlentities($result->gunName); ?><br />
    <?php echo htmlentities($result->manufacturerName); ?><br />
    <?php if($result->isIssued=='1'): ?>
<p style="color:red;">Firearm Already issued</p>
<?php else:?>
<input type="radio" name="gunid" value="<?php echo htmlentities($result->id); ?>" required>
<?php endif;?>
  </th>
    <?php  echo "<script>$('#submit').prop('disabled',false);</script>";
}
?>
  </tr>

</table>
</div>
</div>

<?php  
}else{?>
<p>Record not found. Please try again.</p>
<?php
 echo "<script>$('#submit').prop('disabled',true);</script>";
}

?>

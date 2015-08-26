<?
session_start();
if($_SESSION["strUserID"] == "")
{
header("location:http://112.121.150.67/thaistudentcare/mainmenu.php");
exit();
}
?>
<!DOCTYPE html> 
<html>
<head>
<meta charset="utf-8">
<title>jQuery Mobile Web App</title>
<link href="jquery-mobile/jquery.mobile.theme-1.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery-mobile/jquery.mobile.structure-1.0.min.css" rel="stylesheet" type="text/css"/>
<script src="jquery-mobile/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="jquery-mobile/jquery.mobile-1.0.min.js" type="text/javascript"></script>
</head> 
<body>
 
<?
$objConnect = mysql_connect("112.121.150.67","hdc","hdc") or die(mysql_error());

$objDB = mysql_select_db("db_student");
mysql_query("SET NAMES utf8", $objConnect);

$strSQL = " SELECT * FROM parent  WHERE parent_id = '".$_SESSION["strUserID"]."'";
$objQuery = mysql_query($strSQL) or die (mysql_error());

$objResult = mysql_fetch_array($objQuery);
?>

<div data-role="page" data-theme="d" id="pageMparent">
	<div data-role="header" data-theme="e">
    <a href="http://112.121.150.67/thaistudentcare/logout.php" data-icon="home" data-iconpos="notext" data-direction="reverse" >Back</a>
		<h1><font size="3" >ผู้ปกครอง : คุณ<? echo $objResult["parent_fname"];?> <? echo $objResult["parent_lname"];?></font></h1>
	</div>
<?
$strSQL2 = "SELECT
a.parent_id,c.level_id,b.stud_id,c.level_name,b.stud_fname,a.parent_fname,a.parent_lname,b.stud_prefix,b.stud_lname
FROM parent a INNER JOIN (student b,level c)
ON (a.parent_id=b.parent_id AND b.level_id=c.level_id)
WHERE a.parent_id = '".$_SESSION["strUserID"]."'";
$objQuery2 = mysql_query($strSQL2) or die (mysql_error());
?>   

	<div data-role="content">	
    <div align="center">
      <img src="pic/mparent.png" width="250" height="80"> 			</div>
		<ul data-inset="true" data-role="listview" data-theme="e">
<?
while($objResult2 = mysql_fetch_array($objQuery2)) {
?>
  <li><a href="#">
    <h3><font size="4" ><? echo $objResult2["stud_prefix"]?><? echo $objResult2["stud_fname"]?>  <? echo $objResult2["stud_lname"]?> </font><br> <font size="3" >เลขบัตรประชาชน</font> <font size="2" >: <? echo $objResult2["stud_id"]?></font></h3>
    <p><font size="3" >ระดับชั้น มัธยมศึกษาปีที่ </font><font size="2" ><? echo $objResult2["level_name"]?></font></p>
  </a><a href="http://112.121.150.67/thaistudentcare/detailparent.php?sid=<?=$objResult2["stud_id"];?>">รายละเอียด</a></li>
<?
}
?> 
</ul>
	</div>
</div>

</body>
</html>
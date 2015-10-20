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

$objDB = mysql_select_db("student_db_urrw");
mysql_query("SET NAMES utf8", $objConnect);

$strSQL = "SELECT
a.*, b.*, c.*, d.*
FROM student a INNER JOIN (department b,teacher c, grade d)
ON (b.dep_id=d.dep_id AND c.teach_id=d.teach_id AND a.stud_id = d.stud_id)

WHERE d.teach_id = '".$_GET["tid"]."' AND d.dep_id = '".$_GET["did"]."'" ;
$objQuery = mysql_query($strSQL) or die (mysql_error());


$objResult = mysql_fetch_array($objQuery);
?>   

<div data-role="page" id="pageTdeatail">
	
	 <div data-role="header" data-theme="e">
    <a href="http://112.121.150.67/thaistudentcare/mainparent.php" data-icon="back" data-iconpos="notext" data-direction="reverse" >Back</a>
		<h1><font size="2" >ชื่อนักเรียน : <? echo $objResult["stud_prefix"];?><? echo $objResult["stud_fname"];?> <? echo $objResult["stud_lname"];?></font></h1>
	</div>
	<div data-role="content">	
		<div style="padding-left:10px;padding-right:10px">
 
<div align="right">
      <img src="pic/detailgrade.png" width="250" height="80"> 			</div>
 
 <div data-role="fieldcontain">
		<label for="name">วิชา :</label>
			<? echo $objResult["dep_name"];?>
	</div>
   
	<div data-role="fieldcontain">
		<label for="name">เกรด :</label>
			<? echo $objResult["grade_level"];?>
	</div>
     <div data-role="fieldcontain">
		<label for="name">คะแนนรวม :</label>
			<? echo $objResult["grade_total"];?> คะแนน
	</div>
	<div data-role="fieldcontain">
		<label for="name">ครูผู้สอน :</label>
			<? echo $objResult["teach_prefix"];?><? echo $objResult["teach_fname"];?> <? echo $objResult["teach_lname"];?>
	</div>
    <div data-role="fieldcontain">
		<label for="name">เบอร์ติดต่อ : </label>
			<? echo $objResult["teach_tel"];?>
	</div>
    
	
        <font size="4" color="#990000"><a href="http://112.121.150.67/thaistudentcare/mainparent.php" data-icon="grid" data-role="button" data-theme="e">เมนูหลักผู้ปกครอง</a></font>
				



</body>
</html>
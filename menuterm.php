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
<link href="jquery.mobile.theme-1.0.min.css" rel="stylesheet" type="text/css"/>
<link href="jquery.mobile.structure-1.0.min.css" rel="stylesheet" type="text/css"/>
<script src="jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="jquery.mobile-1.0.min.js" type="text/javascript"></script>
</head> 
<body> 

<?
$objConnect = mysql_connect("112.121.150.67","hdc","hdc") or die(mysql_error());

$objDB = mysql_select_db("student_db_urrw");
mysql_query("SET NAMES utf8", $objConnect);

$strSQL = " SELECT * FROM parent  WHERE parent_id = '".$_SESSION["strUserID"]."'" ;
$objQuery = mysql_query($strSQL) or die (mysql_error());

$objResult = mysql_fetch_array($objQuery);
?>
 
<div data-role="page" id="pageMenuterm">
	 <div data-role="header" data-theme="e">
    <a href="http://112.121.150.67/thaistudentcare/mainparent.php" data-icon="back" data-iconpos="notext" data-direction="reverse" >Back</a>
		<h1><font size="2" >ผู้ปกครอง : คุณ<? echo $objResult["parent_fname"];?> <? echo $objResult["parent_lname"];?></font></h1>
	</div>
<?
$strSQL2 = "SELECT
a.*, b.*, c.*, d.*
FROM student a INNER JOIN (department b,teacher c, grade d)
ON (b.dep_id=d.dep_id AND c.teach_id=d.teach_id AND a.stud_id = d.stud_id)

WHERE a.stud_id = '".$_GET["sid"]."' 
GROUP BY d.grade_term  DESC";
$objQuery2 = mysql_query($strSQL2) or die (mysql_error());

?>
   
	<div data-role="content">	
    <div align="center">
      <img src="pic/gradeterm.png" width="250" height="80"> 			</div>
		<ul data-inset="true" data-role="listview" data-theme="e">
<?
while($objResult2 = mysql_fetch_array($objQuery2)) {
?>
  <li><a href="#">
    <h3><font size="4" ><? echo $objResult2["grade_term"]?> </font></h3>
  </a>
  <a href="http://112.121.150.67/thaistudentcare/gradedetail.php?sid=<?=$objResult2["stud_id"]?>&gtm=<?=$objResult2["grade_term"];?>">ผลการเรียน</a></li>
<?
}
?> 
</ul>
	</div>
	 <div data-role="footer" data-theme="e" data-position="fixed">
		<div data-role="navbar">
          <ul>
          <li><a href="http://112.121.150.67/thaistudentcare/mainparent.php"><font size="4">หน้าหลักผู้ปกครอง</font></a></li>
            <li><a href="http://112.121.150.67/thaistudentcare/logout.php"><font size="4">ออกจากระบบ</font></a></li>
           
          </ul>
        </div>
  </div>
</div>



</body>
</html>
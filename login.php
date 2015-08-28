<?
session_start();
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

$strSQL = " SELECT * FROM parent  WHERE parent_username = '".$_POST["txtUsername"]."' AND parent_password = '".$_POST["txtPassword"]."' "; 
$objQuery = mysql_query($strSQL) or die (mysql_error());

$objResult = mysql_fetch_array($objQuery);
?>

<div data-role="page" data-theme="d" id="pageLogin">
	<div data-role="header" data-theme="e">
   <a href="http://112.121.150.67/thaistudentcare/logout.php" data-icon="home" data-iconpos="notext" data-direction="reverse" >Back</a>
<h1><font size="5">เข้าสู่ระบบ</font></h1>
		
	</div>


<?

if(!$objResult)

{
	
?>
<div align="center">

      <img src="pic/notuser.png" width="240" height="120"> 			</div>
<font size="4" ><a href="http://112.121.150.67/thaistudentcare/mainmenu.php" data-icon="back" data-role="button" data-theme="e">ลองอีกครั้ง</a></font>
<?
}
else
{
$_SESSION["strUserID"] = $objResult["parent_id"];
?>

	<div style="padding-left:10px;padding-right:10px">
		
        <div align="center">
      <img src="pic/welcome.png" width="240" height="120"> </div>
		<div data-role="fieldcontain" align="center">
			<font size="4" color="#990000"><label for="name">ชื่อผู้ปกครอง : คุณ</label><? echo $objResult["parent_fname"];?> <? echo $objResult["parent_lname"];?></font>
		</div>
        <div data-role="fieldcontain" align="center">
			<font size="4" color="#990000"><label for="name">เลขบัตรประชาชน</font> <font size="3" color="#990000">: <? echo $objResult["parent_id"];?></font>
		</div>
		<font size="4" color="#990000"><a href="http://112.121.150.67/thaistudentcare/mainparent.php" data-icon="grid" data-role="button" data-theme="e">เข้าสู่หน้าหลักผู้ปกครอง</a></font>
    </div>    

<?
}
?>


 
</div>



</body>
</html>
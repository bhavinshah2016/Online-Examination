<?php
session_start();
error_reporting(0);
extract($_POST);
extract($_SESSION);
include("database.php");
if($submit=='Finish')
{
	mysql_query("delete from mst_useranswer where sess_id='" . session_id() ."'") or die(mysql_error());
	unset($_SESSION[qn]);
	header("Location: index.php");
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Review</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="quiz.css" rel="stylesheet" type="text/css">
</head>

<body>

 <div class="container">
  <div class="row">
    <div class="col-sm-4">
      
    </div>
    <div class="col-sm-4"  style="padding: 20px; border: 2px solid black; float: middle; margin-right:auto; margin-left: auto;">
	
<?php
include("header.php");
echo "<h2 class=style8> Here are the correct answers: </h2>"."<br>";

if(!isset($_SESSION[qn]))
{
		$_SESSION[qn]=0;
}
else if($submit=='Next Question' )
{
	$_SESSION[qn]=$_SESSION[qn]+1;
	
}

$rs=mysql_query("select * from mst_useranswer where sess_id='" . session_id() ."'",$cn) or die(mysql_error());
mysql_data_seek($rs,$_SESSION[qn]);
$row= mysql_fetch_row($rs);
echo "<form name=myfm method=post action=review.php>";
echo "<table width=100%> <tr> <td width=30>&nbsp;<td> <table border=0>";
$n=$_SESSION[qn]+1;
echo "<tR><td><span align='center' class=style8>Que ".  $n .": $row[2]</style>";
echo "<tr><td align='center' class=".($row[7]==1?'tans':'style88').">$row[3]"."<br><br>";
echo "<tr><td class=".($row[7]==2?'tans':'style88').">$row[4]"."<br><br>";
echo "<tr><td class=".($row[7]==3?'tans':'style88').">$row[5]"."<br><br>";
echo "<tr><td class=".($row[7]==4?'tans':'style88').">$row[6]"."<br><br>";
if($_SESSION[qn]<mysql_num_rows($rs)-1)
echo "<tr><td><input type=submit name=submit value='Next Question'></form>";
else
echo "<tr><td><input type=submit name=submit value='Finish'></form>";

echo "</table></table>";

?>
</div>    
         
    </div>



    <div class="col-sm-4">
      
    </div>
  </div>
</div>









</body>
</html>
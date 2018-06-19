<?php
$show = 1;
if($_POST['answer']=="2")
{
	echo "<center><img src=\"correct.gif\"/></center>";
	//header("Location:page5.php");
//	echo "<center><a href=\"page5.php\">Next</a></center>";
	$show = 0;
}
?>
<html>
<head>
<script type="text/javascript" src="Jmol.js"></script>
<script type="text/javascript">
function myCallback(a, b, c, d) {
alert("myCallback a="+a+" b="+b+" c="+c+" d="+d)
}
</script>
</head>

<body>
<center><h2><font color="blue">Analysis</font></h2></center>
<?php if($_POST['answer']!="2" && isset($_POST['answer']))
echo "<center><img src=\"wrong.gif\"/>&nbsp;Try again or skip.</center>";?>

<form action="page5.php" method="post">
<table width="900" style="padding-left:20px;">
<tr>
<td>
<table>
<th>ORD Curves</th>
<?php if($show) { ?>
<tr>
<td>
<img src="images/graph1.jpg" width="300" height="200"/></td>
<td><input type="radio" name="answer" value="1"/></td>
</tr>
<?php } ?>

<tr>
<td>
<img src="images/graph3.jpg" width="300" height="200"/></td>
<?php if($show) { ?> <td><input type="radio" name="answer" value="2"/></td> <?php } ?>
</tr>
</table>
</td>

<td><center><b>CD Curve</b><center><br/><img src="images/graph4.jpg" width="300" height="200"/></td>
</table>

<table>
<center>
<?php if($show){?>
<input type="submit" name="submit" value="Submit"/>
<a href="final.php"><input type="submit" value="Skip"/></a>
<?php } else echo "<a href=\"final.php\"><input type=\"submit\" value=\"Next\"/></a>";?>

</center>

</td></tr></table>
</form>

</body>
</html>

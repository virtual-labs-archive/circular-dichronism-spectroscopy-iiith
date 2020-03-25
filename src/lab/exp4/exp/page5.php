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
<script class='gtm'>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-W59SWTR');</script>

<script type="text/javascript" src="Jmol.js"></script>
<script type="text/javascript">
function myCallback(a, b, c, d) {
alert("myCallback a="+a+" b="+b+" c="+c+" d="+d)
}
</script>
</head>

<body>
<center><h2><font color="blue">ANALYSIS</font></h2></center>
<center><h3><font color="green">Match the CD curve with the corresponding ORD curve.</font></h3></center>
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
<a href="final.php"><input type="button" value="Skip"/></a>
<?php } else echo "<a href=\"final.php\"><input type=\"submit\" value=\"Next\"/></a>";?>

</center>

</td></tr></table>
</form>

</body>
</html>

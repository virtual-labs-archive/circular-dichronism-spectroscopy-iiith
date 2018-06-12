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
<center><h1><font color="blue">Analysis</font></h1>
<h2>INFORMATION : R-spiroacytal has -ve ORD curves</h2></center>
<?php if($_POST['answer']!="2" && isset($_POST['answer']))
echo "<center><img src=\"wrong.gif\"/>&nbsp;Try again or skip.</center>";?>

<table width="1000" style="padding-left:20px;">
<tr><td>
<script type="text/javascript">
//jmolInitialize(".","http://chemapps.stolaf.edu/pe/protexpl/molview/JmolAppletSigned.jar")
jmolInitialize(".","JmolAppletSigned.jar")


var xxxx = document.location.search
if (xxxx.length == 5 || xxxx.length == 0) {
	xxxx = (xxxx + "?1crn").substring(1,5)
	script = 'set animframecallback "jmolscript:if (!selectionHalos) {select model=_modelNumber}";'
	+'set errorCallback "myCallback";'
	+'set defaultloadscript "isDssp = false;set defaultVDW babel";'
	+'set zoomlarge false;set echo top left;echo loading XXXX...;refresh;'
	+'load "pdbs/XXXX.pdb";set echo top center;echo XXXX;'
	+'spacefill off;wireframe off;cartoons on;color structure;'
	script = script.replace(/XXXX/g, xxxx)
} else {
	script = unescape(xxxx.substring(1))
}

jmolApplet(["300","300"],"load pdbs/sample2.pdb")
</script>
</td>
<td>

<form action="page5.php" method="post">
<table>
<?php if($show){?>
<tr>
<td><img src="images/graph1.jpg" width="300" height="200"/></td>
<?php }?>

<td><img src="images/graph2.jpg" width="300" height="200"/></td>
</tr>

<?php if($show){?>
<tr>
<td style="padding-left:150px;"><input type="radio" name="answer" value="1"/><br/> <br/></td>
<td style="padding-left:150px;"><input type="radio" name="answer" value="2"/><br/> <br/></td>
</tr>
<?php } ?>

<tr>
<?php if($show){?>
<td><img src="images/graph3.jpg" width="300" height="200"/></td>
<td><img src="images/graph4.jpg" width="300" height="200"/></td>
<?php }?>
</tr>

<?php if($show){?>
<tr>
<td style="padding-left:150px;"><input type="radio" name="answer" value="3"/></td>
<td style="padding-left:150px;"><input type="radio" name="answer" value="4"/></td>
</tr>
<?php } ?>

</table><br/>
<center>
<?php if($show){?>
<input type="submit" name="submit" value="Submit"/>
<a href="page6.php"><input type="submit" value="Skip"/></a>
<?php } else echo "<a href=\"page6.php\"><input type=\"submit\" value=\"Next\"/></a>";?>

</center>
</form>
</td></tr></table>

</body>
</html>

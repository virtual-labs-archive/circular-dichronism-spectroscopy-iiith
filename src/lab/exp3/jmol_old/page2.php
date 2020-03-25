<?php
if(isset($_POST['submit']))
{
	if($_POST['sample1']=="R" && $_POST['sample2']=="R" && $_POST['sample3']=="S" && $_POST['sample4']=="S")
	{
		header("Location:list.php");
	}
	else
	{
		echo "<center><font color=\"red\"><h1>All the choices are not correct.</h1></font></center>";
	}
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

<center><h2><font color="blue">Assigning R & S Configuration</font></h2></center>
<form action="page2.php" method="post">
                                                                                
<table width="100%"><tr><td>
<!-- <center> -->
<table style="padding-left:50px;">
<tr>
<td>

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
	+'load "http://www.rcsb.org/pdb/files/XXXX.pdb";set echo top center;echo XXXX;'
	+'spacefill off;wireframe off;cartoons on;color structure;'
	script = script.replace(/XXXX/g, xxxx)
} else {
	script = unescape(xxxx.substring(1))
}

jmolApplet(["300","300"],"load pdbs/sample1.pdb;set echo top center;echo Sample 1;select atomno=1; cpk -25; color atom magenta;select atomno=6; cpk -25; color atom magenta")
</script>
</td>



<td>
<input type="radio" name="sample1" value="R">R<br/>
<input type="radio" name="sample1" value="S">S
</td>
</tr>

<tr>
<td>
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
	+'load "http://www.rcsb.org/pdb/files/XXXX.pdb";set echo top center;echo XXXX;'
	+'spacefill off;wireframe off;cartoons on;color structure;'
	script = script.replace(/XXXX/g, xxxx)
} else {
	script = unescape(xxxx.substring(1))
}

jmolApplet(["300","300"],"load pdbs/sample2.pdb;set echo top center;echo Sample 2;select atomno=2; cpk -25; color atom magenta;select atomno=4; cpk -25; color atom magenta")
</script>
</td>



<td>
<input type="radio" name="sample2" value="R">R<br/>
<input type="radio" name="sample2" value="S">S
</td>

</tr>


<!-- ----------------------------------------------------------->
<tr>
<td>

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
	+'load "http://www.rcsb.org/pdb/files/XXXX.pdb";set echo top center;echo XXXX;'
	+'spacefill off;wireframe off;cartoons on;color structure;'
	script = script.replace(/XXXX/g, xxxx)
} else {
	script = unescape(xxxx.substring(1))
}

jmolApplet(["300","300"],"load pdbs/sample3.pdb;set echo top center;echo Sample 3;select atomno=3; cpk -25; color atom magenta;select atomno=2; cpk -25; color atom magenta")
</script>
</td>



<td>
<input type="radio" name="sample3" value="R">R<br/>
<input type="radio" name="sample3" value="S">S
</td>
</tr>


<tr>
<td>

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
	+'load "http://www.rcsb.org/pdb/files/XXXX.pdb";set echo top center;echo XXXX;'
	+'spacefill off;wireframe off;cartoons on;color structure;'
	script = script.replace(/XXXX/g, xxxx)
} else {
	script = unescape(xxxx.substring(1))
}

jmolApplet(["300","300"],"load pdbs/sample4.pdb;set echo top center;echo Sample 4;select atomno=2; cpk -25; color atom magenta;select atomno=6; cpk -25; color atom magenta")
</script>
</td>



<td>
<input type="radio" name="sample4" value="R">R<br/>
<input type="radio" name="sample4" value="S">S
</td>

</tr></table>
</td><td style="padding-bottom:600px;padding-left:100px;">
<!-- <center> -->

<table border="1" cellspacing="0">
<th colspan="4">JMol Instructions</th>
<tbody><tr align="center" bgcolor="yellow">
 <td><br></td>
 <td><b>main button</b></td>
 <td><b>middle button</b></td>
 <td><b>secondary button</b></td>
</tr>
<tr align="center" bgcolor="yellow">
 <td><br></td>
 <td>(left)</td>
 <td>(middle)</td>
 <td>(right)</td>
</tr>
<tr>
 <td colspan="4"><br></td>
</tr>
<tr>
 <td><b>Open Jmol menu</b></td>
 <td>Ctrl + click<br>or click on 'Jmol' logo</td>
 <td><br></td>
 <td>click</td>
</tr>
<tr>
 <td colspan="4"><br></td>
</tr>
<tr>
 <td><b>Rotate around X,Y</b></td>
 <td>drag</td>
 <td><br></td>
 <td><br></td>
</tr>
<tr>
 <td colspan="4"><br></td>
</tr>
<tr>
 <td><b>Move along X,Y (= translate)</b></td>
 <td>Shift + double-click and drag</td>
 <td>double-click and drag</td>
 <td>Ctrl + drag</td>
</tr>
<tr>
 <td><br></td>
 <td colspan="3" align="center"><i>works both when clicking on the molecule or away from it</i></td>
</tr>
<tr>
 <td colspan="4"><br></td>
</tr>
<tr>
 <td><b>Reset and centre</b></td>
 <td>Shift + double-click*</td>
 <td>double-click*</td>
 <td><br></td>
</tr>
<tr>
 <td><br></td>
 <td colspan="3" align="center"><i>*only works if double-click is done away from the molecule</i></td>
</tr>
<tr>
 <td colspan="4">
<br></td></tr>
<tr>
 <td><b>Rotate around Z</b></td>
 <td>Shift + drag horizontally</td>
 <td>drag horizontally</td>
 <td>Shift + drag horizontally<br>(possibly fails in Mac's)</td>
</tr>
<tr>
 <td colspan="4"><br></td>
</tr>
<tr>
 <td><b>Zoom in / out</b></td>
 <td>Shift + drag vertically</td>
 <td>drag vertically</td></tr></tbody></table>

<br/><br/>
<table width="400" align="right">
<tr>
<td><input type="submit" value="Submit" name="submit" style="width:100px;font-size:16;"/></td>
<td><a href="list.php"><input type="submit" value="Skip" style="width:100px;font-size:16;"/></a></td>
</tr>
</table>

</td></tr></table>

</form>
</body>
</html>

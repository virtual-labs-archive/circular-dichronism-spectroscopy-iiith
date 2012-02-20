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
                                                                                    

<center>
<h2><font color="blue">Understanding Structure of Chiral Molecules</font></h2>
<h3><font color="green">Find out the chiral center and colour the asymmetric carbon in both samples.</font></h3>
<table>

<tr>
<td></td><td></td><td></td><td align="right">
<a href="help.php" target="_blank"><input type="button" value="Help" style="width:100px;font-size:20;"/></a>
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
	+'load "pdbs/XXXX.pdb";set echo top center;echo XXXX;'
	+'spacefill off;wireframe off;cartoons on;color structure;'
	script = script.replace(/XXXX/g, xxxx)
} else {
	script = unescape(xxxx.substring(1))
}

//jmolApplet(["300","300"],"load pdbs/4R_6R-Spiroacetal-alcohol.pdb;set echo top center;echo Sample 1;select atomno=1; cpk -25; color atom magenta;select atomno=5; cpk -25; color atom magenta")
jmolApplet(["300","300"],"load sample/sample1/sample1.pdb;set echo top center;echo Sample 1;")
</script>
</td>



</table>

</body>
</html>

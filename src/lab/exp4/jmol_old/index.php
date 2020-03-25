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
                                                                                    

<center>
<h2><font color="blue">Understanding Structure of Chiral Molecules</font></h2>

<br/><br/>
<table>
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

jmolApplet(["300","300"],"load pdbs/sample1.pdb;set echo top center;echo Sample 1;select atomno=3; cpk -40; color atom magenta")
</script>
</td>



<td>
<script type="text/javascript">
_jmol.buttonCssText="style='width:120'"
jmolButton("load ?","Load FILE")
jmolBr()
jmolButton("write IMAGE ?.jpg","Save JPG")
</script>

<script type="text/javascript">
jmolBr()
_jmol.buttonCssText="style='width:120'"
jmolButton("color cpk")
jmolBr()
jmolButton("spacefill only;spacefill 23%;wireframe 0.15","ball&stick")
jmolBr()
_jmol.buttonCssText="style='width:100'"
jmolButton("console")
_jmol.CommandInputCssText="style='width:100'"
jmolCommandInput()
</script>
</td>

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

jmolApplet(["300","300"],"load pdbs/sample2.pdb;set echo top center;echo Sample 2;select atomno=4; cpk -40; color atom magenta")
</script>
</td>



<td>
<script type="text/javascript">
_jmol.buttonCssText="style='width:120'"
jmolButton("load ?","Load FILE")
jmolBr()
jmolButton("write IMAGE ?.jpg","Save JPG")
</script>

<script type="text/javascript">
jmolBr()
_jmol.buttonCssText="style='width:120'"
jmolButton("color cpk")
jmolBr()
jmolButton("spacefill only;spacefill 23%;wireframe 0.15","ball&stick")
jmolBr()
_jmol.buttonCssText="style='width:100'"
jmolButton("console")
_jmol.CommandInputCssText="style='width:100'"
jmolCommandInput()
</script>
</td>

</tr>

</table>

<br/><br/>
<a href="page2.php"><input type="submit" value="Next" style="width:100px;font-size:20;"/></a>
<center>
</body>
</html>

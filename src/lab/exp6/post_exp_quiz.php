<html>
<head>
<script class='gtm'>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-W59SWTR');</script>

<style type="text/css">
*{
	font-family: Verdana, calibri;
}

#content{
	margin : auto;
	width: 900px;
}
.boundingBox{	
	text-align:center;
	background:#cccfff;
	padding: 15px 2px 15px 2px;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-box-shadow: 10px 10px 5px #888;
	-webkit-box-shadow: 10px 10px 5px #888;
	box-shadow: 10px 10px 5px #888;	
}
tr .boundingBox {
	width:100px;
}
.boundingBox1{	
	text-align:center;
	background:#cccfff;
	padding: 5px 5px 5px 5px;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-box-shadow: 5px 5px 5px #888;
	-webkit-box-shadow: 5px 5px 5px #888;
	box-shadow: 5px 5px 5px #888;
}
#go{
	clear:both;
	float:right;
	width:200px;
	font-weight:bold;
	color: green;
	-moz-box-shadow: 5px 5px 5px #888;
	-webkit-box-shadow: 5px 5px 5px #888;
	box-shadow: 5px 5px 5px #888;	
}
</style>
<script type="text/javascript">
function getOptions(opt){
	var options = "";
	for(var i = parseInt(opt) ; i <= 100 ; i += 5){
		if(i == 100){	
			options =  options + "<option value='"+i+"' selected='true'>"+i+" C</option>\n";
		}
		else{
			options =  options + "<option value='"+i+"'>"+i+" C</option>\n";
		}
	}
	document.getElementById("end").innerHTML = options;
}
</script>
</head>
<body>
<div id="content">
  <h1 class="boundingBox">Answer The Following Questions</h1><br>

  <form name="quiz" action="post_exp_quiz.php" method="POST">
  <ol>
  <table>
  <tr><td width=70%>
    <li>
	 In proteins the chiral center is present at:
      <ol type="A">
	 <li><input type="radio" name="q1" value="A">Nitrogen of amino group.</li>
	 <li><input type="radio" name="q1" value="B">Carbon of carboxyl group.</li>
	 <li><input type="radio" name="q1" value="C">Alpha carbon.</li>
	 <li><input type="radio" name="q1" value="D">Oxygen in carbonyl group.</li>
      </ol>
    </li>
<br>	<?php 
	if($_POST){
		echo "</td><td width=30%>";
		if($_POST['q1'] == "C"){
			echo "<span style='color:green'>(".$_POST['q1'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q1'].") IS NOT CORRECT ! CORRECT answer is (C).</span>";
		}
	}
	?>
  </td></tr>
  <tr><td>
    <li>
	 CD signals in the far UV region(180-250nm) are helpful for secondary structure analysis due to
      <ol type="A">
	 <li><input type="radio" name="q2" value="A">Peptide bond absorption.</li>
	 <li><input type="radio" name="q2" value="B">Aromatic side chain absorption.</li>
	 <li><input type="radio" name="q2" value="C">Disulphide bond absorption.</li>
	 <li><input type="radio" name="q2" value="D">None of the above are correct</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q2'] == "A"){
			echo "<span style='color:green'>(".$_POST['q2'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q2'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 CD signals in the near UV region(250-320 nm) provide tertiray structural information due to?
      <ol type="A">
	 <li><input type="radio" name="q3" value="A">Peptide bond absorption.</li>
	 <li><input type="radio" name="q3" value="B">Aromatic side chain absorption.</li>
	 <li><input type="radio" name="q3" value="C">Disulphide bond absorption.</li>
	 <li><input type="radio" name="q3" value="D">All of the above are correct</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q3'] == "B"){
			echo "<span style='color:green'>(".$_POST['q3'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q3'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
    <li>
	 Electronic transition taking place at 220nm
      <ol type="A">
	 <li><input type="radio" name="q4" value="A">n - &pi;*.</li>
	 <li><input type="radio" name="q4" value="B">&pi;- &pi;*.</li>
	 <li><input type="radio" name="q4" value="C">Both of the above.</li>
	 <li><input type="radio" name="q4" value="D">None of the above are correct.</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q4'] == "A"){
			echo "<span style='color:green'>(".$_POST['q4'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q4'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 Electronic transition taking place at 190nm
      <ol type="A">
	 <li><input type="radio" name="q5" value="A">n - &pi;*.</li>
	 <li><input type="radio" name="q5" value="B">&pi;- &pi;*.</li>
	 <li><input type="radio" name="q5" value="C">Both A and B.</li>
	 <li><input type="radio" name="q5" value="D">None of the above.</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q5'] == "B"){
			echo "<span style='color:green'>(".$_POST['q5'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q5'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	The &pi;--> &pi;* transition shows negative peak in which of the following secondary structures
      <ol type="A">
	 <li><input type="radio" name="q6" value="A">Alpha helix.</li>
	 <li><input type="radio" name="q6" value="B">Beta sheet.</li>
	 <li><input type="radio" name="q6" value="C">Random coil.</li>
	 <li><input type="radio" name="q6" value="D">None of the above.</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q6'] == "B"){
			echo "<span style='color:green'>(".$_POST['q6'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q6'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
	}
	?>
  </td></tr>
   
</table>
  </ol>
	
	<?php	if(!$_POST){ ?>
	<input type="submit" id="go" class="boundingBox" value="SUBMIT"><br><br><Br>
	<?php }?>
	</form>
<center><button class="boundingBox1" onclick='window.location="./swf.html";'><strong>Back To Experiment<string></button>
<t><button class="boundingBox1" onclick='window.location="./index.html";'><strong>Back To Theory<string></button></center>


</div>
</body>
</html>


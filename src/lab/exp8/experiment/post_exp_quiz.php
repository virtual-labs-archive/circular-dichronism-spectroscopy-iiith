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
	 In the animation protein at which temperature starts unfolding the first?
      <ol type="A">
	 <li><input type="radio" name="q1" value="A">298K</li>
	 <li><input type="radio" name="q1" value="B">358K</li>
	 <li><input type="radio" name="q1" value="C">388K</li>
	 <li><input type="radio" name="q1" value="D">418K</li>
      </ol>
    </li>

<br>	<?php 
	if($_POST){
		echo "</td><td width=30%>";
		if($_POST['q1'] == "D"){
			echo "<span style='color:green'>(".$_POST['q1'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q1'].") IS NOT CORRECT ! CORRECT answer is (D).</span>";
		}
	}
	?>
  </td></tr>
  <tr><td>
    <li>
	 From the readings of CD spectrum at 222nm we can have information about which secondary structure?
      <ol type="A">
	 <li><input type="radio" name="q2" value="A">Sheet</li>
	 <li><input type="radio" name="q2" value="B">Turn</li>
	 <li><input type="radio" name="q2" value="C">Helix</li>
	 <li><input type="radio" name="q2" value="D">Coil</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q2'] == "C"){
			echo "<span style='color:green'>(".$_POST['q2'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q2'].") IS NOT CORRECT ! CORRECT answer is (C).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	 How does the plot of  MRE values at 222 nm with temperature looks like?
      <ol type="A">
	 <li><input type="radio" name="q3" value="A">Linear</li>
	 <li><input type="radio" name="q3" value="B">Sigmoid</li>
	 <li><input type="radio" name="q3" value="C">Elliptic</li>
	 <li><input type="radio" name="q3" value="D">Parabolic</li>
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
	 What is the trend of change of % helicity in Rhodopsin with temperature?
      <ol type="A">
	 <li><input type="radio" name="q4" value="A">does non change at all,</li>
	 <li><input type="radio" name="q4" value="B">gradually decrease,</li>
	 <li><input type="radio" name="q4" value="C">gradually increase,</li>
	 <li><input type="radio" name="q4" value="D">first increase and then decrease</li>
      </ol>
    </li><br>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q4'] == "B"){
			echo "<span style='color:green'>(".$_POST['q4'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q4'].") IS NOT CORRECT ! CORRECT answer is (B).</span>";
		}
	}
	?>
  </td></tr>

  <tr><td>
     <li>
	  What is the transition temperature (the temperature at which the protein goes from a folded to an unfolded state) of Rhodopsin?
      <ol type="A">
	 <li><input type="radio" name="q5" value="A">70 degree C</li>
	 <li><input type="radio" name="q5" value="B">50 degree C</li>
	 <li><input type="radio" name="q5" value="C">100 degree C</li>
	 <li><input type="radio" name="q5" value="D">10 degree C</li>
      </ol>
    </li>
	<?php 
	if($_POST){
		echo "</td><td>";
		if($_POST['q5'] == "A"){
			echo "<span style='color:green'>(".$_POST['q5'].") IS CORRECT</span>";
		}
		else{
			echo "<span style='color:red'>(".$_POST['q5'].") IS NOT CORRECT ! CORRECT answer is (A).</span>";
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
<center><button class="boundingBox1" onclick='window.location="index.html";'><strong>Back To Experiment<string></button>
<t><button class="boundingBox1" onclick='window.location="../index.html";'><strong>Back To Theory<string></button></center>
</div>
</body>
</html>


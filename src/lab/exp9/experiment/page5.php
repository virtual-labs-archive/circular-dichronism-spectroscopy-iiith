<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<?php
	session_start();
	if($_POST){
		$ch = $_POST['chemical'];
		while(list($key,$val) = @each($ch)){
			$_SESSION[$val] = 1;
		}
		$_SESSION['values'] = $ch;
	}
?>
	<head>
		<title>exp9</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style type="text/css" media="screen">
		html, body { background-color: #ffffff;}
		body { margin:0; padding:0; overflow:scroll; }
		#flashContent {  text-align:center;}
		#start{
			clear:both;
			float:right;
			width:150px;
			color: green;
		}
		#start a{
			color:green;
		        text-decoration: none;
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
		</style>
	</head>
	<body>
<div id="content">
<h1 class="boundingBox">Experimental Setup</h1>
</div>

		<div id="flashContent">
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="900" height="600" id="exp8" align="middle">
				<param name="movie" value="exp8.swf" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#ffffff" />
				<param name="play" value="true" />
				<param name="loop" value="true" />
				<param name="wmode" value="window" />
				<param name="scale" value="showall" />
				<param name="menu" value="true" />
				<param name="devicefont" value="false" />
				<param name="salign" value="" />
				<param name="allowScriptAccess" value="sameDomain" />
				<!--[if !IE]>-->
				<object type="application/x-shockwave-flash" data="exp8.swf" width="900" height="600">
					<param name="movie" value="exp8.swf" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#ffffff" />
					<param name="play" value="true" />
					<param name="loop" value="true" />
					<param name="wmode" value="window" />
					<param name="scale" value="showall" />
					<param name="menu" value="true" />
					<param name="devicefont" value="false" />
					<param name="salign" value="" />
					<param name="allowScriptAccess" value="sameDomain" />
				<!--<![endif]-->
					<a href="http://www.adobe.com/go/getflash">
						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
					</a>
				<!--[if !IE]>-->
				</object>
				<!--<![endif]-->
			</object>
		</div>
<center><h2>Follow the instructions given at the top left.</h2></center>
	</body>
</html>

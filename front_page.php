<?php
session_start();
?>
<style type="text/css">
	#tt_capcorrect {
		color: #008000;
		font-weight: bold;
	}

	#tt_capincorrect {
		color: #F00;
		font-weight: bold;
	}

	#tt_captcha {
		width: 370px;
		margin: 0 auto;
		padding: 10px;
		border: 1px solid #504D4D;
	}

	#tt_capform {
		width: 100%;
		margin: 0;
	}

	#tt_capimage {
		float: left;
	}

	#tt_capvalue {
		color: #888;
		border: 1px solid #D7D7D9;
		-webkit-transition: all 0.25s linear;
		-moz-transition: all 0.25s linear;
		-o-transition: all 0.25s linear;
		-ms-transition: all 0.25s linear;
		transition: all 0.25s linear;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		-ms-box-sizing: border-box;
		box-sizing: border-box;
		float: left;
		padding: 9px;
		font-size: 12px;
		margin: 0 0 0 5px;
	}

	#tt_capsubmit {
		text-align: center;
		color: #FFF;
		cursor: pointer;
		padding: 8px 12px 8px 12px;
		height: 35px;
		vertical-align: top;
		background: #FF8F00;
		font-weight: bold;
		margin: 0 0 0 5px;
	}
	#tt_capsubmit:hover {
		background: #333;
	}
</style>
<div id="tt_captcha">
	<?php
	if(isset($_POST["captcha"]) && $_POST["captcha"] != "" && $_SESSION["ttcapt"] == $_POST["captcha"])
	{
		/* Correct CAPTCHA entered. Do whatever you like here */
		echo "<div id=\"tt_capcorrect\">Correct Answer!</div>";
	}
	else {
		if(isset($_POST["captcha"]) && $_POST["captcha"] != "" && $_SESSION["ttcapt"] != $_POST["captcha"])
		{
			/* Correct CAPTCHA entered. Do whatever you like here */
			echo "<div id=\"tt_capincorrect\">Incorrect Answer!</div>";
		}
		?>

		<form id="tt_capform" action="" method="post" id="commentform">
			<img id="tt_capimage" src="captcha_image.php" /> <!-- Link your CAPTCHA file here -->
			<input id="tt_capvalue" name="captcha" type="text" value="Type Answer Here" onblur="if (this.value == '') {this.value = 'Type Answer Here';}" onfocus="if (this.value == 'Type Answer Here') {this.value = '';}"/>
			<input name="submit" type="submit" id="tt_capsubmit" tabindex="5" value="Submit"/>
		</form>

		<?php
	}
	?>
</div>

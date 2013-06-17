<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Tracking  Application</title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript">

function changeCarrier(carrier){
	
	
}

$(document).ready(function() {
		
		var counter = 0;
		function ajaxCall(data){
			
			setTimeout(function(){
					
					
			$.ajax({
			url: "trackingFunction.php",	
			type: "POST",
			data: data,		
			cache: false,
			async:true,
			//success
			success: function (html) {				
				counter++;
				$('#table-output').append(html).addClass("kevo-class");	
				$('#counter').html(counter);	
			}		
		});
			
			
			
		}, 2000); // we're passing i
		}
		
//	$("select option:selected").
	
		
		
	
	//if submit button is clicked
	$('#submit').click(function () {		
		
		//Get the data from all the fields
		var carrier = $("select option:selected").text();
		var comment = $('textarea[name=comment]');

		//Simple validation to make sure user entered something
		//If error found, add hightlight class to the text field
	
		
		//organize the data properly
		
		
		//disabled all the text fields
		$('.text').attr('disabled','true');
		$('.form').hide();					
		$('.done').fadeIn('slow');
		$('.done h1').append(carrier+" Tracking Statuses");

		
		var trackingtext = $('textarea').val().split('\n');
		$('#total-rows').html(trackingtext.length);	
		for(var i = 0;i < trackingtext.length;i++){
		  //  alert(trackingtext[i]);
		var data = 'carrier=' + carrier + '&trackingnumber='  + trackingtext[i];

		
		ajaxCall(data);
		// new code
		
		
		
		
		
		
		// new code
		
	} //for loop
	return false;
		
	});
});	
</script>
<style>
body{text-align:center;}
.clear {clear:both}
.block {width:800px;margin:0 auto;text-align:left;}
label {float:left; width:75px;font-weight:700}
input.text {float:left; width:270px;padding-left:20px;}
.textarea {height:300px; width:300px;padding:5px;}
.hightlight {border:2px solid #9F1319;background:url(iconCaution.gif) no-repeat 2px}
#submit {float:left;margin-left:77px;margin-top:10px;}
.loading {float:right; background:url(ajax-loader.gif) no-repeat 1px; height:28px; width:28px; display:none;}
.done {display:none;background:url(iconIdea.gif) no-repeat 2px; padding-left:20px;font-family:arial;font-size:12px; width:70%; margin:20px auto; 	}
#progress{height:30px;width:300px;padding:10px;margin:0 auto;border:solid black 1px;margin-top:30px;display:none;}
.done span { border:solid 1px black;width:250px;padding:5px;float:left;}
.moving{color:green}
.not-moving{color:red;}
body {font:12px/17px Arial, Helvetica, sans-serif; color:#333; background:#E7E7E7; padding:40px 20px 20px 20px;}
fieldset {background:#f2f2e6; padding:10px; border:1px solid #fff; border-color:#fff #666661 #666661 #fff; margin-bottom:36px; width:600px;}
input, textarea, select {font:12px/12px Arial, Helvetica, sans-serif; padding:0;}
fieldset.action {background:#9da2a6; border-color:#e5e5e5 #797c80 #797c80 #e5e5e5; margin-top:-20px;}
legend {background:#bfbf30; color:#fff; font:17px/21px Calibri, Arial, Helvetica, sans-serif; padding:0 10px; margin:-26px 0 0 -11px; font-weight:bold; border:1px solid #fff; border-color:#e5e5c3 #505014 #505014 #e5e5c3;}
label {font-size:11px; font-weight:bold; color:#666;}
label.opt {font-weight:normal;}
#footer {font-size:11px;}
#container {width:700px; margin:0 auto;}
table{background-color:#C0C0C0}
td{width:250px;padding: 7px;color: white;font-size: 120%;}
.green{background-color:green;}
.red{background-color:red}
.counter{position:fixed;top:10px;right:10px;}

</style>
<body>
<h1 class="counter"><span id="counter"></span>/<span id="total-rows"></span></h1>

<h1>Innocom Solutions Package Tracking Appplication</h1>
<div class="block">
<div class="done">
<h1></h1>
<h2><a href="/tracking.php"> << Back</a></h2><br><br>

<table id="table-output" cellpadding="0" padding="0" spacing="0">


</table>

</div>
	<div class="form">
	<form method="post" action="">
	<div>
		<label>Carrier</label>
		<select name="carrier" id="carrier">
			<option value="ups">UPS</option>
			<option value="usps">USPS</option>
		</select>
	</div>
	<div>
		<label>Tracking </label>
		<textarea placeholder="Enter Tracking Numbers..." name="comment" class="text textarea" /></textarea>
	</div>
	<div>
		<input type="submit" id="submit" value="Get Tracking Numbers"/>
	</div>
	</form>
	</div>
</div>
</body>
</html>
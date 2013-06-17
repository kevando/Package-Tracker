<?php
//sleep(1);
//echo $_POST['trackingnumber']." = FRESH <br>";


// I added a random pause so the USPS site does not get killed with 
// pings at the same time
// I also increased the curl timeout to 120 seconds, giving the app
// a moment to catch the response

		$time = rand(1, 35);		
		sleep($time);
		
		$trackingNumber = stripslashes($_POST['trackingnumber']);
		if($_POST['carrier'] == 'USPS')
			$ch = curl_init('https://tools.usps.com/go/TrackConfirmAction_input?origTrackNum='.$trackingNumber);
		if($_POST['carrier'] == 'UPS')
			$ch = curl_init('wwwapps.ups.com/WebTracking/track?track=yes&trackNums='.$trackingNumber);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);
		curl_setopt($ch, CURLOPT_NOBODY, 0);
		

		$returnHtml = curl_exec($ch);
		curl_close($ch);
		
		print "<tr>";

		
		if($_POST['carrier']=='UPS') validateUPS($returnHtml,$trackingNumber);
		if($_POST['carrier']=='USPS') validateUSPS($returnHtml,$trackingNumber);


		print "</td></tr>";
		exit;
		
		
		function validateUPS($html,$trackingNumber){
			
			if(strpos($html, 'id="tt_spStatus">Order Processed: Ready for UPS') != false)
				print "<td class='green'>".$trackingNumber."</td><td class='green'>Order Processed: Ready for UPS";
			elseif(strpos($html, 'id="tt_spStatus">On Vehicle for Delivery') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>On Vehicle for Delivery";
			elseif(strpos($html, 'id="tt_spStatus">Transferred to Local Post Office for Delivery') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>Transferred to Local Post Office for Delivery";
			elseif(strpos($html, 'id="tt_spStatus">In Transit') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>In Transit";
			elseif(strpos($html, 'id="tt_spStatus">Local Post Office Exception') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>Local Post Office Exception";
			elseif(strpos($html, 'id="tt_spStatus">Returning to Sender') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>Returning to Sender";
			elseif(strpos($html, 'id="tt_spStatus">Delivered') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>Delievered";
			else
				print "<td class='red'>".$trackingNumber."</td><td class='red'>Other";
				
		}
		
		
		function validateUSPS($html,$trackingNumber){
			
			
			if(strpos($html, 'delivered') != false)
				print  "<td class='green'>".$trackingNumber."</td><td class='green'>Delivered";
			elseif(strpos($html, 'Out for Delivery') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>Out for Delivery";
			elseif(strpos($html, 'Sorting Complete') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>Sorting Complete";
			elseif(strpos($html, 'Depart USPS Sort Facility') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>Depart USPS Sort Facility";
			elseif(strpos($html, 'Processed through USPS Sort Facility') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>Processed through USPS Sort Facility";
			elseif(strpos($html, 'Depart USPS Sort Facility') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>Depart USPS Sort Facility";
			elseif(strpos($html, 'Electronic Shipping Info Received') != false) 
				print "<td class='green'>".$trackingNumber."</td><td class='green'>Electronic Shipping Info Received";
			else
				print "<td class='red'>".$trackingNumber."</td><td class='red'>No Information Available";				
			
		}
		
		

?>
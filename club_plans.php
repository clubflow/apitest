<link rel="stylesheet" href="dynamic_styles.css">

<?php 
//get the plugin core functions
include "core_functions.php";	

$AbcUrl = "https://api.abcfinancial.com/rest/" . $_GET['club'] . "/clubs/plans";

$thisMethod = "";

$thisData = "";

$xml = CallAPI($thisMethod, $AbcUrl, $thisData);

$data = simplexml_load_string($xml);

$planName = (string) $data->plans->plan->planName;
?>
<h1><?php echo $_GET['location']; ?></h1>
<h2>Club Plans</h2>
<ul>
<?php
foreach($data->plans->plan as $plan){ 
	echo '<li><h2>' . $plan->planName . '</h2></li>';
	//echo '<li><a href="get_plan_details.php?planId=' . $plan->planId . '">' . $plan->planName . '</a></li>';

	$AbcUrl = "https://api.abcfinancial.com/rest/" . $_GET['club'] . "/clubs/plans/" . $plan->planId;
	$thisData = array(
		"clubNumber" => $_GET['club'],
		"planId" => $plan->planId
	);
	
	$planXml = CallAPI("", $AbcUrl, $thisData);
	$plandata = simplexml_load_string($planXml);
	
	foreach($plandata->paymentPlan as $paymentPlan){ 
		//echo '<p><strong>Next Payment Date:</strong>' . $plan->firstDueDate . '</p>';
		
		echo '<p><strong>Due Today: ' . $plandata->paymentPlan->downPaymentTotalAmount . '</strong></p><p>Itemized:</p>';
		echo '<table cellpadding="5" border="1"><tr><th>Fee</th><th>Subtotal</th><th>Tax</th><th>Total</th>';
		foreach($plandata->paymentPlan->downPayments as $downPayments){
			echo '<tr><td>' . $downPayments->name . '</td><td>' . $downPayments->subTotal . '</td><td>' . $downPayments->tax . '</td><td><strong>' . $downPayments->total . '</strong></td></tr>';
		}
		echo '</table>';
		
		echo '<p><strong>Due Monthly:</strong> ' . $plandata->paymentPlan->scheduleTotalAmount . '</p>';
		echo '<p><strong>Next Payment Due:</strong> ' . $plandata->paymentPlan->firstDueDate . '</p>';
	}
}
?>
</ul>
<hr>
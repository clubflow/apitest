<link rel="stylesheet" href="dynamic_styles.css">

<?php 
//get the plugin core functions
include "core_functions.php";	

$thisMethod = "POST";

$postProspectRequestBody = '{
  "prospects": [
    {
      "prospect": {
        "personal": {
          "memberId": "010aee3beb4e4ed5a3682d6276095d15",
          "firstName": "Mitch",
          "lastName": "Conner",
          "middleInitial": "H",
          "addressLine1": "28201 E. Bonanza St.",
          "addressLine2": "#409",
          "city": "South Park",
          "state": "CO",
          "countryCode": "US",
          "postalCode": "80440",
          "email": "mrkitty@gmail.com",
          "sendEmail": "string",
          "primaryPhone": "9495898283",
          "mobilePhone": "9495898283",
          "workPhone": "9495898283",
          "workPhoneExt": "1234",
          "barcode": "barcode1",
          "birthDate": "1997-08-13",
          "gender": "Male",
          "employer": "string",
          "occupation": "string",
          "groupId": "010aee3beb4e4ed5a3682d6276095d15",
          "misc1": "string",
          "misc2": "string"
        },
        "agreement": {
          "referringMemberId": "010aee3beb4e4ed5a3682d6276095d15",
          "salesPersonId": "321aee3beb4e4ed4a3642d6226095d11",
          "campaignId": "c41e5df2682a481b8396da9e10272390",
          "beginDate": "1997-08-13",
          "expirationDate": "2016-12-28",
          "issueDate": "1997-08-13",
          "tourDate": "2016-12-28",
          "visitsAllowed": "17",
          "leadPriority": "string"
        },
        "note": {
          "text": "string"
        }
      }
    }
  ]
}';

$AbcUrl = "https://api.abcfinancial.com/rest/" . $_GET['club'] . "/prospects";
$thisData = array(
	"clubNumber" => '4154',
	"postProspectRequestBody" => $postProspectRequestBody
);
	

$xml = CallAPI($thisMethod, $AbcUrl, $thisData);
//var_dump($xml);
$data = simplexml_load_string($xml);

$memberId = $data->result->memberId;

echo $memberId;
?>

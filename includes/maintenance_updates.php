<?php
if ($myEditAction == 'SaveBuildCompletionDate'  ) {
	$table = "lots";
	if ($_POST["buildCompletionDate"] > '') {
		$arr["buildCompletionDate"] = '"'.date('Y-m-d',strtotime($_POST["buildCompletionDate"])).'"';
	}
	else	{
		$arr["buildCompletionDate"] = 'Null';
	}
}

if ($myEditAction == 'SaveBuildSequence' || $myEditAction == 'AddBuildSequence' ) {
	$table = "buildTimeline";
	$arr["location"] = MySQL::SQLValue($_POST["location"]);	
	$arr["sequence"] = MySQL::SQLValue($_POST["sequence"],MySQL::SQLVALUE_NUMBER);	
	$arr["buildAction"] = MySQL::SQLValue($_POST["buildAction"]);	
	if ($_POST["numberOfDays"] > '') {
		$arr["numberOfDays"] = MySQL::SQLValue($_POST["numberOfDays"],MySQL::SQLVALUE_NUMBER);	
	}
	else {
		$arr["numberOfDays"] = MySQL::SQLValue("0",MySQL::SQLVALUE_NUMBER);	
	}
	if ($_POST["percentOfBuild"] > '') {
		$arr["percentOfBuild"] = MySQL::SQLValue($_POST["percentOfBuild"],MySQL::SQLVALUE_NUMBER);	
	}
	else {
		$arr["percentOfBuild"] = MySQL::SQLValue("0",MySQL::SQLVALUE_NUMBER);	
	}
	if ($_POST["moveInDateOffset"] > '') {
		$arr["moveInDateOffset"] = MySQL::SQLValue($_POST["moveInDateOffset"],MySQL::SQLVALUE_NUMBER);	
	}
	else {
		$arr["moveInDateOffset"] = MySQL::SQLValue("0",MySQL::SQLVALUE_NUMBER);	
	}
	$arr["timelineMasterID"] = MySQL::SQLValue($_POST["timelineMasterID"],MySQL::SQLVALUE_NUMBER);	
	$arr["sequenceIsActive"] = MySQL::SQLValue($_POST["sequenceIsActive"],MySQL::SQLVALUE_NUMBER);	
	
}
if ($myEditAction == 'SaveTimelineMaster' || $myEditAction == 'AddTimelineMaster' ) {
	$table = "buildTimelineMaster";
	$arr["timelineMasterName"] = MySQL::SQLValue($_POST["timelineMasterName"]);	

	$arr["timelineIsActive"] = MySQL::SQLValue($_POST["timelineIsActive"],MySQL::SQLVALUE_NUMBER);	
	
}
if ($myEditAction == 'SaveSite' || $myEditAction == 'AddSite' ) {
	$table = "sites";
	$arr["siteName"] = MySQL::SQLValue($_POST["siteName"]);	
	if (isset($_POST["availableSiteDiscount"]) AND  MySQL::SQLValue($_POST["availableSiteDiscount"],MySQL::SQLVALUE_NUMBER) > 0 )  {
		$arr["availableSiteDiscount"] = MySQL::SQLValue($_POST["availableSiteDiscount"],MySQL::SQLVALUE_NUMBER);	
	}
	else {
		$arr["availableSiteDiscount"] = MySQL::SQLValue("0",MySQL::SQLVALUE_NUMBER);	
	}

	$arr["siteIsActive"] = MySQL::SQLValue($_POST["siteIsActive"],MySQL::SQLVALUE_NUMBER);	
	if ($_POST["siteShortName"] > '   '  ) {
		$arr["siteShortName"] = MySQL::SQLValue($_POST["siteShortName"]);	
	}
	
}
if ($myEditAction == 'SaveLot' || $myEditAction == 'AddLot' ) {
	$table = "lots";
	$arr["lotType"] = MySQL::SQLValue($_POST["lotType"]);	
	$arr["lotSize"] = MySQL::SQLValue($_POST["lotSize"],MySQL::SQLVALUE_NUMBER);	
	$arr["timelineMasterID"] = MySQL::SQLValue($_POST["timelineMasterID"],MySQL::SQLVALUE_NUMBER);	
	$arr["planNumber"] = MySQL::SQLValue($_POST["planNumber"]);	
	$arr["munStreetNumber"] = MySQL::SQLValue($_POST["munStreetNumber"]);	
	$arr["munStreetAddress"] = MySQL::SQLValue($_POST["munStreetAddress"]);	
//	$arr["streetSide"] = MySQL::SQLValue($_POST["streetSide"]);	
	$arr["postalCode"] = MySQL::SQLValue($_POST["postalCode"]);	
	$arr["parkingNumber"] = MySQL::SQLValue($_POST["parkingNumber"]);	
	$arr["designatedModelName"] = MySQL::SQLValue($_POST["designatedModelName"]);	
	$arr["city"] = MySQL::SQLValue($_POST["city"]);	
	
}
if ($myEditAction == 'SaveFeature' || $myEditAction == 'AddFeature' ) {
	$table = "lookupFeatures";
	$arr["featureCategory"] = MySQL::SQLValue($_POST["featureCategory"]);	
	$arr["featureName"] = MySQL::SQLValue($_POST["featureName"]);	
	$arr["featureName2"] = MySQL::SQLValue($_POST["featureName2"]);	
	$arr["resalePrice"] = MySQL::SQLValue($_POST["resalePrice"],MySQL::SQLVALUE_NUMBER);	
	if ($_POST["discountAllowed"] ==1 ) {
		$arr["discountAllowed"] = 1;	
	}
	else {
		$arr["discountAllowed"] = 0;	
	}
	
}
if ($myEditAction == 'SaveModel' || $myEditAction == 'AddModel' ) {
	$table = "lookupSiteModels";
	$arr["modelName"] = MySQL::SQLValue($_POST["modelName"]);	
	
}
if ($myEditAction == 'SaveUser' || $myEditAction == 'AddUser' ) {
	$table = "users";
	$arr["userName"] = MySQL::SQLValue($_POST["userName"]);	
	$arr["lastName"] = MySQL::SQLValue($_POST["lastName"]);	
	$arr["firstName"] = MySQL::SQLValue($_POST["firstName"]);	
	$arr["password"] = MySQL::SQLValue($_POST["password"]);	
	$arr["email"] = MySQL::SQLValue($_POST["email"]);	
	$table2 = "userSecurity";
	$arr2["securityLevel"] = MySQL::SQLValue($_POST["securityLevel"]);	
}

if ($myEditAction == 'DeleteSingleUser' ) {
	$table = "users";
	$where["userUniqueID"] = MySQL::SQLValue($_GET["userUniqueID"],MySQL::SQLVALUE_NUMBER);	
	$result = $dbSingleUse->DeleteRows($table, $where);
	$table2 = "userSecurity";
	$arr2["userUniqueID"] = MySQL::SQLValue($_GET["userUniqueID"],MySQL::SQLVALUE_NUMBER);	
	$result = $dbSingleUse->DeleteRows($table2, $arr2);

}

if ($myEditAction == 'DeleteTemplate' ) {
	$table = "fileLocations";
	$where["id"] = MySQL::SQLValue($_GET["id"],MySQL::SQLVALUE_NUMBER);	
	$result = $dbSingleUse->DeleteRows($table, $where);

}
if ($myEditAction == 'SaveTimelineMaster'  ) {
	$where["timelineMasterID"] = MySQL::SQLValue($_POST["timelineMasterID"],MySQL::SQLVALUE_NUMBER);	
}
if ($myEditAction == 'SaveBuildSequence'  ) {
	$where["timelineSequenceID"] = MySQL::SQLValue($_POST["timelineSequenceID"],MySQL::SQLVALUE_NUMBER);	
}
if ($myEditAction == 'SaveSite'  ) {
	$where["siteID"] = MySQL::SQLValue($_POST["siteID"],MySQL::SQLVALUE_NUMBER);	
}

if ($myEditAction == 'SaveLot' || $myEditAction == 'SaveBuildCompletionDate' ) {
	$where["lotID"] = MySQL::SQLValue($_POST["lotID"],MySQL::SQLVALUE_NUMBER);	
}

if ($myEditAction == 'SaveFeature') {
	$where["featureID"] = MySQL::SQLValue($_POST["featureID"],MySQL::SQLVALUE_NUMBER);	
}

if ($myEditAction == 'SaveModel') {
	$where["modelID"] = MySQL::SQLValue($_POST["modelID"],MySQL::SQLVALUE_NUMBER);	
}
if ($myEditAction == 'SaveUser') {
	$where["userUniqueID"] = MySQL::SQLValue($_POST["userUniqueID"],MySQL::SQLVALUE_NUMBER);	
	$arr2["userUniqueID"] = MySQL::SQLValue($_POST["userUniqueID"],MySQL::SQLVALUE_NUMBER);	
}

if ($myEditAction == 'AddTimelineMaster' ) {
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["timelineMasterID"] = MySQL::SQLValue($newId,MySQL::SQLVALUE_NUMBER);	
}
if ($myEditAction == 'AddBuildSequence' ) {
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["timelineSequenceID"] = MySQL::SQLValue($newId,MySQL::SQLVALUE_NUMBER);	
}
if ($myEditAction == 'AddSite' ) {
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["siteID"] = MySQL::SQLValue($newId,MySQL::SQLVALUE_NUMBER);	
}

if ($myEditAction == 'AddLot' ) {
	$arr["siteShortName"] = MySQL::SQLValue($_POST["siteShortName"]);	
	
	$arr["lotNumber"] = MySQL::SQLValue($_POST["lotNumber"],MySQL::SQLVALUE_NUMBER);	
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["lotID"] = MySQL::SQLValue($newId,MySQL::SQLVALUE_NUMBER);	
}

if ($myEditAction == 'AddFeature' ) {
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["featureID"] = MySQL::SQLValue($newId,MySQL::SQLVALUE_NUMBER);	
}
if ($myEditAction == 'AddModel' ) {
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["modelID"] = MySQL::SQLValue($newId,MySQL::SQLVALUE_NUMBER);	
	$arr["siteShortName"] = MySQL::SQLValue($_POST["siteShortName"]);	
}
if ($myEditAction == 'AddUser' ) {
	$newId = getNextId ($dbSingleUse, $userName, $table , session_id() );
	$arr["userUniqueID"] = MySQL::SQLValue($newId,MySQL::SQLVALUE_NUMBER);	
	$arr2["userUniqueID"] = MySQL::SQLValue($newId,MySQL::SQLVALUE_NUMBER);	
}

//	print_r($where);
//	print_r($arr);

if ($myEditAction == 'AddBuildSequence' ) {
	$query = 'select * from buildTimeline where timelineMasterID = '.$arr["timelineMasterID"].' and buildAction = "'.$_POST["buildAction"].'"';
//	echo $query;
	
	if ($dbSingleUse->HasRecords($query)) {
		alertBox('Error: buildAction already exists: ('.$_POST["buildAction"].')  The sequence was not added.  Please try again');
	}
	elseif ($_POST["buildAction"] > '') {
		$result = $dbSingleUse->InsertRow($table, $arr);
		//note need to check this way because I wont otherwise know if it was success
		$errorMessage = $dbSingleUse->Error;

	$query = 'select * from buildTimeline where timelineSequenceID = "'.$arr["timelineSequenceID"].'"';
		//echo $query;
		
		if (!$dbSingleUse->HasRecords($query)) {
			 alertBox("There was an error adding the sequence.  Try again.  The error message is : ".$errorMessage);
		}
		
	}
	else {
		alertBox('Error: Build Action needs a value: ('.$_POST["buildAction"].')  The sequence was not added.  Please try again');
	}
}
if ($myEditAction == 'AddTimelineMaster' ) {
	$query = 'select * from buildTimelineMaster where timelineMasterName = "'.$_POST["timelineMasterName"].'"';
//	echo $query;
	
	if ($dbSingleUse->HasRecords($query)) {
		alertBox('Error: Name already exists: ('.$_POST["timelineMasterName"].')  The timeline master was not added.  Please try again');
	}
	elseif ($_POST["timelineMasterName"] > '') {
		$result = $dbSingleUse->InsertRow($table, $arr);
		//note need to check this way because I wont otherwise know if it was success
		$errorMessage = $dbSingleUse->Error;

	$query = 'select * from buildTimelineMaster where timelineMasterName = "'.$_POST["timelineMasterName"].'"';
		//echo $query;
		
		if (!$dbSingleUse->HasRecords($query)) {
			 alertBox("There was an error adding the timeline.  Try again.  The error message is : ".$errorMessage);
		}
		
	}
	else {
		alertBox('Error: Site Name and Site ID both need values: ('.$_POST["siteName"].', '.$_POST["siteShortName"].')  The site was not added.  Please try again');
	}
}
if ($myEditAction == 'AddSite' ) {
	$query = 'select * from sites where siteName = "'.$_POST["siteName"].'" or siteShortName = "'.$_POST["siteShortName"].'"';
//	echo $query;
	
	if ($dbSingleUse->HasRecords($query)) {
		alertBox('Error: Site Name or Site ID already exists: ('.$_POST["siteName"].', '.$_POST["siteShortName"].')  The site was not added.  Please try again');
	}
	elseif ($_POST["siteName"] > '' and $_POST["siteShortName"] > '') {
		$result = $dbSingleUse->InsertRow($table, $arr);
		//note need to check this way because I wont otherwise know if it was success
		$errorMessage = $dbSingleUse->Error;

		$query = 'select * from sites where siteShortName = "'.$_POST["siteShortName"].'"';
		//echo $query;
		
		if (!$dbSingleUse->HasRecords($query)) {
			 alertBox("There was an error adding the site.  Try again.  The error message is : ".$errorMessage);
		}
		
	}
	else {
		alertBox('Error: Site Name and Site ID both need values: ('.$_POST["siteName"].', '.$_POST["siteShortName"].')  The site was not added.  Please try again');
	}
}

if ($myEditAction == 'AddLot' ) {
	$query = 'select * from lots where lotNumber = '.$_POST["lotNumber"].' and siteShortName = "'.$_POST["siteShortName"].'"';
//	echo $query;
	
	if ($dbSingleUse->HasRecords($query)) {
		alertBox('Error: Lot number '.$_POST["lotNumber"].' already exists.  The lot was not added.  Please try again');
	}
	else {
		$result = $dbSingleUse->InsertRow($table, $arr);
		//note need to check this way because I wont otherwise know if it was success
		$errorMessage = $dbSingleUse->Error;

		$query = 'select * from lots where lotNumber = '.$_POST["lotNumber"].' and siteShortName = "'.$_POST["siteShortName"].'"';
		//echo $query;
		
		if (!$dbSingleUse->HasRecords($query)) {
			 alertBox("There was an error adding the lot.  Try again.  The error message is : ".$errorMessage);
		}
		
	}
}
if ($myEditAction == 'AddFeature' ) {
		$result = $dbSingleUse->InsertRow($table, $arr);
		//note need to check this way because I wont otherwise know if it was success
		$errorMessage = $dbSingleUse->Error;

		$query = 'select * from lookupFeatures where resalePrice = "'.$_POST["resalePrice"].'" and featureCategory = "'.$_POST["featureCategory"].'" and featureName = "'.$_POST["featureName"].'" and featureName2 = "'.$_POST["featureName2"].'"';
//		echo $query;
		
		if (!$dbSingleUse->HasRecords($query)) {
			 alertBox("There was an error adding the feature.  Try again.  The error message is : ".$errorMessage);
		}
		
}
if ($myEditAction == 'AddUser' ) {
		$result = $dbSingleUse->InsertRow($table, $arr);
		//note need to check this way because I wont otherwise know if it was success
		$errorMessage = $dbSingleUse->Error;

		$query = 'select * from users where userName = "'.$_POST["userName"].'"';
//		echo $query;
		
		if (!$dbSingleUse->HasRecords($query)) {
			 alertBox("There was an error adding the user.  Try again.  The error message is : ".$errorMessage);
		}
		else {
			$result = $dbSingleUse->DeleteRows($table2, $arr2);
			$result = $dbSingleUse->InsertRow($table2, $arr2);
		
		}
		
}
if ($myEditAction == 'AddModel' ) {
		$result = $dbSingleUse->InsertRow($table, $arr);
		//note need to check this way because I wont otherwise know if it was success
		$errorMessage = $dbSingleUse->Error;

		$query = 'select * from lookupSiteModels where modelName = "'.$_POST["modelName"].'" and siteShortName = "'.$_POST["siteShortName"].'"';;
//		echo $query;
		
		if (!$dbSingleUse->HasRecords($query)) {
			 alertBox("There was an error adding the model.  Try again.  The error message is : ".$errorMessage);
		}
		
}
if ($myEditAction == 'SaveBuildSequence'  ) {
//	if ($_POST["buildSequenceID"] > 0) {
		$result = $dbSingleUse->UpdateRows($table, $arr, $where);
		 if (!$result) {
			 alertBox("There was an error saving the data.  Try again");
	 	}
//	}
//	else {
//		alertBox('Error: Sequence ID may not be blank.  The timeline was not saved.  Please try again.  There error message is : '.$dbSingleUse->Error);
//	}
}
if ($myEditAction == 'SaveTimelineMaster'  ) {
	if ($_POST["timelineMasterID"] > 0) {
		$result = $dbSingleUse->UpdateRows($table, $arr, $where);
		 if (!$result) {
			 alertBox("There was an error saving the data.  Try again");
	 	}
	}
	else {
		alertBox('Error: Site Master ID may not be blank.  The timeline was not saved.  Please try again.  There error message is : '.$dbSingleUse->Error);
	}
}
if ($myEditAction == 'SaveSite'  ) {
	if ($_POST["siteID"] > 0) {
		$result = $dbSingleUse->UpdateRows($table, $arr, $where);
		 if (!$result) {
			 alertBox("There was an error saving the site.  Try again");
	 	}
	}
	else {
		alertBox('Error: Site ID may not be blank.  The site was not saved.  Please try again.  There error message is : '.$dbSingleUse->Error);
	}
}
if ($myEditAction == 'SaveLot' || $myEditAction == 'SaveBuildCompletionDate'  ) {
	if ($_POST["lotID"] > 0) {
		$result = $dbSingleUse->UpdateRows($table, $arr, $where);
		 if (!$result) {
			 alertBox("There was an error saving the lot.  Try again");
	 	}
	}
	else {
		alertBox('Error: Lot ID may not be blank.  The lot was not saved.  Please try again.  There error message is : '.$dbSingleUse->Error);
	}
}
if ($myEditAction == 'SaveFeature' ) {
	if ($_POST["featureID"] > 0) {
		$result = $dbSingleUse->UpdateRows($table, $arr, $where);
		 if (!$result) {
			 alertBox("There was an error saving the feature.  Try again");
	 	}
	}
	else {
		alertBox('Error: Feature Name may not be blank.  The feature was not added.  Please try again.  There error message is : '.$dbSingleUse->Error);
	}
}
if ($myEditAction == 'SaveUser' ) {
	if ($_POST["userUniqueID"] > 0) {
		$result = $dbSingleUse->UpdateRows($table, $arr, $where);
		 if (!$result) {
			 alertBox("There was an error saving the user.  Try again");
	 	}
			$result = $dbSingleUse->DeleteRows($table2, $where);
			$result = $dbSingleUse->InsertRow($table2, $arr2);
	}
	else {
		alertBox('Error: User Name may not be blank.  The user was not added.  Please try again.  There error message is : '.$dbSingleUse->Error);
	}
}
if ($myEditAction == 'SaveModel' ) {
	if ($_POST["modelID"] > 0) {
		$result = $dbSingleUse->UpdateRows($table, $arr, $where);
		 if (!$result) {
			 alertBox("There was an error saving the model.  Try again");
	 	}
	}
	else {
		alertBox('Error: Model Name may not be blank.  The model was not added.  Please try again.  There error message is : '.$dbSingleUse->Error);
	}
}
if ($myEditAction == 'DeleteLot') {
	$newLot = $_POST["lotNumber"];
	$continue = true;
	$where["lotNumber"] = MySQL::SQLValue($_POST["lotNumber"],MySQL::SQLVALUE_NUMBER);	
	$where["siteShortName"] = MySQL::SQLValue($_POST["siteShortName"]);	
	echo '<br><br>Checking that it is okay to delete the lot';

	echo '<font color="red">';
	$table = "offers";
	if ($continue) {
		if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
			echo "<br><br>Error - data already exists in ".$table." for ".$newLot."- delete offer on lot ".$siteShortName."-".$newLot." first.";
		$continue = false;
		}
	}

	$table = "offerAmendments";
	if ($continue) {
		if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
			echo "<br><br>Error - data already exists in ".$table." for ".$newLot."- delete offer on lot ".$siteShortName."-".$newLot." first.";
			$continue = false;
		}
	}
	$table = "offerChangeOrders";
	if ($continue) {
		if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
			echo "<br><br>Error - data already exists in ".$table." for ".$newLot."- delete offer on lot ".$siteShortName."-".$newLot." first.";
			$continue = false;
		}
	}
	$table = "offerFeatures" ;
	if ($continue) {
		if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
			echo "<br><br>Error - data already exists in ".$table." for ".$newLot."- delete offer on lot ".$siteShortName."-".$newLot." first.";
			$continue = false;
		}
	}
	$table = "offerWorkCredits";
	if ($continue) {
		if ($dbSingleUse->HasRecords($dbSingleUse->BuildSQLSelect($table, $where))) {
			echo "<br><br>Error - data already exists in ".$table." for ".$newLot."- delete offer on lot ".$siteShortName."-".$newLot." first.";
			$continue = false;
		}
	}
	echo '</font>';
	if ($continue) {
		echo "<br><br><big><b>Delete lot :".$_POST["lotNumber"]."<br><br></b></big>";
		$table = "lots";
		$result = $dbSingleUse->DeleteRows($table, $where);
	}
}

?>
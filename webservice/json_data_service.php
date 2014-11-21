<?php

//require_once('check_session.php'); 

//	require_once('../includes/json_available_features.php'); 
		$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
		$siteShortName = trim(strip_tags($_GET['site']));//retrieve the search term that autocomplete sends
		$currentField = trim(strip_tags($_GET['currentField']));//retrieve the search term that autocomplete sends

if ($currentField == 'tableData') {
	require_once('../includes/json_table_select.php'); 
}
if ($currentField == 'models') {
	require_once('../includes/json_models.php'); 
}
if ($currentField == 'elevation') {
	require_once('../includes/json_elevations.php'); 
}
if ($currentField == 'garageSize') {
	require_once('../includes/json_garage_sizes.php'); 
}
if ($currentField == 'features') {
	require_once('../includes/json_available_features.php'); 
}
if ($currentField == 'featuresBoth') {
	require_once('../includes/json_available_featuresBoth.php'); 
}
if ($currentField == 'featureCategory') {
	require_once('../includes/json_available_feature_categories.php'); 
}
if ($currentField == 'featureName') {
	require_once('../includes/json_available_feature_names.php'); 
}
if ($currentField == 'featureName2') {
	require_once('../includes/json_available_feature_names2.php'); 
}
if ($currentField == 'frontDoor') {
	require_once('../includes/json_front_doors.php'); 
}
if ($currentField == 'lotType') {
	require_once('../includes/json_lot_types.php'); 
}
if ($currentField == 'munStreetAddress') {
	require_once('../includes/json_lot_munStreetAddress.php'); 
}
if ($currentField == 'planNumber') {
	require_once('../includes/json_lot_planNumber.php'); 
}
if ($currentField == 'lotCity') {
	require_once('../includes/json_lot_city.php'); 
}
if ($currentField == 'chartTextValue') {
	require_once('../includes/json_chartTextValue.php'); 
}

/*
		$row['label']=htmlentities(stripslashes("model1"));
		$row_set[] = $row;//build an array
		$row['label']=htmlentities(stripslashes("model2"));
		$row_set[] = $row;//build an array
		$row['label']=htmlentities(stripslashes($term));
		$row_set[] = $row;//build an array
		$row['label']=htmlentities(stripslashes($site));
		$row_set[] = $row;//build an array
		$row['label']=htmlentities(stripslashes($currentField));
		$row_set[] = $row;//build an array


echo json_encode($row_set);//format the array into json data

*/
?>
<table class="tableOfferEntry" width="1000%" border="1" cellspacing="1" cellpadding="0" align="left">
<?php
if (!$securityCanDoSettings) {
	exit;
}


if ($myEditAction == 'SaveSettings') {
	$table = "settings";
	$arr["SettingValue"] = MySQL::SQLValue($_POST["mySettingValue"]);	
	$where["SettingName"] = MySQL::SQLValue($_POST["mySettingName"]);	
//	print_r($where);
//	print_r($arr);
	$result = $dbSingleUse->UpdateRows($table, $arr, $where);
//	echo $result.'.';
}


$query = 'select *
			from settings  where availableToUser = 1 ';


$query = $query.' order by settingName';
//echo $query;

//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';
echo '<tr>';
echo '<th  align="center">Setting Name</th>';
echo '<th align="center">Setting Value (IMPORTANT! Click save after each individual change.)</th>';
echo '<th align="center">Action</th>';
echo '</tr>';

$x=0;
if ($db2->Query($query)) { 
	while ($users = $db2->Row()) {
		$x = $x + 1;
			echo '<tr>';
			echo '<form method="post" name="settingsform'.$x.'" target="_self" >';
			echo '<input name="myAction" type="hidden" id="myAction" value="Settings" />';
			echo '<input name="myEditAction" type="hidden" id="myEditAction" value="SaveSettings" />';
			echo '<input name="mySettingName" type="hidden" id="mySettingName" value="'.$users->settingName.'" />';

	    	echo '<td ><b>'.nullToChar($users->settingName,'-').'</b><br><small>'.$users->settingDescription.'</small></td>';
	    	echo '<td><textarea name="mySettingValue" id="mySettingValue" cols="65" rows="5">'.nullToChar($users->SettingValue,'-').'</textarea></td>';
	    	echo '<td >';
			echo '<input  name="Save" type="submit" value="Save" />';
	    	echo '</td>';
			echo '</form>';
			echo '</tr>';
	}
} 


?>
</table>
<h3>HTML Text Formatting Tags</h3>
<table>
  <tbody>
    <tr>
      <th width="20%" align="left">Tag</th>
      <th width="80%" align="left">Description</th>
    </tr>
    <tr>
      <td><a href="http://www.w3schools.com/tags/tag_font_style.asp" target="_new">&lt;b&gt;</a></td>
      <td>Defines bold text</td>
    </tr>
    <tr>
      <td><a href="http://www.w3schools.com/tags/tag_font_style.asp" target="_new">&lt;big&gt;</a></td>
      <td>Defines big text</td>
    </tr>
    <tr>
      <td><a href="http://www.w3schools.com/tags/tag_phrase_elements.asp" target="_new">&lt;em&gt;</a></td>
      <td>Defines emphasized text </td>
    </tr>
    <tr>
      <td><a href="http://www.w3schools.com/tags/tag_font_style.asp" target="_new">&lt;i&gt;</a></td>
      <td>Defines italic text</td>
    </tr>
    <tr>
      <td><a href="http://www.w3schools.com/tags/tag_font_style.asp" target="_new">&lt;small&gt;</a></td>
      <td>Defines small text</td>
    </tr>
    <tr>
      <td><a href="http://www.w3schools.com/tags/tag_phrase_elements.asp" target="_new">&lt;strong&gt;</a></td>
      <td>Defines strong text</td>
    </tr>
    <tr>
      <td><a href="http://www.w3schools.com/tags/tag_sup.asp" target="_new">&lt;sub&gt;</a></td>
      <td>Defines subscripted text</td>
    </tr>
    <tr>
      <td><a href="/tags/tag_sup.asp" target="_new">&lt;sup&gt;</a></td>
      <td>Defines superscripted text</td>
    </tr>
  </tbody>
</table>
<table class="tableOfferEntry" width="1000%" border="1" cellspacing="1" cellpadding="0" align="left">
</table>



	




<table class="tableOfferEntry" width="1000%" border="1" cellspacing="1" cellpadding="0" align="left">
<form action="" method="post" name="UsersMainForm" target="_self" onsubmit="return checkFormData(this)">
<?php
if (!$securityCanManageUsers) {
	echo 'you are not allowed to edit users';
	exit;
}
$query = 'select *
			from users ';

if ($myEditAction == 'EditSingleUser') {
	$query = $query.' where userUniqueID = '.$_GET["userUniqueID"];
}

$query = $query.' order by lastName, FirstName';
//echo $query;

//echo '<tr><td colspan="4"><h1>Edit Offer Features</h1></td></tr>';
echo '<tr>';
echo '<th width="10px" >id</th>';
echo '<th  align="center">User Name*</th>';
echo '<th align="center">Last Name*</th>';
echo '<th align="center">First Name*</th>';
echo '<th align="center">email*</th>';
echo '<th align="center">Password*</th>';
echo '<th align="center">Security</th>';
echo '<th align="center">Action</th>';
echo '</tr>';

$x=0;
if ($db2->Query($query)) { 
	while ($users = $db2->Row()) {
		$x = $x + 1;
		if ($myEditAction == 'EditSingleUser') {
			$userUniqueID = $users->userUniqueID;
			$userNameEdit = $users->userName;
			$lastName = $users->lastName;
			$firstName =  $users->firstName;
			$password = $users->password;
			$email = $users->email;
		}
		else
		{
			echo '<tr>';
	    	echo '<td><b>'.nullToChar($users->userUniqueID,'-').'</td>';
	    	echo '<td>'.nullToChar($users->userName,'-').'</td>';
	    	echo '<td>'.nullToChar($users->lastName,'-').'</td>';
	    	echo '<td>'.nullToChar($users->firstName,'-').'</td>';
	    	echo '<td>'.nullToChar($users->email,'-').'</td>';
			echo '<td>hidden</td>';
	    	echo '<td>'.nullToChar(userSecurityLevel($dbSingleUse,$users->userName),'-').'</td>';
			echo '<td align="center"><big>
			<a href="index.php?myAction=Maintenance&myEditAction=EditSingleUser&userUniqueID='.$users->userUniqueID.'">Edit</a> - 
			<a href="index.php?myAction=Maintenance&myEditAction=ConfirmDeleteUser&userUniqueID='.$users->userUniqueID.'&userName='.$users->userName.'">Delete</a>
			</big></td>';
			echo '</tr>';
		}
	}
} 


?>

<tr><td>
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="<?php if ($myEditAction == 'EditSingleUser') { echo 'SaveUser'; } else { echo 'AddUser'; } ?>" />
    <input name="userUniqueID" type="hidden" id="userUniqueID" value="<?php echo $userUniqueID; ?>" />
 </td>
 <td><input <?php if ($myEditAction == 'EditSingleUser') {echo 'type="hidden"';} ?> id="userName"  name="userName" value="<?php if ($myEditAction == 'EditSingleUser') { echo htmlspecialchars($userNameEdit); } ?>" size="20" maxlength="50" /> 
 <?php if ($myEditAction == 'EditSingleUser') {echo '<b><big>'.htmlspecialchars($userNameEdit).'</b></big>';} ?>
 </td>
 <td>
        <input id="lastName"  name="lastName" value="<?php echo htmlspecialchars($lastName);?>" size="12" maxlength="50" />
      </td>                    
 <td>
        <input id="firstName"  name="firstName" value="<?php echo htmlspecialchars($firstName);?>" size="10" maxlength="40" />
      </td>                    
 <td>
        <input id="email"  name="email" value="<?php echo htmlspecialchars($email);?>" size="20" maxlength="50" />
      </td>                    
 <td>
        <input id="password"  name="password" value="<?php echo htmlspecialchars($password);?>" size="10" maxlength="255" />
      </td>                    
 <td>
        <select id="securityLevel"  name="securityLevel">
   <option value="" <?php if (htmlspecialchars(userSecurityLevel($dbSingleUse,$userNameEdit)) == '') {echo "selected=\"selected\"";} ?>></option>
   <option value="Level One" <?php if (htmlspecialchars(userSecurityLevel($dbSingleUse,$userNameEdit)) == 'Level One') {echo "selected=\"selected\"";} ?>>Level One</option>
   <option value="Level Two" <?php if (htmlspecialchars(userSecurityLevel($dbSingleUse,$userNameEdit)) == 'Level Two') {echo "selected=\"selected\"";} ?>>Level Two</option>
 </select><br  />
 <?php echo htmlspecialchars(userSecurityLevel($dbSingleUse,$userNameEdit)); ?>
      </td>                    

<td>
     	<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 60px;"><?php if ($myEditAction == 'EditSingleUser') {echo '  Save ';} else {echo '  Add  ';} ?></button>

            </td></tr>
<tr ><td></td></tr>
</form>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><form action="index.php?myAction=Maintenance" method="post" name="form2" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="Maintenance" />
    <?php if ($myEditAction == 'EditSingleUser') {
		echo '<input name="myEditAction" type="hidden" id="myEditAction" value="EditUsers" />';
	}?>
    <button type="submit" class="formbutton" name="cancelChanges" id="cancelChanges" style="width: 60px;"><?php if ($myEditAction == 'EditSingleUser') {echo 'Cancel';} else {echo 'Return';}?></button></form> </td>
</tr>
</table>
* - required fields


	




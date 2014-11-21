<script>
function clearData(pInput) {
 if (pInput == 'buildCompletionDate') {
 	document.forms["SetCompleteDateForm"].elements["buildCompletionDate"].value = '';
 	document.forms["SetCompleteDateForm"].elements["buildCompletionDateDisplay"].value = '';
 }


}

 </script>

<form action="" method="post" name="SetCompleteDateForm" target="_self">
    <input name="myAction" type="hidden" id="myAction" value="Lot" />
    <input name="lotID" type="hidden" id="lotID" value="<?php echo $resultRow->lotID; ?>" />
    <input name="myEditAction" type="hidden" id="myEditAction" value="SaveBuildCompletionDate" />
       <SCRIPT>$(function() {
                       $("#buildCompletionDate").datepicker({ 
					     altField: ('#buildCompletionDateDisplay'),
					    numberOfMonths: 1,
						showOn: "button",
						changeMonth: true,
						changeYear: true,
						buttonImage: "images/calendar.gif",
						yearRange: 'c-80:c+10',
						buttonImageOnly: true,
                		showButtonPanel: true,
				        dateFormat: 'dd-M-yy',
					    showAnim: 'fadeIn'});
                        }); 
         </SCRIPT>
        <img src="images/delete-icon.gif" name="a1" width="15" height="15"  border="0" usemap="#pswd" id="a1" style="cursor:hand" 	onclick="clearData('buildCompletionDate')" />
  <input name="buildCompletionDateDisplay" type="text" value="<?php if (isset($resultRow->buildCompletionDate) &&  $resultRow->buildCompletionDate > '0000-00-00') {echo date('d-M-Y',strtotime($resultRow->buildCompletionDate));} ?>" id="buildCompletionDateDisplay" style="width:80px;" disabled="disabled"  />
  <input name="buildCompletionDate" type="hidden" value="<?php if (isset($resultRow->buildCompletionDate) &&  $resultRow->buildCompletionDate > '0000-00-00') {
	  echo date('d-M-Y',strtotime($resultRow->buildCompletionDate)); }  ?>" id="buildCompletionDate" style="width:80px;"
   /> 
	<button type="submit" class="formbutton" name="saveData" id="saveData" style="width: 80px;">Save Date</button>   
   </form>

<?  
require_once('check_session.php');
require_once ("classes/login_functions.php");
require_once ("classes/misc_functions.php");
require_once('initialize_logic.php');

?>

<?php

$query='select * from tradeList where id='.$_GET["tradeID"]. ' limit 1';
$db2->Query($query);
//$row = mysql_fetch_row($db);

//echo $row;
?>
	<div class="sub-title">Add New Dish</div>
    <div class="content">
	<form name="frmDishAdd" enctype="multipart/form-data" action="restaurantDishes/add/" method="post">
<input type="hidden" value="51f8041f04810e3fb99846be5721a7ee" name="APPHP_CSRF_TOKEN" />

<span class="required-fields-alert">Items marked with an asterisk (*) are required</span>
<input id="frmDishAdd_APPHP_FORM_ACT" type="hidden" value="send" name="APPHP_FORM_ACT" />
<div class="row" id="frmDishAdd_row_0"><label for="frmDishAdd_icon">Image:</label><div style="display:inline-block;"><input class="file" size="25" disabled="disabled" type="file" value="" name="icon" id="icon" /></div></div>
<div class="row" id="frmDishAdd_row_1"> $ <label for="frmDishAdd_price">Price: <span class="required">*</span></label><input maxlength="8" class="small" id="frmDishAdd_price" type="text" value="0.00" name="price" /></div>
<div class="row" id="frmDishAdd_row_2"> $ <label for="frmDishAdd_price_takeaway">Takeaway Price: <span class="required">*</span></label><input maxlength="8" class="small" id="frmDishAdd_price_takeaway" type="text" value="0.00" name="price_takeaway" /></div>
<div class="row" id="frmDishAdd_row_3"><label for="frmDishAdd_is_takeaway">Take Away:</label><input id="frmDishAdd_is_takeaway" type="checkbox" value="1" name="is_takeaway" /></div>
<div class="row" id="frmDishAdd_row_4"><label for="frmDishAdd_is_active">Active:</label><input id="frmDishAdd_is_active" value="1" checked="checked" type="checkbox" name="is_active" /></div>
<div class="row" id="frmDishAdd_row_5"><label for="frmDishAdd_sort_order">Sort Order: <span class="required">*</span></label><input maxlength="3" class="small" id="frmDishAdd_sort_order" type="text" value="0" name="sort_order" /></div>
<fieldset>
<legend><img width="16px" src="images/flags/en.gif"> &nbsp;English</legend>
<div class="row" id="frmDishAdd_row_6"><label for="frmDishAdd_name_en">Dish Name: <span class="required">*</span></label><input maxLength="125" id="frmDishAdd_name_en" type="text" value="" name="name_en" /></div>
<div class="row" id="frmDishAdd_row_7"><label for="frmDishAdd_description_en">Description:<br>max.: 256 chars</label><textarea maxLength="256" id="frmDishAdd_description_en" name="description_en"></textarea></div>
</fieldset>
<div class="buttons-wrapper">
<input name="" value="Create" type="submit" />
<input name="" class="button white" onclick="$(location).attr('href','http://www.apphp.com/php-restaurant-site/examples/sample2/restaurantDishes/manage');" value="Cancel" type="button" />
</div>
</form>
    </div>
</div>
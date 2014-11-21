<script>
function isAlphaNumberKey(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode;
	 if ( ((charCode >= 48 && charCode <= 57) || charCode==231 || charCode==199) || (charCode==241 || charCode==209) ||(charCode==8 || charCode==32) || ( (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) ) ) {
	 	return true;
	 }
	 else {
		 return false;
	 }
}

function formatCurrency(strValue)
{
strValue = strValue.toString().replace(/\$|\,/g,'');
	dblValue = parseFloat(strValue);

	blnSign = (dblValue == (dblValue = Math.abs(dblValue)));
	dblValue = Math.floor(dblValue*100+0.50000000001);
	intCents = dblValue%100;
	strCents = intCents.toString();
	dblValue = Math.floor(dblValue/100).toString();
	if(intCents<10)
		strCents = "0" + strCents;
	for (var i = 0; i < Math.floor((dblValue.length-(1+i))/3); i++)
		dblValue = dblValue.substring(0,dblValue.length-(4*i+3))+','+
		dblValue.substring(dblValue.length-(4*i+3));
	return (((blnSign)?'':'-') + '$ ' + dblValue + '.' + strCents);
}
function formatDecimal(strValue)
{
strValue = strValue.toString().replace(/\$|\,/g,'');
	dblValue = parseFloat(strValue);

	blnSign = (dblValue == (dblValue = Math.abs(dblValue)));
	dblValue = Math.floor(dblValue*100+0.50000000001);
	intCents = dblValue%100;
	strCents = intCents.toString();
	dblValue = Math.floor(dblValue/100).toString();
	if(intCents<10)
		strCents = "0" + strCents;
	for (var i = 0; i < Math.floor((dblValue.length-(1+i))/3); i++)
		dblValue = dblValue.substring(0,dblValue.length-(4*i+3))+','+
		dblValue.substring(dblValue.length-(4*i+3));
	return (((blnSign)?'':'-')  + dblValue + '.' + strCents + '%');
}

function validateNumber(evt) { 
  var theEvent = evt || window.event; 
  var key = theEvent.keyCode || theEvent.which; 
//  alert(key);
  if ((key < 48 || key > 57) && !(key == 8 || key == 9 || key == 13 || key == 37 || key == 39 || key == 46 || key == 45) ){ 
    theEvent.returnValue = false; 
    if (theEvent.preventDefault) theEvent.preventDefault(); 
  } 
} 

function validateNumberField(xField, evt) { 
  var theEvent = evt || window.event; 
	alert(xField);
    theEvent.returnValue = false; 
    if (theEvent.preventDefault) theEvent.preventDefault(); 
} 

// Check if string is currency 
var isCurrency_re    = /^\s*(\+|-)?((\d+(\.\d\d)?)|(\.\d\d))\s*$/; 
function isCurrency (s) { 
   return String(s).search (isCurrency_re) != -1 
} 


function checkFormData(theForm) {
 var returnVar = true;
 if (theForm.name == "AmendmentMainForm") {
	 var amendmentResalePrice = theForm.elements["amendmentResalePrice"].value;
	 if (isCurrency(amendmentResalePrice) == false)  {
		 alert("The price entered is not a valid currency value: " + amendmentResalePrice);
		 returnVar = false;
	 }
 }
 if (theForm.name == "ChangeOrderMainForm") {
	 var changePrice = theForm.elements["changePrice"].value;
	 if (isCurrency(changePrice) == false)  {
		 alert("The price entered is not a valid currency value: " + changePrice);
		 returnVar = false;
	 }
 }

 if (theForm.name == "WorkCreditMainForm") {
	 var workCreditPrice = theForm.elements["workCreditPrice"].value;
	 if (isCurrency(workCreditPrice) == false)  {
		 alert("The price entered is not a valid currency value: " + workCreditPrice);
		 returnVar = false;
	 }
 }
 if (theForm.name == "FeatureMainForm") {
	 var featureResalePrice = theForm.elements["featureResalePrice"].value;
	 if (isCurrency(featureResalePrice) == false)  {
		 alert("The price entered is not a valid currency value: " + featureResalePrice);
		 returnVar = false;
	 }
 }
 if (theForm.name == "CoreOfferForm") {
	 var numberOfBedrooms = theForm.elements["numberOfBedrooms"].value;
	 if (isCurrency(numberOfBedrooms) == false)  {
		 alert("The number of bedrooms is not a valid value: " + numberOfBedrooms);
		 returnVar = false;
	 }
	 var offerPrice = theForm.elements["offerPrice"].value;
	 if (isCurrency(offerPrice) == false)  {
		 alert("The offer price entered is not a valid currency value: " + offerPrice);
		 returnVar = false;
	 }
	 var offerDiscountAmount = theForm.elements["offerDiscountAmount"].value;
	 if (isCurrency(offerDiscountAmount) == false)  {
		 alert("The offer discount entered is not a valid currency value: " + offerDiscountAmount);
		 returnVar = false;
	 }
 }

 return returnVar;
 }

</script>

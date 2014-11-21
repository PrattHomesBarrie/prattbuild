<!DOCTYPE html>
<html>
<head>
  <link href="js/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
  <script src="js/jquery-1.6.2.min.js"></script>
  <script src="js/jquery-ui-1.8.16.custom.min.js"></script>
  
</head>
<body style="font-size:62.5%;">
  <script>
  $(document).ready(function() {
    $("#datepicker").datepicker();
  });
  </script>
  
<div id="datepicker"></div>


 <input name="ctl00$MainContent$txtImageButton" type="text" value="11-30-2011" id="ctl00_MainContent_txtImageButton" style="width:80px;" />

 <div style="padding: 25px;">
        <div class="samplebox">
        <h3>Text Box AutoPopup:</h3>
        <hr />
        This version pops up the calendar on field activation:<br /><br />
                
        Enter Date: <input name="ctl00$MainContent$txtAutoPopupDate" type="text" value="12/30/2011" id="ctl00_MainContent_txtAutoPopupDate" style="width:80px;" />
        </div>

</body>
</html>

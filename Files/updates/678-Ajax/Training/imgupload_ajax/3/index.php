<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>How to Upload Image using jQuery with progress in PHP | PGPGang.com</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
</style>
<!--<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="http://malsup.github.com/jquery.form.js"></script> 
	 
<script>
    $(document).ready(function() {
    	//elements
    var progressbox     = $('#progressbox');
    var progressbar     = $('#progressbar');
    var statustxt       = $('#statustxt');
    var submitbutton    = $("#SubmitButton");
    var myform          = $("#UploadForm");
    var output          = $("#output");
    var completed       = '0%';
 
    $(myform).ajaxForm({
        beforeSend: function() { //brfore sending form
        submitbutton.attr('disabled', ''); // disable upload button
        statustxt.empty();
        //progressbox.slideDown(); //show progressbar
       // progressbar.width(completed); //initial value 0% of progressbar
        statustxt.html(completed); //set status text
        statustxt.css('color','#000'); //initial color of status text
        },
        uploadProgress: function(event, position, total, percentComplete) { //on progress
        progressbar.width(percentComplete + '%') //update progressbar percent complete
        statustxt.html(percentComplete + '%'); //update status text
        if(percentComplete>50)
        {
            statustxt.css('color','#fff'); //change status text to white after 50%
        }
    },
    complete: function(response) { // on complete
    output.html(response.responseText); //update element with received data
    myform.resetForm();  // reset form
    submitbutton.removeAttr('disabled'); //enable submit button
    progressbox.slideUp(); // hide progressbar
}
});
});
</script>
<style>
    #progressbox {
    border: 1px solid #0099CC;
    padding: 1px;
    position:relative;
    width:400px;
    border-radius: 3px;
    margin: 10px;
    display:none;
    text-align:left;
    }
    #progressbar {
    height:20px;
    border-radius: 3px;
    background-color: #003333;
    width:1%;
    }
    #statustxt {
    top:3px;
    left:50%;
    position:absolute;
    display:inline-block;
    color: #000000;
    }
</style>
</head>
<body>
<form action="processupload.php" method="post" enctype="multipart/form-data" id="UploadForm">
    <table width="500" border="0">
        <tr>
            <td>File : </td>
            <td><input name="ImageFile" type="file" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit"  id="SubmitButton" value="Upload" /></td>
        </tr>
    </table>
</form>
<div id="progressbox">
    <div id="progressbar"></div >
    <div id="statustxt">0%</div >
</div>
<div id="output"></div>
</body>
</html>
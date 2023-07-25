<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>


<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


</head>

<body>


<script type="text/javascript">

document.title = "blah";

var origTitle = document.title;
document.title = "You have ("+x+") new messages - "+origTitle;

var origTitle = document.title;
var isChatTab = false; // Set to true/false by separate DOM event.
var animStep = true;
var animateTitle = function() {
    if (isChatTab) {
        if (animStep) {
            document.title = "You have ("+x+") new messages - "+origTitle;
        } else {
            document.title = origTitle;
        }
        animStep = !animStep;
    } else {
            document.title = origTitle;
            animStep = false;
    }
    setTimeout(animateTitle, 5000);
};

animateTitle();

</script>

</body>
</html>
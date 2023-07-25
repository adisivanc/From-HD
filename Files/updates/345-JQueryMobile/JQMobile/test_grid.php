<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>


  <!-- Include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Include jQuery Mobile stylesheets -->
  <link rel="stylesheet" href="css/jquery.mobile-1.4.5.css">
  <!-- My Style sheet -->
  <link rel="stylesheet" href="css/mobile.css">
  
  <!-- Include the jQuery library -->
  <script src="js/jquery.js"></script>
  <!-- Include the jQuery Mobile library -->
  <script src="js/jquery.mobile-1.4.js"></script>
   <!-- My Style sheet -->
  <script src="js/mobile.js"></script>
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  
  
  
<style>




	
/* Basic styles */
.rwd-example .ui-body {
    text-align: left;
    border-color: #ddd;
}
.rwd-example p {
    color: #777;
    line-height: 140%
}
/* Stack all blocks to start */
.rwd-example .ui-block-a,
.rwd-example .ui-block-b,
.rwd-example .ui-block-c {
    width: 100%;
    float: none;
}
/* Collapsing borders */
.rwd-example > div + div .ui-body {
    border-top-width: 0;
}

/* 1st breakpoint - Float B and C, leave A full width on top */
@media all and (max-width: 23em) {
    .rwd-example {
        overflow: hidden; /* Use this or a "clearfix" to give the container height */
    }
    .rwd-example .ui-body {
       min-height: 14em;
    }
    .rwd-example .ui-block-b,
    .rwd-example .ui-block-c {
      float: left;
      width: 49.95%;
    }
    .rwd-example .ui-block-b p,
    .rwd-example .ui-block-c p {
      font-size: .8em;
    }
    .rwd-example > div + div .ui-body {
        border-top-width: 1px;
    }
    .rwd-example > div:first-child .ui-body {
        border-bottom-width: 0;
    }
    .rwd-example > div:last-child .ui-body {
        border-left-width: 0;
    }
}



</style>

</head>

<body style="padding:0; margin:0;">


<div class="rwd-example">
    <!-- Lead story block -->
    <div class="ui-block-a">
        <div class="ui-body ui-body-d">
            <h2>Apple schedules 'iPad Mini' event for October 23</h2>
            <p>One of the worst-kept secrets in tech has been confirmed: Apple will hold an event October 23 in San Jose, California, at which the company is widely expected to unveil a smaller, cheaper version of its popular iPad called "Mini".</p>
        </div>
    </div>
    <!-- secondary story block #1 -->
    <div class="ui-block-b">
        <div class="ui-body ui-body-d">
            <h4>Microsoft Surface tablet goes on sale for $499</h4>
            <p>The Microsoft Surface tablet picture has come into focus. The Redmond giant filled in the blanks on the new tablet's availability and specs.</p>
        </div>
    </div>
</div><!-- /rwd-example -->




</body>
</html>
<?
	ob_start();
	session_start();
	include 'includes.php';
	$PageUrlArr = explode('/',$_SERVER['SCRIPT_NAME']);
	$curpage=end($PageUrlArr);
	
	switch($curpage)
	{
		case 'index.php':
		{
			$description='Green India Eco Products One stop destination for all your building needs';
			$keywords='Wall Putty, materials, low price, product ';
			$title='Home | Green India Eco Products ';
			break; 
		}
		case 'aboutus.php':
		{
			$description='Owing to the efficient working methodology of our professionals, we have streamlined our business operations';
			$keywords='Wall Putty, materials, low price, product ';
			$title='About Us | Green India Eco Products ';
			break; 
		}
		case 'contact.php':
		{
			$description='Please feel free to call us, send us an email, or even visit us and let us know how we can assist you.';
			$keywords='Wall Putty, materials, low price, product ';
			$title='Contact Us | Green India Eco Products';
			break; 
		}
		case 'wallputty.php':
		{
			$description='Green India Wall Putty gives you best value for your money as it reduces repainting frequency';
			$keywords='Wall Putty, materials, low price, product ';
			$title='Wall Putty | Green India Eco Products ';
			break; 
		}
		case 'dealer.php':
		{
			$description='Green India Wall Putty gives you best value for your money as it reduces repainting frequency';
			$keywords='Wall Putty, Dealer, Distribution, Distributor, product ';
			$title='Dealer | Green India Eco Products ';
			break; 
		}
		default:
		{
			$description='Green India Eco Products';
			$keywords='wall putty, adhesive, white cement, quality, japanese tehnology, building, G-Lose, Coimbatore,  ';
			$title='Green India Eco Products | One stop destination for all your building needs ';
			break; 
		}
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />

<link rel="icon" href="images/logo.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />


<script src="js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="js/default.js" type="text/javascript"></script>
<script src="js/jquery.panelslider.js" type="text/javascript"></script>
<script language="javascript" src="js/jquery-ui-1.8.11.custom.js"></script>
<title><?=$title?></title>
<meta name="description" content="<?=$description?>" />
<meta name="keywords" content="<?=$keywords?>"  />


<script>

jQuery(document).ready(function($){
$(window).on('pageshow', function(event) {
	if(event.originalEvent.persisted) {
		$('body').removeClass('loading');
	}
});

//iOS check...ugly but necessary
if(navigator.userAgent.match(/iPhone|iPad|iPod/i)) {
	$(document).on('show.bs.modal', '.modal', function(event){
		var $self = $(this);
		setTimeout(function(){
			$('.modal-backdrop').css({position:'absolute', top:0, left:0, width:'100%',
				height: Math.max(
					document.body.scrollHeight, document.documentElement.scrollHeight,
					document.body.offsetHeight, document.documentElement.offsetHeight,
					document.body.clientHeight, document.documentElement.clientHeight
				)+'px'
			});
			$self.css({position:'absolute', marginTop:$(window).scrollTop()+'px', height:window.innerHeight});
		}, 0);
	});
}

});


(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-69297320-1', 'auto');
ga('send', 'pageview');

</script>

</head>

<body>

<div class="menu_container">
  <div class="container">
      <div class="logo"> <a href="<?=getSeoUrl(array('pn'=>'index.php'))?>"> <img src="images/logo.png" alt="Green India" title="Green India" /> </a> </div>
      <div class="menu_bg"> 
        <div class="green_head">
            <h2>GREEN INDIA ECO PRODUCTS</h2> 
            <h4>One stop destination for all your building needs</h4> 
        </div>
        <div class="green_menubtn"> <a id="right-panel-link" href="#right-panel"><img src="images/menu_line.png" alt="Menu" title="Menu" /></a> </div>
      </div>
  </div>
</div>

<div id="right-panel" class="panel">
    <ul class="green_menu">
        <li><a href="<?=getSeoUrl(array('pn'=>'index.php'))?>">Home</a></li>
        <li id="open_products">
        	<a href="javascript:void(0)">Products</a>
        	<ul>
            	<li><a href="<?=getSeoUrl(array('pn'=>'wallputty.php'))?>">Wall Putty</a></li>
                <!-- <li><a href="javascript:void(0)">Tile Adhesive</a></li>
                <li><a href="javascript:void(0)">G-Lose</a></li> -->
            </ul>
        </li>
        <!--<li><a href="javascript:void(0)">Partners</a></li>-->
        <li><a href="<?=getSeoUrl(array('pn'=>'aboutus.php'))?>">About Us</a></li>
        <li><a href="<?=getSeoUrl(array('pn'=>'contact.php'))?>">Contact</a></li>
    </ul>
</div>



<div class="container_fluid main_content" id="main_content">
    <? main(); ?>
</div>




<div class="footer_container"> <!-- Footer -->
  <div class="container">
    
    <div class="row"> 
        <div class="footer_address"> <!-- Footer Left -->
            <div class="footer_logo">
                <a href="<?=getSeoUrl(array('pn'=>'index.php'))?>"> <img src="images/logo.png" alt="Green India" title="Green India" /> </a>
                GREEN INDIA <br/> ECO PRODUCTS
            </div>
            <p>
                394-A, Nanjundapuram Road, <br/> Ramanathapuram, <br/> Coimbatore - 641 045. <br/> +91 97870 97970, +91 95004 08880 
            </p>
        </div> <!-- Footer Left -->
        
        <div class="footer_menu"> <!-- Footer Right -->
            <div class="footer_classify">
                <h4>Products</h4>
                <ul>
                    <li><a href="<?=getSeoUrl(array('pn'=>'wallputty.php'))?>">Wall Putty</a></li>
                    <!-- <li><a href="javascript:void(0)">Tile Adhesive</a></li> -->
                    <!-- <li><a href="javascript:void(0)">G-Lose</a></li> -->
                </ul>
            </div>
            
            <!--
            <div class="footer_classify">
                <h4>Partners</h4>
                <ul>
                    <li><a href="javascript:void(0)">Dealers</a></li>
                    <li><a href="javascript:void(0)">Painters</a></li>
                </ul>
            </div>
            -->
            
            <div class="footer_classify">
                <h4>About Us</h4>
                <ul>
                    <li><a href="<?=getSeoUrl(array('pn'=>'aboutus.php'))?>">Company Profile</a></li>
                </ul>
            </div>
            
            <div class="footer_classify">
                <h4>Contact</h4>
                <ul>
                    <li><a href="<?=getSeoUrl(array('pn'=>'contact.php'))?>">Contact Us</a></li>
                </ul>
            </div>
            
        </div> <!-- Footer Right -->
    </div>
    
  </div>
</div> <!-- Footer -->



<script type="text/javascript">

$('#right-panel-link').panelslider({
  bodyClass: 'ps-active-right',
  clickClose: true,
  onOpen: function() { console.log('right panel open'); }
});

$('#close-panel-bt').click(function() { $.panelslider.close(); });

$('#right-panel').on('psBeforeOpen psOpen psBeforeClose psClose', function(e) {
  console.log(e.type, e.target.getAttribute('id'));
});


$(document).on( 'scroll', function(){
	$.panelslider.close(); 
});	
	
	
$(document).ready(function(){

	var menu_ht=$(".menu_container").height();
	var screen_wd= $(window).width();
	
	if ( screen_wd > 640) {
		$(".menu_container").css({"position":"fixed"},{"top":"100px"});
		$("#main_content").css({"margin-top":"115px"});
	}
	else {
		$("#main_content").css({"position":"relative"},{"top":"0px"});
	}
});
	
	
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	
	return true;
}


$('#open_products').click(function() {
	$('#open_products ul').toggle(500);
});
	
</script>
   
</body>
</html>
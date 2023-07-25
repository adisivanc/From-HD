<?
function main(){
?>

<? include "page_header.php"; ?>

<div class="content_outer">
<div class="content">

    <div class="page_title">WE BUILD INTELLIGENT & BEAUTIFUL WEBSITES</div>

    <div class="descfull">The internet has changed the world we live in, including the way businesses communicate with customers. MMS is an "A to Z" Web development company that always keeps its services up to date 
    with the latest market trends, providing customers all over the world with best-of-class, easily extensible Internet products. Our solutions range from custom website designs to business application 
    development of any complexity.
    </div>
    
    <div class="descfull">The company's specialists help clients efficiently present their businesses on the Internet, develop solutions that rise to meet all business needs and/or improve existing systems. Our business 
    practices, combined with the utmost attention to detail, are a proven combination that enables our highly experienced team to provide clients with efficient, reliable and affordable solutions.</div>


	<div id="service_listout">

    	<div class="service_listinner">
        <div class="services_center">
        	<div class="services_themeimg"><img src="images/webdesign_img.png" border="0" /></div>
            <div class="services_hd">WEB DESIGN &amp;<br/> BUILD</div>
        	<div class="services_desc">Beautiful, engaging websites that deliver<br/>strong ROI.</div>
            <div class="services_readmore"><a href="<?=getSeoUrl(array('pn'=>'service_detail.php','Type'=>'WEB'))?>" class="readmore">Read more <img src="images/arrow_blue.png" border="0" /></a></div>
        </div>
        </div>
    
    	<div class="service_listinner">
        <div class="services_center">
        	<div class="services_themeimg"><img src="images/iMarketing_img.png" border="0" /></div>
            <div class="services_hd">INTERNET<br/>MARKETING</div>
        	<div class="services_desc">Successful SEO campaigns that deliver<br/>tangible results.</div>
            <div class="services_readmore"><a href="<?=getSeoUrl(array('pn'=>'service_detail.php','Type'=>'INTERNET'))?>" class="readmore">Read more <img src="images/arrow_blue.png" border="0" /></a></div>
        </div>
        </div>


    	<div class="service_listinner">
        <div class="services_center">
        	<div class="services_themeimg"><img src="images/mobile_img.png" border="0" /></div>
            <div class="services_hd">MOBILE &amp;<br/> APP LAYOUTS</div>
        	<div class="services_desc">Engaging mobile websites and applications.</div>
            <div class="services_readmore"><a href="<?=getSeoUrl(array('pn'=>'service_detail.php','Type'=>'MOBILE'))?>" class="readmore">Read more <img src="images/arrow_blue.png" border="0" /></a></div>
        </div>
        </div>


    	<div class="service_listinner">
        <div class="services_center">
        	<div class="services_themeimg"><img src="images/visual_img.png" border="0" /></div>
            <div class="services_hd">VISUAL<br/>BRANDING</div>
        	<div class="services_desc">Creating strong brands and creative graphics.</div>
            <div class="services_readmore"><a href="<?=getSeoUrl(array('pn'=>'service_detail.php','Type'=>'VISUAL'))?>" class="readmore">Read more <img src="images/arrow_blue.png" border="0" /></a></div>
        </div>
        </div>
    
    </div>


</div>
</div>

<div style="width:100%; float:left; background:#f0f0f0;">
<? include "getquote.php"; ?>
</div>


<?
}
include "template.php";
?>
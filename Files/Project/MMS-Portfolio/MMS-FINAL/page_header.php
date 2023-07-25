<? 

$PageUrlArr=explode('/',$_SERVER['SCRIPT_NAME']);
$curpage=$PageUrlArr[2];

if($curpage=='services.php' || $curpage=='service_detail.php'){ ?>

<div class="page_header">
<div class="content">
	<h1 class="pagehd">SERVICES</h1>	
	<div class="pagenav">
    <a href="<?=getSeoUrl(array('pn'=>'index.php'))?>" class="pagenav_home">Home ></a> 
    <a href="<?=getSeoUrl(array('pn'=>'services.php'))?>" class="pagenav_page <?=($curpage=='service_detail.php')?'txtblack':''?>">Services</a>
    <? if($_REQUEST['Type']=='WEB'){ ?> >> Web Design &amp; Build<? } elseif($_REQUEST['Type']=='INTERNET') { ?> >> Internet Marketing<? } elseif($_REQUEST['Type']=='MOBILE') { ?>
    >> Mobile &amp;  App Layouts <? } elseif($_REQUEST['Type']=='VISUAL') { ?> >> Visual Branding <? }?>
    </div>
</div>
</div>

<? } ?>


<? if($curpage=='about.php'){ ?>

<div class="page_header">
<div class="content">
	<h1 class="pagehd">ABOUT US</h1>	
	<div class="pagenav"><a href="<?=getSeoUrl(array('pn'=>'index.php'))?>" class="pagenav_home">Home ></a> <a href="<?=getSeoUrl(array('pn'=>'about.php'))?>" class="pagenav_page">About Us</a></div>
</div>
</div>

<? } ?>


<? if($curpage=='methodology.php'){ ?>

<div class="page_header">
<div class="content">
	<h1 class="pagehd">METHODOLOGY</h1>	
	<div class="pagenav"><a href="<?=getSeoUrl(array('pn'=>'index.php'))?>" class="pagenav_home">Home ></a> <a href="<?=getSeoUrl(array('pn'=>'methodology.php'))?>" class="pagenav_page">Methodology</a></div>
</div>
</div>

<? } ?>


<? if($curpage=='portfolio.php'){ ?>

<div class="page_header">
<div class="content">
	<h1 class="pagehd">PORTFOLIO</h1>	
	<div class="pagenav"><a href="<?=getSeoUrl(array('pn'=>'index.php'))?>" class="pagenav_home">Home ></a> <a href="<?=getSeoUrl(array('pn'=>'portfolio.php'))?>" class="pagenav_page">Portfolio</a></div>
</div>
</div>

<? } ?>


<? if($curpage=='contact.php'){ ?>

<div class="page_header">
<div class="content">
	<h1 class="pagehd">CONTACT</h1>	
	<div class="pagenav"><a href="<?=getSeoUrl(array('pn'=>'index.php'))?>" class="pagenav_home">Home ></a> <a href="<?=getSeoUrl(array('pn'=>'contact.php'))?>" class="pagenav_page">Contact</a></div>
</div>
</div>

<? } ?>


<? if($curpage=='career.php' || $curpage=='career_form.php'){ ?>

<div class="page_header">
<div class="content">
	<h1 class="pagehd">CAREERS</h1>	
	<div class="pagenav">
    	<a href="<?=getSeoUrl(array('pn'=>'index.php'))?>" class="pagenav_home">Home ></a> 
        <a href="<?=getSeoUrl(array('pn'=>'career.php'))?>" class="pagenav_page <?=($curpage=='career_form.php')?'txtblack':'' ?>">Career</a>
        <? if($_REQUEST['Type']=='PHPDEV'){ ?> >> Php Developer<? } elseif($_REQUEST['Type']=='JPHPDEV') { ?> >> Junior Php Developer<? } ?>
    </div>
</div>
</div>

<? } ?>

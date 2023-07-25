<?
	ob_start();
	session_start();
	include 'includes1.php';
	$PageUrlArr = explode('/',$_SERVER['SCRIPT_NAME']);
	 $curpage=end($PageUrlArr);
	
	
	switch($curpage)
	{
		case 'index.php':
		{
			$description='Every child is uniquely intelligent. No child is compared to that of the other. It is the responsibility of the school and the parent to identify the unique gift of each child.';
			$keywords='yellow train, children, school, Kinder Garten, Primary & middle School, Human Being, learning, intelligent, responsibility, Relationship, development, Founded, Love.';
			$title='Yellow Train | Kinder Garten ,Primary and middle School in Coimbatore -  Waldorf Education System.';
			break; 
		}
		case 'yt_grade_school.php':
		{
			$description='The school is set up in an organic farm. The classrooms are spacious, flooded with light, air and energy.';
			$keywords='classroom, flooded, air, light, energy, beautiful, rainbow, Little caves, tunnels, amla trees, sheep grazing, ducks quacking, endless blue skies,Grade School Campus, Board & Curriculum, Meet our Akkas, Upcoming Events, Cognitive, Artistic Development, Handwork, Physical Development, Assessments, methodology, Rudolf Steiner, Teacher, Kids Festival.';
			$title='YT Grade School | Yellow Train';
			break; 
		}
		case 'curriculum.php':
		{
			$description='The methodology and curriculum in Yellow Train is inspired by the pioneering work of Rudolf Steiner (Waldorf Education).';
			$keywords='Cognitive Development, Artistic Development, Handwork, Physical Development, Assessment, metacognition, social cognition, Poetry, Drama,Art, Gallery, drawing, Music, Western Classical pianist, Musicians exposure, Clay Modeling, Stitching, hand knitting, braiding, crochet, Pottery, Carpentry, linguistic talent, hobby, master spelling, sentence construction, Arithmetic, Sports, Land work,teachers, progress, children. ';
			$title='Curriculum | Yellow Train';
			break; 
		}        
		case 'contact.php':
		{
			$description='Please feel free to get in touch with us at any time. We love to receive feedback about the site.';
			$keywords='Yellow Train Grade School, Mudalipalayam, coimbatore, ytgradeschool@gmail.com';
			$title='Contact | Yellow Train';
			break; 
		}
		case 'funstop.php':
		{
			$description='YT always celebrates the magic of childhood by organizing fun filled events throughout the year.';
			$keywords='Pongal Celebration, New Year Celebration, Krishna Jeyanthi Celebration, Krishna Jeyanthi Celebration, events.';
			$title='Gallery | Yellow Train';
			break; 
		}
		case 'yt_rhythm.php':
		{
			$description='As part of everyday rhythm children are expected to work with Language and Arithmetic during YT Fundamentals.';
			$keywords='Breakfast, Golden Silence, Morning Circle, Main Lession, Fruit & Play, Yt Fundamentals, Language Block, Art & Handwork Block, Closure, rhythm.';
			$title='Rhythm | Yellow Train';
			break; 
		}
		case 'free_human_being.php':
		{
			$description='Freedom, to us, means the choice and the capability to be oneself at the core, at the deepest level.';
			$keywords='Freedom, capability, human being, imagination, responsibility, Rudolf Steiner, human spirit, Yellow Train .';
			$title='Free human being | Yellow Train';
			break; 
		}
		case 'yt_methodology.php':
		{
			$description='Waldorf education strives to transform education into an art ';
			$keywords='methodology, Rudolf Steiner, Mathematics, Environmental Science,Creative ';
			$title='Methodology | Yellow Train';
			break; 
		}
		
		case 'yt_practices.php':
		{
			$description='The school is inspired by Rudolf Steiner and his work.';
			$keywords='Mindfulness Practices, Night School, Surprise Days, Lazy Days, Happy Teachers Sangha, Water Green Field Kitchen, Kite Festival, Sanctum, Golden Silence, Christmas Bazaar.';
			$title='YT Practices | Yellow Train';
			break; 
		}
		case 'belief.php':
		{
			$description='Every child is uniquely intelligent. No child is compared to that of the other. It is the responsibility of the school and the parent to identify the unique gift of each child.';
			$keywords='Learning, Values, character formation ,body work, art, spirituality, extra -curricular activities, Rudolf Steiner.';
			$title='Our Belief & Values | Yellow Train';
			break; 
		}
		case 'teacher.php':
		{
			$description='The teacher is the most important and pivotal pillar of the school and this is reflected in their role in the school.';
			$keywords='Akkas, partners, warmth, love, respect, trust, Chitra,Mayura, Anitha, Mona, Aparna, Nalini, Vijaya, Usharani, Karpagam.';
			$title='Meet Our Akkas | The Teacher | Yellow Train';
			break; 
		}
		case 'videos.php':
		{
			$description='The practices that lets our children experience the magic of childhood.';
			$keywords='Videos, children, experience, practices.';
			$title='Videos | Yellow Train';
			break; 
		}
		case 'press.php':
		{
			$description='The practices that lets our children experience the magic of childhood.';
			$keywords='press, children, practices, experience.';
			$title='Press | Yellow Train';
			break; 
		}
		case 'admission.php':
		{
			$description='The admission process at Yellow Train School';
			$keywords='admission, children, Communications , management ,registration.';
			$title='Admission | Yellow Train';
			break; 
		}
		default:
		{
			$description='The yellow train school founded on love for children.';
			$keywords='methodology, Rudolf Steiner, Mathematics, Environmental Science,Creative, free human being, yellow train, school in coimbatore';
			$title='School founded for love of Children | Yellow Train';
			break;
		}
	}
?>
<!DOCTYPE html5 PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?=$description?>" />
<meta name="keywords" content="<?=$keywords?>"  />
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
<link rel="icon" href="images/logo.png" type="image/x-icon" />
<title>Yellow Train</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />
<!--[if IE 8]><link rel="stylesheet" type="text/css" href="css/style_ie8.css" /> <![endif]-->


<link rel="stylesheet" href="css/youtube-video-gallery.css" type="text/css" />
<link rel="stylesheet" href="css/test.css" type="text/css" />
<!--[if lt IE 9]>
<link href="css/youtube-video-gallery-legacy-ie.css" type="text/css" rel="stylesheet"/>
<![endif]-->

<!-- add colorbox -->
<link rel="stylesheet" type="text/css" href="css/colorbox.css" />

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/flaunt.js"></script>
<script type="text/javascript" src="js/mainjs.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script>

</head>

<body style="background-image:url(images/bg1.jpg); background-position: center center; background-attachment:fixed; background-size: cover;">


<div id="temp_menu">
<? include "template_menu.php"; ?>
</div>


<div id="main_container">

<?
$pageTitle = $GLOBALS['PageTitle'][$curpage]['Title'];
$pageSubTitle = $GLOBALS['PageTitle'][$curpage]['SubTitle'];
$pageMenuItems = $GLOBALS['PageTitle'][$curpage]['SubMenu'];

if($pageTitle!="" && $pageSubTitle!="") { 
?>
<div class="full_width add_pad"> 
<div class="page_menu" style="padding-top:0;">
<div class="content">
    <div class="page_menu_container">
    
        <div class="page_menutop">
            <h1 class="page_menuhd" style="margin-top:15px; "><?=$pageTitle?></h1>
            <div class="pagemenu_right">
                <div class="pagemenu_desctop"><?=$pageSubTitle?></div>
            </div>
        </div>
        
        <?
		if(count($pageMenuItems)>0) {
		?>
        <div class="page_menubtm">
            <ul>
        <?
			foreach($pageMenuItems as $K=>$V) {
		?>
                <li><a class="teacher <?=($V['Class']!="")?$V['Class']:""?> <?=($K==0)?"active":""?>" <?=($V['Id']!="")?$V['Id']:""?> <?=($V['URL']!="")?$V['URL']:""?>><?=$V['MenuItem']?></a></li>
        <?
			}
		?>
        	</ul>
        </div>
        <?
		}
		?>
        
    </div>
</div>
</div>
</div>
<? } ?>

<? 

main(); ?>


<?
$footerTabTitle = $GLOBALS['FooterArr'][$curpage]['Title'];
$footerItems = $GLOBALS['FooterArr'][$curpage]['Items'];
if($footerTabTitle!="") {
?>
<div class="full_width" style="padding-bottom:30px;"> 
<div class="content">
    
    <div class="contact_explore">
        <h2><?=$footerTabTitle?></h2>
        <? if(count($footerItems)>0) { ?>
        <ul>
        	<? foreach($footerItems as $kk=>$vv) { ?>
            <li><a <?=$vv['URL']?>><?=$vv['ItemName']?></a></li>
            <? } ?>
        </ul>
        <? } ?>
    </div>
    
</div>
</div>
<? } ?>

</div>



<div style="width:100%; height:auto; float:left;">
<? include "footer.php"; ?>
</div>




<!--<script type="text/javascript">

$('.nav-list').on('click', function(event) {
    event.preventDefault();
	
	var winwd2 = $(window).width();
	if(winwd2<=640)
	{
		$('.nav-submenu').slideUp();
		$(this).parent('.nav-list').slideDown();
		$(this).toggleClass('nav-rotate');
	}
	
});

</script> -->


<script type="text/javascript">
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 45 || charCode > 57))
	return false;
	
	return true;
}


</script>




</body>
</html>
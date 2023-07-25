<?
function main(){

if($_POST['act']=='loadMeetAkkas'){
	ob_clean();
	$akkaObj = new Teacher();
	//$akkaObj->school_id = 1;
	$rsAkkas = $akkaObj->getTeacherDtls();
	//Pagination 
		
	if($_POST['page']=='')
	$page=1;
	else
	$page = $_POST['page'];
	$totalReg = count($rsAkkas); 
	$PageLimit= 3;
	$adjacents = 1;
			
	$totalPages= ceil(($totalReg)/($PageLimit));
	if($totalPages==0) $totalPages=1;
	$StartIndex= ($page-1)*$PageLimit; 
		
	if(count($rsAkkas)>0) $rsAkkasArr = array_slice($rsAkkas,$StartIndex,$PageLimit,true); 
	if(count($rsAkkas)>0 && $totalPages>1){
		$table_val = generateFrontPagination($functionName="meetAkkasList", count($rsAkkas), count($rsAkkasArr), $pageLimit=$PageLimit, $adjacent=1, $page=$page, $type="");
	}
	
	if(count($rsAkkasArr)>0){
?>
	<div class="campus_row3">
		<div class="campus_row3_left"> 
			<h2>MEET OUR <br/>AKKAS</h2> 
			<!-- Pagination function -->
			<? echo $table_val;?>
            
			<p>What should children call teachers?<br/> Mam, Miss, Teacher, by name?<br/>Is it a mere form of addressing?<br/>Or does it establish the quality of<br/>the relationship?</p>
			<div class="pagination_desc">Our children call us akka.</div>
			<a href="<?=getSeoUrl(array('pn'=>'teacher.php'))?>" class="btn_yellow">Why Akka?</a>
			<!--<a class="btn_yellow">Why Akka?</a>-->
		</div>
		
		<div class="campus_row3_right">
			<div class="akka_slider_outer">
			<?
				foreach($rsAkkasArr as $K=>$V){ 
				if($V->photo!="") {
					$event_photo=(TEACHER_FILE_REL.$V->photo);
					$thumb_event_photo_name=(TEACHER_FILE_REL.'thumb_'.$V->photo);
					if(!file_exists($thumb_event_photo_name) || file_exists($thumb_event_photo_name)) 
					smart_resize_image($event_photo, null, 275, 156, true, $thumb_event_photo_name, false, false, 100);
				}
					
			?>
					<div class="akka_slider">
						<div class="akka_container">
							<div class="akka_slide_img"><img src="<?=$thumb_event_photo_name?>" alt="<?=ucwords($V->first_name)?>" title="<?=ucwords($V->first_name)?>" width="275" height="156" /></div>
							<div class="akkas_desc">
								<h2><?=$V->prefix?> <?=$V->first_name?></h2>
								<p><?=stripslashes(substr($V->description,0, 98))?></p>
								<!--<a href="<?=getSeoUrl(array('pn'=>'teacher.php'))?>" class="akka_readmore">read more...</a>-->
                                 <span onclick="showAkkaPopup('<?=$V->id?>')" class="akka_readmore" style="cursor:pointer">read more...</span>
							</div>
						</div>                        
					</div>
			<?
					}
			?>
			</div>
		</div>
	</div>
	<?
	}
	exit();
}

if($_POST['act']=='loadAkkaPopupDtls'){  
	ob_clean();
	$rsTeacherDtls = Teacher::getTeacherById($_POST['teacher_id']); 
	if($rsTeacherDtls->photo!="") {
		$teacher_photo=(TEACHER_FILE_REL.$rsTeacherDtls->photo);
		$thumb_teacher_photo_name=(TEACHER_FILE_REL.'thumb_'.$rsTeacherDtls->photo);
		if(!file_exists($thumb_teacher_photo_name) || file_exists($thumb_teacher_photo_name)) 
		smart_resize_image($teacher_photo, null, 275, 156, true, $thumb_teacher_photo_name, false, false, 100);
	}
	$rsAkkaNav = Teacher::getPreandNextTeacherById($_POST['teacher_id']);
	$rsPrevAkkaName = Teacher::getTeacherById($rsAkkaNav->previd); 
	$rsNextAkkaName = Teacher::getTeacherById($rsAkkaNav->nextid); 
	
	$rsGradeTeacher = Teacher::getGradeTeacherByTeacherId($_POST['teacher_id']);
	$rsGrade = Grade::getGradeById($rsGradeTeacher->grade_id);
	$rsSubject = Subject::getSubjectById($rsGradeTeacher->subject_id);
	
?>
<table border="0" cellspacing="0" cellpadding="0" class="akka_popuptbl">
  <tr>
    <td valign="top">
    	<img src="<?=$thumb_teacher_photo_name?>" class="akka_images" alt="<?=$rsTeacherDtls->first_name?>" title="<?=$rsTeacherDtls->first_name?>" width="275" height="156"  />
    	<div class="popup_contact_left1">
            <h2><?=$rsTeacherDtls->prefix?> <?=$rsTeacherDtls->first_name?>
            <span class="akka_cancelbtn" onclick="akkaCancelBtn()">X</span> </h2>
            <p><?=stripslashes($rsTeacherDtls->description)?></p> 
        </div>
    </td>
  </tr>
  <? if($rsGrade->grade_name!='' && $rsSubject->subject_name!=''){?>
  <tr>
    <td style="background:#3399cc;">
		<div class="popup_contact_left2">
            <h2>Handles Grade <?=$rsGrade->grade_name?> </h2>
            <ul>
            	<li><?=$rsSubject->subject_name?></li>
            </ul>
        </div>
		<!--<div class="popup_contact_right2">
			<h2 class="view_akka_post">View Mayura's Posts</h2>
        </div>-->
    </td>
  </tr>
  <? } ?>
  <tr>
    <td>
    	<div style="padding-top:25px;">
            <? if($rsAkkaNav->previd){?>
            	<span class="previous_akka" onclick="showAkkaPopup('<?=$rsAkkaNav->previd?>')"><< <?=$rsPrevAkkaName->prefix?> <?=$rsPrevAkkaName->first_name?></span>
			<? }else{ ?>
            	<span class="click_meetakka">Meet Our Akkas</span>
            <? } ?>
            <? if($rsAkkaNav->nextid!=''){ ?><span class="next_akka" onclick="showAkkaPopup('<?=$rsAkkaNav->nextid?>')"><?=$rsNextAkkaName->prefix?> <?=$rsNextAkkaName->first_name?> >></span><? } ?>
        </div>
    </td>
  </tr>
</table>
<?	
	exit();
}

?>

<div id="campus_container">
<div id="slide1" class="parallax">
    <div class="parallax" style="height:auto;">
    
    
        <!--<h1 class="pagetitle add_pad">Yellow Train Grade School</h1>
        <p class="para">The School in a Farm</p>-->
    
        <div class="slide_container topslidecamps" style="padding-top:110px; padding-bottom:0;">  	
			<? include "campus_slide.php"; ?>
        </div>
    
    	<div class="page_menu" style="top:110px; z-index:10; padding-top:30px;">
        <div class="content">
        	<div class="page_menu_container">
            
                <div class="page_menutop">
                    <h1 class="page_menuhd">YT Grade School</h1>
                    <div class="pagemenu_right">
                        <div class="pagemenu_desctop">The School in a Farm</div>
                    </div>
                </div>
                
                <div class="page_menubtm">
                	<ul>
                    	<li id="gradeschoolnav"><a href="#grade_school" class="active cursor">Grade School Campus</a></li> 
                        <li><a href="#brand_curr" class="cursor">Board &amp; Curriculum</a></li> 
                        <li><a href="#meet_akkas" class="cursor">Meet our Akkas</a></li> 
                        <!--<li><a href="#events" class="cursor">Upcoming Events</a></li> -->
                        <li><a href="#contact_nav" class="cursor">Contact Us</a></li> 
                	</ul>
                </div>
                
        	</div>
        </div>
        </div>
    
    
    
        <div class="container_full" id="grade_school">
        <div class="slide_container testimonial_slide nav_smooth_pos">  	
        <div id="innerslide8" class="homeSlideInner">
        <div class="parallax_inner" style="background-image:none">
            <div class="hsContainer" style="background-color:transparent;">
				<? include "campus_slide2.php"; ?>
            </div>
        </div>
        </div>
        </div>
        </div>
    
    
 <!-- Row 1 -->   	
		
        <div class="container_full">
        <div class="container_full">
        <div class="campus_row1_outer nav_smooth_pos">
        <div class="content">
        
        	<div class="campus_row1">
        		<div class="campus_row1_left">
               		<h2 class="subhd txt_orange">Grade School Campus</h2>
                    
                	<div class="campus_quote">A school in a farm has a place in the history of education like <br/>Gandhiji's experiments with Tolstoy Farm, in South Africa, or<br/> Summer Hill by A S Neill...</div>
                
                    <p>The school is set up in an organic farm. The classrooms are spacious, flooded with light, air and energy.</p>
                    
                    <p>The open-air amphitheatre is the hub of the school, where the children come together every morning for their circle time and performances; It was here that we made our 'Aarambham' by witnessing two beautiful rainbows.</p>
                    
                    <p>On the first floor children can jump out of the corridors to land in a huge hammock above the ground floor. Little caves, tunnels, hide outs and classrooms which are more outdoor than 
                    indoor with spaces to look out everywhere... What meets the eye when you look outside are the amla trees, sheep grazing, ducks quacking, the endless blue skies...</p>
                    
                    <p>And a river of knowledge runs through the school like a life force connecting all the spaces together.</p>                
                </div>
        
        		<div class="campus_row1_right">
                	<div class="campus_row1_img"><a href="#"><img src="images/tour_banner.jpg" alt="Experience the Campus - Take a Tour" /></a></div>
                	<div class="campus_row1_img"><a href="#"><img src="images/pros_banner.jpg" alt="View Our Prospectus" /></a></div>
                </div>
        	</div>
        </div>
        </div>
        </div>
        </div>
        
        
        
        
        
 <!-- Row 2 -->   	
 
        <div class="container_full" id="brand_curr">
        <div class="campus_row2_outer">
        <div class="content">
        
        	<h1 class="pagetitle" style="padding-top:0px;">Board &amp; Curriculum</h1>
        	<p class="para">The methodology and curriculum in Yellow Train is inspired by the pioneering work of Rudolf Steiner (Waldorf Education).</p>
            
        	<div class="campus_row2">
        		<div class="campus_row2_left">
               		<h2 class="subhd">Board</h2>
                    
                    <p>The school offers two boards – ICSE and IGCSE and integrates the best of both worlds in the primary education program for Grades 1 - 5.</p>
                    
                    <p>The assessments are frequent and holistic where knowledge, application and skills are tested. There is an intense focus on the fundamentals of academics through programs like 
                    <a href="#" class="blue">YT Fundamentals</a>. This helps them sharpen their skills and gain mastery on various subjects.</p>                     
                    
                    <div class="campus_board">
                    	<h2>What to Explore Next ?</h2>
                    	<ul>
                          <li><a href="<?=getSeoUrl(array('pn'=>'yt_fundamentals.php'))?>">YT Fundamentals</a></li>
                          <li><a href="<?=getSeoUrl(array('pn'=>'yt_rhythm.php'))?>">The Day in YT</a></li>
                          <li><a href="">Grade School Team</a></li>
                          <li><a href="">Admission Process</a></li>
                        </ul>
                    </div>
        		</div>
                
        		<div class="campus_row2_right">
               		<h2 class="subhd">Curriculum</h2>
					<p>Our Curriculum concentrates on</p>
                    
                    <div class="campus_row2_curr">
                    	<div class="campus_row2_curr_left curr_row1">Cognitive Development</div>
                        <div class="campus_row2_curr_right">concentrates on on the development of perception, memory, language, concepts, thinking, problem solving, metacognition, and social cognition</div>
                    </div>
                    
                    <div class="campus_row2_curr">
                    	<div class="campus_row2_curr_left curr_row2">Artistic Development</div>
                        <div class="campus_row2_curr_right">Although some may regard art education as a luxury, simple creative activities are some of the building blocks of child development.</div>
                    </div>
                    
                    <div class="campus_row2_curr">
                    	<div class="campus_row2_curr_left curr_row3">Handwork</div>
                        <div class="campus_row2_curr_right">Handwork activities stimulate intellectual development and instill a sense of achievement in the child.</div>
                    </div>
                    
                    <div class="campus_row2_curr">
                    	<div class="campus_row2_curr_left curr_row4">Physical Development</div>
                        <div class="campus_row2_curr_right">Physical development provides children with the abilities they need to explore and interact with the world around them</div>
                    </div>
                    
                    <div class="campus_row2_curr">
                    	<div class="campus_row2_curr_left curr_row5">Assessments</div>
                        <div class="campus_row2_curr_right">Assessment helps teachers know how to best educate children.</div>
                    </div>
                </div>
        	</div>
            
        </div>
        </div>
        </div>
        
        
 <!-- Row 3 -->   	
        <div style="width:100%; float:left;" id="meet_akkas">
 		<div class="container_full">       
        <div id="innerslide6" class="homeSlideInner">
        <div class="parallax_inner">
            <div class="hsContainer">
            <div class="content" style="position:relative;">        
                
                <div class="innerslide6_content">
					<p>The greatest people of our time who showed us the way in education do not all<br/> suggest a single proposition. However there is only one thing which every one of them<br/> agrees – the undeniable, single most, over whelming, unquestionable role of a teacher<br/> in the shaping of the child.</p>
                </div>
                
            </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        
        
 		<div class="container_full">       
        <div class="campus_row3_outer nav_smooth_pos">
        <div class="content" id="meetakkastab">
        <?php /*?><?
			if(count($rsTeacherArr)>0){
		?>
        	<div class="campus_row3">
                <div class="campus_row3_left"> 
                	<h2>MEET OUR <br/>AKKAS</h2>
					
            		<ul class="pagination"> 
                    	<li><? echo $table_val;?></li>
                       <!-- <li>02</li>
                        <li>03</li>
                        <li>04</li>-->
                    </ul>
                    
                    <p>What should children call teachers?<br/> Mam, Miss, Teacher, by name?<br/>Is it a mere form of addressing?<br/>Or does it establish the quality of<br/>the relationship?</p>
                    <div class="pagination_desc">Our children call us akka.</div>
                    <a href="<?=getSeoUrl(array('pn'=>'teacher.php'))?>" class="btn_yellow">Why Akka?</a>
                    
                </div>
                
                <div class="campus_row3_right">
            		<div class="akka_slider_outer">
					<?
						foreach($rsTeacherArr as $K=>$V){
						if($V->photo!="") {
							$teacher_photo=(TEACHER_FILE_REL.$V->photo);
							$thumb_teacher_photo_name=(TEACHER_FILE_REL.'thumb_'.$V->photo);
							if(!file_exists($thumb_teacher_photo_name) || file_exists($thumb_teacher_photo_name)) 
							smart_resize_image($teacher_photo, null, 275, 156, true, $thumb_teacher_photo_name, false, false, 100);
						}
							
					?>
                    		<div class="akka_slider">
                                <div class="akka_container">
                                    <div class="akka_slide_img"><img src="<?=$thumb_teacher_photo_name?>" alt="<?=ucwords($V->first_name)?>" title="<?=ucwords($V->first_name)?>" /></div>
                                    <div class="akkas_desc">
                                        <h2><?=$V->prefix?> <?=$V->first_name?></h2>
                                        <p><?=stripslashes(substr($V->description,0,100))?></p>
                                        <a href="<?=getSeoUrl(array('pn'=>'teacher.php'))?>" class="akka_readmore">read more...</a>
                                    </div>
                                </div>                        
                         	</div>
                    <?
							}
					?>
                    </div>
                </div>
            </div>
            <?
				}
			?><?php */?>
        </div>
        </div>
        </div>
        
        
 		<div class="container_full" id="events">       
        <div id="innerslide5" class="homeSlideInner" style="width:100%; float:left;">
        <div class="parallax_inner1" style="background-position:0 46%; background-attachment:scroll;">
            <div class="hsContainer">
            <div class="content" style="position:relative;">        
                
                <div class="innerslide5_content">
                	<h1 class="pagetitle" style="padding-top:0px; color:#ffffff; text-shadow:-1px -1px 2px #666666;">FUN STOP</h1>
					<p style="text-shadow:-1px -1px 2px #666666;">Checkout the recent happenings in Yellow Train</p>
                </div>
                
            </div>
            </div>
        </div>
        </div>
        </div>
        
 <!-- Row 4 -->   	
 
 		<div class="container_full">       
        <div class="campus_row4_outer nav_smooth_pos">
        <div class="content">
    		
        	<h1 class="pagetitle gray" style="padding-top:0px;"><a href="<?=getSeoUrl(array('pn'=>'funstop.php','Type'=>'events'))?>" class="gray">Upcoming Events</a></h1>
    		
            <div class="campus_events_outer">
            <? $eventobj = new Events;
			   $eventobj->upcoming_date = date('Y-m-d');
			   $eventobj->sortby = "DESC";
			   $eventobj->orderby = "id";
			   $eventobj->limit = "3";
			   $eventDtls = $eventobj->getEventsDtls();
			   if(count($eventDtls)>0){
				 foreach($eventDtls as $M=>$N){
					$event_from_date = split('-',$N->event_from_date);
					$event_to_date = split('-',$N->event_to_date);
					
					if($N->event_file!="") {
						$event_photo=(EVENT_FILE_REL.$N->event_file);
						$thumb_event_photo_name=(EVENT_FILE_REL.'thumb_popup_'.$N->event_file);
						if(!file_exists($N->event_file)) smart_resize_image($event_photo, null, 365, 282, true, $thumb_event_photo_name, false, false, 100);
					}
	
  					  ?>
                        <a href="<?=getSeoUrl(array('pn'=>'funstop.php','Type'=>'reg','EventId'=>$N->id))?>">
                        <div class="campus_events campus_events1">
                            <div class="campus_events_img"><img src="<?=$thumb_event_photo_name?>" alt="<?=$N->event_name?>" title="<?=$N->event_name?>" /></div>
                            <div class="campus_events_desc">
                                <div class="campus_events_date">
								<?=date('M',$event_from_date[1])?><br/><?=$event_from_date[2]?>
                                <? if($N->event_type=="M"){?>
								<?="-&nbsp;".$event_to_date[2]?>
                                 <? }?>
                                 <!-- Jan 31<br/>-&nbsp;Feb 03-->
                                 <span><?=$N->from_time?>
                                 </span></div>
                                <div class="campus_events_board">
                                    <h2><?=$N->event_name?></h2>
                                    <p><?=$N->event_address?></p>
                                </div>
                            </div>	
                        </div>
                        </a>
                <? }
				}else{
					echo '<div class="campus_events campus_events1">No Events Found..!</div>';
				}
				?>
            </div>
 
        </div>
        </div>
        </div>
        
 		<div class="container_full" id="contact_nav">       
        <div id="innerslide7" class="homeSlideInner" style="width:100%; float:left;">
        <div class="parallax_inner">
            <div class="hsContainer">
            <div class="content" style="position:relative;">        
                
                <div class="innerslide7_content">
                	<h1 class="pagetitle" style="padding-top:0px; color:#000000;">Contact Us</h1>
					<p>Please feel free to get in touch with us at any time. We love to receive feedback about the site.</p>
                </div>
                
            </div>
            </div>
        </div>
        </div>
        </div>
        
        
        
 <!-- Row 5 -->   	
 
 
        <div class="campus_row5_outer">
        <div class="content">
 	
 				<h1 class="subhd">Get in Touch</h1>
                
                <div class="contact_left">
                
                	<div class="contact_row">
                    	<div class="contact_rowleft">
                        	<img src="images/phone_icon.png" alt="phone" />
                            <div class="contact_desc">	
                            	<h3>Phone</h3>
                                <p>8220291777</p>
                            </div>
                        </div>
                        
                    	<div class="contact_rowright">
                        	<img src="images/mail_icon.png" alt="Email Address" />
                            <div class="contact_desc">	
                            	<h3>Email Address</h3>
                                <p>ytgradeschool@gmail.com</p>
                            </div>
                        </div>
                    </div>
                
                	<div class="contact_row">
                    	<div class="contact_rowleft">
                        	<img src="images/location_icon.png" alt="Address" />
                            <div class="contact_desc">	
                            	<h3>Address</h3>
                                <p>Yellow Train Grade School,<br/>Mudalipalayam,<br/>Coimbatore - 641007</p>
                            </div>
                        </div>
                        
                    	<div class="contact_rowright">
                        	<img src="images/hours_icon.png" alt="Working Hours" />
                            <div class="contact_desc">	
                            	<h3>Working Hours</h3>
                                <p>Monday - Friday<br/>9:00 AM - 3:00 PM</p>
                            </div>
                        </div>
                    </div>
                	
                	<div class="contact_row">
                    	<div class="contact_rowleft">
                        	<img src="images/fb_icon.png" alt="facebook" />
                            <div class="contact_desc">	
                            	<h3>Facebook</h3>
                                <p>yellowtrainschool</p>
                            </div>
                        </div>
                    </div>
                
                </div>
                
                
                <div class="contact_right">
                	<p>Drop us an email a form below</p>
                
                	<form method="post">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="contacttbl">
                      <tr>
                        <td></td>
                      </tr>
                      <tr>
                        <td><input type="text" class="txtbox name_icon" id="name" name="name" placeholder="your name" /></td>
                      </tr>
                      <tr>
                        <td><input type="text" class="txtbox email_icon" id="email_address" name="email_address" placeholder="your e-mail" /></td>
                      </tr>
                      <tr>
                        <td><input type="text" class="txtbox phone_icon" id="contact_number" name="contact_number" placeholder="your contact number" /></td>
                      </tr>
                      <tr>
                        <td><textarea class="msgbox message_icon" id="message" name="message" placeholder="message"></textarea></td>
                      </tr>
                      <tr>
                        <td><span class="btn_outer"><div class="btn">Submit</div></span></td>
                      </tr>
                    </table>
                    </form>
                
                </div>
				<? include "explore_blue.php"; ?>                
        </div>
        </div>
    </div>
</div>
</div>
<div class="popupbox" id="akka_popup" style="padding:0 20px; margin:0; display:none; font-family: 'sanchez_regularregular';"></div>

<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.js"></script> 
<script type="text/javascript">

$('.page_menubtm ul li').click(function(event) {
	event.preventDefault();
	var target = $(this).find('>a').prop('hash');
	$(".pagetopbox").remove(); $(target).prepend($('<div class="pagetopbox">&nbsp;</div>'));
	
	$('html, body').animate({
		scrollTop: $(target).offset().top
	}, 700);
});


$(window).on('scroll',function(){
	var winHt = $(window).height();
	var scrollVal = $(window).scrollTop();
	var slideht = $('.topslidecamps').height(); 
	
	//var nav_pos = winHt - 285;
	var nav_pos = winHt - slideht;
	
	if (scrollVal >= slideht){ 
		$('.page_menu').addClass('page_menu_active');
	}
	else{ 
		$('.page_menu').removeClass('page_menu_active');
		$('.pagetopbox').hide(0);
	}
	
});


$('.page_menubtm ul li a').click(function(event) {
	$('.page_menubtm ul li a').removeClass('active');
	$(this).addClass('active');
});


$(document).ready(function(){ 

	//alert($('.topslidecamps').height());

	var parallax = document.querySelectorAll(".parallax_inner1"),speed = 0.02;

	window.onscroll = function(){
	[].slice.call(parallax).forEach(function(el,i){
	
	  var windowYOffset = window.pageYOffset,
		 // elBackgrounPos = "20% " + (windowYOffset * speed) + "px";
		 
	  	elBackgrounPos = "0 46%";
	  
	  el.style.backgroundPosition = elBackgrounPos;
	
	});
	};
});


meetAkkasList();
function meetAkkasList() { 
	
	ajax({
		a:'yt_grade_school',
		b:'act=loadMeetAkkas',
		c:function(){},
		d:function(data){ 
			$('#meetakkastab').html(data);
		}
	});
}

function meetAkkasListPaging(page) { 
	
	ajax({
		a:'yt_grade_school',
		b:'act=loadMeetAkkas&page='+page,
		c:function(){},
		d:function(data){ 
		//('#slidediv').toggle('slide', { direction: 'left' }, 700);
			$('#meetakkastab').html(data);
			//$('#meetakkastab').toggle('slide', { direction: 'left' }, 700);
		}
	});
}

function popViewAkka(){
  	$("#akka_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function akkaCancelBtn(){ $("#akka_popup").dialog('close');  }

function showAkkaPopup(teacher_id){   
	$("#akka_popup").dialog('open');	
  	ajax({
		a:'yt_grade_school',
		b:'act=loadAkkaPopupDtls&teacher_id='+teacher_id,		
		c:function(){},
		d:function(data){
			//alert(data);
			$("#akka_popup").html(data);
			popViewAkka();
		}			
	});
}
</script>


<?
}
include "template.php";
?>
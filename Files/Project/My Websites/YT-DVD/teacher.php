<?
function main(){
if($_POST['act']=='loadTeacherDtls'){
	ob_clean();
	$teacherObj = new Teacher();
	$teacherObj->sortby = "ASC";
	$teacherObj->orderby = "position";
	$rsTeacher = $teacherObj->getTeacherDtls();
?>
		<div class="full_width">
        	<? if(count($rsTeacher)>0){ ?>
            <div class="meet_akka_left">
                <div class="full_width">
                <?
					foreach($rsTeacher as $K=>$V){
					if($V->photo!="") {
						$event_photo=(TEACHER_FILE_REL.$V->photo);
						$thumb_event_photo_name=(TEACHER_FILE_REL.'thumb_'.$V->photo);
						if(!file_exists($thumb_event_photo_name) || file_exists($thumb_event_photo_name)) 
						smart_resize_image($event_photo, null, 275, 156, true, $thumb_event_photo_name, false, false, 100);
					}
				?>
                		<div class="teacher_details">
                            <img src="<?=$thumb_event_photo_name?>" alt="<?=ucwords($V->first_name)?>" title="<?=ucwords($V->first_name)?>" width="275" height="156" class="cursor" onclick="showTeacherPopup('<?=$V->id?>')"  />
                            <div class="teacher_name"><?=$V->prefix?> <?=$V->first_name?></div>
<!--                            <p><?=stripslashes(substr($V->description,0, 98))?></p>
                            <span onclick="showTeacherPopup('<?=$V->id?>')">read more...</span>
-->                        </div>
                <?
					}
				?>
                </div>
            </div>
            <? } ?>
            <div class="meet_akka_right">
            	<p class="lineht24 letterspac">What should children call teachers? Mam, Miss, Teacher, by name?
                Is it a mere form of addressing? 
                Or does it establish the quality of 
                the relationship?</p>
                <h3>Our children call us akka.</h3>
                <div class="why_akkabtn" onclick="show_whyakka()">Why Akka?</div>
            </div>
        </div>
<?			
	exit();
}
if($_POST['act']=='loadTeacherPopupDtls'){  
	ob_clean();
	$rsTeacherDtls = Teacher::getTeacherById($_POST['teacher_id']); 
	if($rsTeacherDtls->photo!="") {
		$teacher_photo=(TEACHER_FILE_REL.$rsTeacherDtls->photo);
		$thumb_teacher_photo_name=(TEACHER_FILE_REL.'thumb_'.$rsTeacherDtls->photo);
		if(!file_exists($thumb_teacher_photo_name) || file_exists($thumb_teacher_photo_name)) 
		smart_resize_image($teacher_photo, null, 180, 180, true, $thumb_teacher_photo_name, false, false, 100);
	}
	$rsAkkaNav = Teacher::getPreandNextTeacherById($_POST['teacher_id']);
	$rsPrevAkkaName = Teacher::getTeacherById($rsAkkaNav->previd); 
	$rsNextAkkaName = Teacher::getTeacherById($rsAkkaNav->nextid); 
	
	$rsGradeTeacher = Teacher::getGradeTeacherByTeacherId($_POST['teacher_id']);
	$rsGrade = Grade::getGradeById($rsGradeTeacher->grade_id);
	$rsSubject = Subject::getSubjectById($rsGradeTeacher->subject_id);
	
?>

<table width="100" border="0" cellspacing="0" cellpadding="0" class="popupbox" id="whyakka_popup">

  <tr>
    <td valign="top">
         <div class="whyakka_popup_outer">
            <img src="images/close_icon.png" class="popupclosebtn" onclick="teacherCancelBtn()" alt="Close" title="Close" />
            <h2 class="whyakka_hd"><?=$rsTeacherDtls->prefix?> <?=$rsTeacherDtls->first_name?></h2>
        
            <div class="whyakka_popup_desc">
            <div class="shad_top"></div>
            <div class="shad_btm"></div>		
            <p><?=stripslashes($rsTeacherDtls->description)?></p>
            </div>
            <img src="<?=$thumb_teacher_photo_name?>" class="akka_images" alt="<?=$rsTeacherDtls->first_name?>" title="<?=$rsTeacherDtls->first_name?>" width="300"  />
        </div>
    </td>
  </tr>
  <?php /*?><tr>
    <td>
    	<div style="padding-top:25px;">
            <? if($rsAkkaNav->previd){?>
            	<span class="previous_akka" onclick="showTeacherPopup('<?=$rsAkkaNav->previd?>')"><< <?=$rsPrevAkkaName->prefix?> <?=$rsPrevAkkaName->first_name?></span>
			<? }else{ ?>
            	<span class="click_meetakka">Meet Our Akkas</span>
            <? } ?>
            <? if($rsAkkaNav->nextid!=''){ ?><span class="next_akka" onclick="showTeacherPopup('<?=$rsAkkaNav->nextid?>')"><?=$rsNextAkkaName->prefix?> <?=$rsNextAkkaName->first_name?> >></span><? } ?>
        </div>
    </td>
  </tr><?php */?>
</table>
<?	
	exit();
}
if($_POST['act']=='joinUsFrmSubmit'){ print_r($_POST);
	$rsJoinUsIns = Teacher::insertTeacherJoinUs($_POST['your_name'],$_POST['your_dob'],$_POST['your_gender'],$_POST['your_address'],$_POST['your_email'],$_POST['join_duration'],$_POST['your_number'],$_POST['edu_qulify'],$_POST['work_qulify'],$_POST['who_inspire'],$_POST['understand_child'],$_POST['significant_had'],$_POST['childhood_descrp'],$_POST['passion_about']);
}
	
?>

<link rel="stylesheet" type="text/css" href="css/responsive1.css" />

<style type="text/css">

.ques_progress, .ques_progress1, .ques_progress2, .ques_progress3 { width:92%; float:left; height:8px; padding:0 4%; margin-bottom:15px; }
.ques_progress_status, .ques_progress1_status, .ques_progress2_status, .ques_progress3_status { width:0; float:left; background:#999999; height:6px; -webkit-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -o-transition: all 0.3s ease-out; -ms-transition: all 0.3s ease-out; transition: all 0.3s ease-out; }

</style>


<div class="full_width" style="padding-top:140px;">



<div class="page_menu">
<div class="content">
    <div class="page_menu_container">
    
        <div class="page_menutop">
            <h1 class="page_menuhd ytmethodology_head">The Teacher</h1>
            <div class="pagemenu_right">
                <div class="pagemenu_desctop" style="padding-top:5px; letter-spacing:-2;">The teacher is the most important and pivotal pillar of the school <br/> and this is reflected in their role in the school.</div>
            </div>
        </div>

        <!--<div class="page_menubtm">
            <ul>
                <li><a class="teacher active" onclick="show_meetakka()">Meet our Akkas</a></li>
                <li><a class="teacher" onclick="show_teacherrole()">The Teacher's Role</a></li>
                <li><a class="teacher" onclick="show_joinus()">Join Us</a></li>
            </ul>
        </div>-->

    </div>
</div>
</div>



<div class="full_width teacher_head" id="meetakka_part">
    <div class="content">
		<h1>MEET OUR AKKAS</h1>
        <p class="lineht24 letterspac">The greatest people of our time who showed us the way in education do not all suggest a single proposition. However there is only one thing which every one of 
        them agrees – the undeniable, single most, over whelming, unquestionable role of a teacher in the shaping of the child.</p>
        
        <div id="teachertab"></div>
    </div>
</div>




<div class="full_width teacher_head teach_role_parag" id="teacher_part">
    <div class="content">
		<h1>TEACHER'S ROLE</h1>
        <p class="lineht24 letterspac">The school is teacher centred so that our work can be truly child centric. The teacher is the most important and pivotal pillar of the school and 
        this is reflected in their role in the school.</p>
        
        <div class="full_width">
            <div class="teacher_role_left">
                <div class="full_width">
                	<ul class="teacher_roles">
                        <li>
                        	<p class="lineht24 letterspac">In the need for uniformity and consistency organizations trade off uniqueness and originality. While broad structures will be 
                            conformed to <span class="blue_text">each teacher brings her originality and creativity to his/her environment.</span> While the curriculum is set by the school, 
                            how it is delivered to the children rests with the teacher which is reviewed, assessed and mentored by the Pedagogy Team. This would be the cornerstone 
                            in fostering the uniqueness and originality of each child, for it is not possible to pass on something that you don't have to the children.</p>
                        </li>
                        <li>
                        	<p class="lineht24 letterspac"><span class="blue_text">Each Teacher is assigned a Mentor</span> who closely works with the Teacher on both areas of personal and 							                             professional development. 
                            The Mentor is a senior person with several years of practical experience and with an in-depth knowledge on psychology and Child Development. Mentors could
                            be from within Yellow Train or professionals from outside.</p>
                        </li>
                        <li>
                        	<p class="lineht24 letterspac"><span class="blue_text">Weekly Reading sessions and ongoing training sessions are planned for the whole year</span> which deepens 
                            the teachers understanding of child development and helps them gain skills on curriculum design and delivery. Apart from this workshops are organised for 
                            further understanding.</p>
                        </li>
                        <li>
                        	<p class="lineht24 letterspac"><span class="blue_text">Teachers are mandated to visit at least two other schools across India every year.</span> During these 
                            visits teachers observe classrooms in progress, interact with teachers and mentors of other schools, learn best practices and gain new insights that they can 
                            implement in their own environment.</p>
                        </li>
                        <li>
                        	<p class="lineht24 letterspac"><span class="blue_text">Our compensation and benefits for teachers is the highest in the industry.</span> In addition to the 
                            salary Teachers participate in the profit sharing model, based on their contribution and performance. Teachers' children are part of the subsidised education 
                            program.</p>
                        </li>
                        <li>
                        	<p class="lineht24 letterspac"><span class="blue_text">Senior teachers have Post Graduate Education and bring with them work experience and expertise</span> 
                            in their area of education. Junior teachers apprentice under senior teachers and undergo rigorous training before they can independently handle classes.</p>
                        </li>
                        <li>
                        	<p class="lineht24 letterspac">The school functions in a democratic way. <span class="blue_text">Teachers play an important role in all key decisions and 
                            functioning of the school.</span></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="teacher_role_right">
            	<p class="lineht24 letterspac">What should children call teachers? Mam, Miss, Teacher, by name?
                Is it a mere form of addressing? 
                Or does it establish the quality of 
                the relationship?</p>
                <h3 class="lineht24 letterspac">Our children call us akka.</h3>
                <div class="why_akkabtn" onclick="show_whyakka()">Why Akka?</div>
                
                <div class="full_width joinas_akka">
                	<h2 class="lineht24 letterspac">Interested to join us as our akka?</h2>
                    <img src="images/join_akka_img.png" alt="" />
                    <p>At Yellow Train we believe in Teachers.</p>
                    <p>We are inspired by the possibilities that lie ahead of every teacher.</p>
                    <p>We would like to understand the people who would like to onboard as 'Teachers' on the Yellow Train Journey.</p>
                    <div class="role_applynowbtn" onclick="show_joinus()">Apply Now</div>
                    <img src="images/tech_img.png" alt="" style="margin-bottom:0; padding-bottom:0;" />
                </div>
                
            </div>
        </div>
        
    </div>
</div>






<div class="full_width joinus_cntr" id="joinus_part">
    <div class="content">
		<h1>JOIN US</h1>
        <p class="lineht24 letterspac">Here we have a form that you need to write that will help us understand you – your ideas, your views, your beliefs, your opinions, your family, 
        your story. There is nothing such as a right or wrong answer. It is just the way you see it. Please fill it and send it across to us. Do not mind if you have difficulty with any of the 
        questions, just answer as best and as honestly as you can.  The information you give will be kept confidential.</p>
        
        <form name="joinus_frm" id="joinus_frm" enctype="multipart/form-data" method="post">
        <input type="hidden" name="act" value="joinUsFrmSubmit" />
        <div class="full_width" style="margin-bottom:20px;">
            
            <div class="joinus_left">
                <div class="joinus_alldetail" id="questoakka">
                	<ul>
                    	<li class="joinus_tab active" onclick="personal_tab()" id="active_personal">Personal Details</li>
                        <li class="joinus_tab" onclick="education_tab()" id="active_education">Education & Work Experience</li>
                        <li class="joinus_tab" onclick="teaching_tab()" id="active_teaching">Teaching</li>
                        <li class="joinus_tab" onclick="you_tab()" id="active_you">You</li>
                    </ul>
					
                    <div class="ques_cointainer personal_ques" id="pd_tab">
                    	<div class="ques_inner personal_ques personal_ques1" id="personal_ques1">
                        	<p>What's your name?</p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:23px;" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="your_name" name="your_name" value="" onkeydown="if (event.keyCode == 13) { personal_ques(2); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="personal_ques(2)"/></div>			
                            </div>	
                        </div>	
                    	<div class="ques_inner personal_ques personal_ques2" id="personal_ques2">
                        	<p>What's your date of Birth? </p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" onclick="personal_quess(1)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="your_dob" name="your_dob" value="" onkeydown="if (event.keyCode == 13) { personal_ques(3); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="personal_ques(3)" /></div>			
                            </div>	
                        </div>
                    	<div class="ques_inner personal_ques personal_ques3" id="personal_ques3">
                        	<p>What's your Gender? </p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" onclick="personal_quess(2)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="your_gender" name="your_gender" value="" onkeydown="if (event.keyCode == 13) { personal_ques(4); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="personal_ques(4)" /></div>			
                            </div>	
                        </div>
                    	<div class="ques_inner personal_ques personal_ques4" id="personal_ques4">
                        	<p>What's your address? </p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" onclick="personal_quess(3)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="your_address" name="your_address" value="" onkeydown="if (event.keyCode == 13) { personal_ques(5); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="personal_ques(5)" /></div>			
                            </div>	
                        </div>	
                    	<div class="ques_inner personal_ques personal_ques5" id="personal_ques5">
                        	<p>What's your E-mail? </p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" onclick="personal_quess(4)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="your_email" name="your_email" value="" onkeydown="if (event.keyCode == 13) { personal_ques(6); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="personal_ques(6)" /></div>			
                            </div>	
                        </div>	
                    	<div class="ques_inner personal_ques personal_ques6" id="personal_ques6">
                        	<p>How soon can you join? </p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" onclick="personal_quess(5)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="join_duration" name="join_duration" value="" onkeydown="if (event.keyCode == 13) { personal_ques(7); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="personal_ques(7)" /></div>			
                            </div>	
                        </div>
                    	<div class="ques_inner personal_ques personal_ques7" id="personal_ques7">
                        	<p>What's your Phone Number? </p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" onclick="personal_quess(6)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="your_number" name="your_number" value="" onkeydown="if (event.keyCode == 13) { personal_ques(8); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="personal_ques(8)" /></div>			
                            </div>	
                        </div>
                        
                        <div class="ques_progress">
                        	<div class="ques_progress_status"></div>
                        </div>	
                    </div>
                    
                    
                    <div class="ques_cointainer" id="edu_tab">
                    	<div class="ques_inner work_ques work_ques1" id="work_ques1">
                        	<p>Capture your educational qualifications</p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="edu_qulify" name="edu_qulify" onkeydown="if (event.keyCode == 13) { work_ques(2); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="work_ques(2)" /></div>			
                            </div>	
                        </div>	
                    	<div class="ques_inner work_ques work_ques2" id="work_ques2">
                        	<p>Capture your work experience both teaching and non teaching.</p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" onclick="work_quess(1)"/></div>
                                <div class="quesmiddle_cntr"><input type="text" id="work_qulify" name="work_qulify" onkeydown="if (event.keyCode == 13) { work_ques(3); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="work_ques(3)" /></div>			
                            </div>	
                        </div>
                        
                        <div class="ques_progress1">
                        	<div class="ques_progress1_status"></div>
                        </div>
                    </div>
                    
                    
                    <div class="ques_cointainer" id="teach_tab">
                    	<div class="ques_inner teach_ques teach_ques1" id="teach_ques1">
                        	<p>1. What inspires you to engage with children? </p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="who_inspire" name="who_inspire" onkeydown="if (event.keyCode == 13) { teach_ques(2); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="teach_ques(2)" /></div>			
                            </div>	
                        </div>	
                    	<div class="ques_inner teach_ques teach_ques2" id="teach_ques2">
                        	<p>2. What is your understanding of children in the primary school age ( 7-11 yrs)? </p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" onclick="teach_quess(1)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="understand_child" name="understand_child" onkeydown="if (event.keyCode == 13) { teach_ques(3); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="teach_ques(3)" /></div>			
                            </div>	
                        </div>
                    	<div class="ques_inner teach_ques teach_ques3" id="teach_ques3">
                        	<p>3. What are some significant teaching / learning experiences that you have had?</p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" onclick="teach_quess(2)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="significant_had" name="significant_had" onkeydown="if (event.keyCode == 13) { teach_ques(4); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="teach_ques(4)" /></div>			
                            </div>	
                        </div>	
                        
                        <div class="ques_progress2">
                        	<div class="ques_progress2_status"></div>
                        </div>
                    </div>

					<div class="ques_cointainer" id="you_tab">
                    	<div class="ques_inner you_ques you_ques1" id="you_ques1">
                        	<p>1. Describe your childhood. Who/what /were the formative influences in your life?</p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="childhood_descrp" name="childhood_descrp" onkeydown="if (event.keyCode == 13) { you_ques(2); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="you_ques(2)" /></div>			
                            </div>	
                        </div>
                    	<div class="ques_inner you_ques you_ques2" id="you_ques2">
                        	<p>2. Is there anything that you are really passionate about? If yes, what would it be?</p>
                            <div class="txtbox_cntr">
                            	<div class="quesleft_cntr"><img src="images/gray_arrow_left.png" style="margin-top:24px;" onclick="you_quess(1)" /></div>
                                <div class="quesmiddle_cntr"><input type="text" id="passion_about" name="passion_about" onkeydown="if (event.keyCode == 13) { you_ques(3); }" /></div>
                                <div class="quesright_cntr"><img src="images/gray_arrow_right.png" style="margin-top:24px;" onclick="you_ques(3)" /></div>			
                            </div>	
                        </div>
                        <div class="ques_progress3">
                        	<div class="ques_progress3_status"></div>
                        </div>
                        <div class="event_nextbtn" onclick="show_thankuakka()" id="submit_display">Submit</div>	
                    </div>
                </div>
                <div class="joinus_alldetail" id="thankyou_akka" style="border:1px solid #32a9d4;background:#FFFFFF; margin-top:15px;">
					<p>Thank you for your interest in joining Yellow Train. One of our school co-ordinators will be contacting you regarding your application.</p>
                    <p class="strip_center" style="padding:0;"></p>
					<p>In the meanwhile please subscribe to our newsletter to get posted about happanings in Yellow Train.</p>
                    <div class="subscribe_newsbtn">Subscribe to our Newsletter</div>
                </div>
            </div>

            
            <div class="joinus_right">
            	<p class="lineht24 letterspac">What should children call teachers? Mam, Miss, Teacher, by name?
                Is it a mere form of addressing? 
                Or does it establish the quality of 
                the relationship?</p>
                <h3 class="lineht24 letterspac">Our children call us akka.</h3>
                <a class="why_akkabtn" style="background:#f7e900; color:#000000;" onclick="show_whyakka()">Why Akka?</a>
            </div>
        </div>
        </form>
    </div>
</div>


<div class="popupbox" id="teacher_popup" style="padding:15px 20px; margin:0; display:none; background:#dab791; font-family: 'LetterGothicMTStd';"></div>

<? //include "whyakka_popup.php"; ?>

<div class="popupbox" id="whyakka_popup" style="display:none; padding:15px 20px; margin:0; background:#dab791; font-family: 'LetterGothicMTStd';">
<div class="whyakka_popup_outer">
	<img src="images/close_icon.png" class="popupclosebtn" onclick="close_whyakka_popup()" alt="Close" title="Close" />
	<h2 class="whyakka_hd">Why Akka?</h2>

	<div class="whyakka_popup_desc">
 	<div class="shad_top"></div>
    <div class="shad_btm"></div>		
	<p>What should children call teachers? Mam, Miss, Teacher, by name? Is it a mere form of addressing? Or does it establish the quality of the relationship?</p>
    <p>Our children call us akka.</p>
    <p>Why akka? The teacher facilitates learning, growing and partners with the child in this journey called school and the larger journey called life. The feelings we want to evoke in the child when they think about a teacher 
    is one of warmth, love, respect and trust. And as children move into middle and high school a feeling of equality and mutual respect. And akka came close to this image. So we are akkas at the school, for our beloved children.</p>
    </div>
    <img src="images/popup_img.png" alt="Why Akka" class="whyakkaimg" />
</div>
</div>




<script type="text/javascript">

$(".joinus_tab").click(function(){
	 
	$('.joinus_tab').removeClass('active');
	$(this).addClass('active');
	 
});

$(".teacher").click(function(){
	 
	$('.teacher').removeClass('active');
	$(this).addClass('active');
	 
});

function show_thankuakka(){
	
    document.getElementById("questoakka").style.display = "none";
    document.getElementById("thankyou_akka").style.display = "block";
	
	document.joinus_frm.submit();
}

function personal_quesq(pdq){
	var a = parseInt(pdq);
	$("#personal_ques"+(a-1)+" p").slideUp(250);
	
	setTimeout(function(){ 
    document.getElementById("personal_ques"+a).style.display = "block";
		if(a==2)
		{
			$("#your_dob" ).focus();
		}
		else if(a==3)
		{
			$("#your_gender" ).focus();
		}
		else if(a==4)
		{
			$("#your_address" ).focus();
		}
		else if(a==5)
		{
			$("#your_email" ).focus();
		}
		else if(a==6)
		{
			$("#join_duration" ).focus();
		}
		else if(a==7)
		{
			$("#your_number" ).focus();
		}
		else if(a==8)
		{
			$("#edu_qulify" ).focus();
		}
    document.getElementById("personal_ques"+(a-1)).style.display = "none";
    //document.getElementByClassName("personal_ques").style.display = "none";
	},400);
		
}

function personal_quess(pdq){
	
	var b = parseInt(pdq);
	
	var	wid = ((b-1)*14.28);
	$('.ques_progress_status').css('width',wid+'%');
	
    document.getElementById("personal_ques"+b).style.display = "block";
    document.getElementById("personal_ques"+(b+1)).style.display = "none";
    document.getElementByClassName("personal_ques").style.display = "none";
}

function work_quesq(pdq){ 
	
	var a = parseInt(pdq);
	$("#work_ques"+(a-1)+" p").slideUp(250);
	
	setTimeout(function(){ 
    document.getElementById("work_ques"+a).style.display = "block";
		if(a==2)
		{
			$("#work_qulify" ).focus();
		}
		
		
    document.getElementById("work_ques"+(a-1)).style.display = "none";
    //document.getElementByClassName("personal_ques").style.display = "none";
	},400);
}

function work_quess(pdq){
	
	var b = parseInt(pdq);
	alert(b);
	var	wid = ((b-1)*50);
	$('.ques_progress1_status').css('width',wid+'%');

    document.getElementById("work_ques"+b).style.display = "block";
    document.getElementById("work_ques"+(b+1)).style.display = "none";
    document.getElementByClassName("work_ques").style.display = "none";
}

function teach_quesq(pdq){ 
	
	/*var a = parseInt(pdq);
    document.getElementById("teach_ques"+a).style.display = "block";
    document.getElementById("teach_ques"+(a-1)).style.display = "none";
    document.getElementByClassName("teach_ques").style.display = "none";*/
	
	var a = parseInt(pdq);
	$("#teach_ques"+(a-1)+" p").slideUp(250);
	
	setTimeout(function(){ 
    document.getElementById("teach_ques"+a).style.display = "block";
		if(a==2)
		{
			$("#understand_child").focus();
		}
		else
		{
			$("#significant_had").focus();
		}
    document.getElementById("teach_ques"+(a-1)).style.display = "none";
    //document.getElementByClassName("personal_ques").style.display = "none";
	},400);
		
}

function teach_quess(pdq){
	
	var b = parseInt(pdq);
	
	var	wid = ((b-1)*33.3);
	$('.ques_progress2_status').css('width',wid+'%');

    document.getElementById("teach_ques"+b).style.display = "block";
    document.getElementById("teach_ques"+(b+1)).style.display = "none";
    document.getElementByClassName("teach_ques").style.display = "none";
}

function you_quesq(pdq){
	
	/*var a = parseInt(pdq);
    document.getElementById("you_ques"+a).style.display = "block";
    document.getElementById("you_ques"+(a-1)).style.display = "none";
    document.getElementByClassName("you_ques").style.display = "none";*/
	
	var a = parseInt(pdq);
	$("#you_ques"+(a-1)+" p").slideUp(250);
	
	setTimeout(function(){ 
    document.getElementById("you_ques"+a).style.display = "block";
		if(a==2)
		{
			$("#passion_about").focus();
		}
    document.getElementById("you_ques"+(a-1)).style.display = "none";
    //document.getElementByClassName("personal_ques").style.display = "none";
	},400);
}

function you_quess(pdq){
	
	var b = parseInt(pdq);
	
	var	wid = ((b-1)*33.3);
	$('.ques_progress3_status').css('width',wid+'%');

    document.getElementById("you_ques"+b).style.display = "block";
    document.getElementById("you_ques"+(b+1)).style.display = "none";
    document.getElementByClassName("you_ques").style.display = "none";
}

function education_tab(){
    document.getElementById("pd_tab").style.display = "none";
	document.getElementById("edu_tab").style.display = "block";
    document.getElementById("teach_tab").style.display = "none";
	document.getElementById("you_tab").style.display = "none";
}

function teaching_tab(){
    document.getElementById("pd_tab").style.display = "none";
	document.getElementById("edu_tab").style.display = "none";
    document.getElementById("teach_tab").style.display = "block";
	document.getElementById("you_tab").style.display = "none";
}

function you_tab(){
    document.getElementById("pd_tab").style.display = "none";
	document.getElementById("edu_tab").style.display = "none";
    document.getElementById("teach_tab").style.display = "none";
	document.getElementById("you_tab").style.display = "block";
}

function personal_tab(){
    document.getElementById("pd_tab").style.display = "block";
	document.getElementById("edu_tab").style.display = "none";
    document.getElementById("teach_tab").style.display = "none";
	document.getElementById("you_tab").style.display = "none";
}

function show_meetakka(){
    document.getElementById("meetakka_part").style.display = "block";
	document.getElementById("teacher_part").style.display = "none";
    document.getElementById("joinus_part").style.display = "none";
}

function show_teacherrole(){
    document.getElementById("teacher_part").style.display = "block";
	document.getElementById("meetakka_part").style.display = "none";
    document.getElementById("joinus_part").style.display = "none";
}

function show_joinus(){ 
    document.getElementById("joinus_part").style.display = "block";
	document.getElementById("meetakka_part").style.display = "none";
    document.getElementById("teacher_part").style.display = "none";
}


</script>


<script type="text/javascript">

function personal_ques(pdq) {
	
    switch (pdq) {
        case 2:
			if(	$('#your_name').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $('.ques_progress_status').css('width','14.28%');
			 personal_quesq(pdq);
			 return true; 
			}
            break;
        case 3:
			if(	$('#your_dob').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $('.ques_progress_status').css('width','28.56%');
			 personal_quesq(pdq);
			 return true; 
			}
            break;
        case 4:
			if(	$('#your_gender').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			$('.ques_progress_status').css('width','42.84%');
			 personal_quesq(pdq);
			 return true; 
			}
            break;
        case 5:
			if(	$('#your_address').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			$('.ques_progress_status').css('width','57.12%');
			 personal_quesq(pdq);
			 return true; 
			}
            break;
        case 6:
			if(	$('#your_email').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} 
			else
			{
				var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				if(reg.test($('#your_email').val()) == false) 
				{
					err=1;
					 $('.txtbox_cntr').addClass('boxred');
					 return false;
				} else {
					 $('.txtbox_cntr').removeClass('boxred'); 
					 $('.ques_progress_status').css('width','71.4%');
					 personal_quesq(pdq);
					 return true; 
				}
			}
            break;
        case 7:
			if(	$('#join_duration').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			$('.ques_progress_status').css('width','85.68%');
			 personal_quesq(pdq);
			 return true; 
			}
            break;
        case 8:
			if(	$('#your_number').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			$('.ques_progress_status').css('width','100%');
			 $("#active_personal").css({"background":"#cccccc","color":"#2b2b2b"});
			 $("#active_education").css({"background":"#32a9d4","color":"#FFFFFF","display":"block"});
			 setTimeout(function(){education_tab();},800);
			 return true; 
			}
            break;
    }
}

function work_ques(pdq) {
    switch (pdq) {
        case 2:
			if(	$('#edu_qulify').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred');
			 $('.ques_progress1_status').css('width','50%'); 
			 work_quesq(pdq);
			 return true; 
			}
            break;
        case 3:
			if(	$('#work_qulify').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred');
			 $('.ques_progress1_status').css('width','100%');
			 $("#active_personal").css({"background":"#cccccc","color":"#2b2b2b"});
			 $("#active_teaching").css({"background":"#32a9d4","color":"#FFFFFF","display":"block"});
			 $("#active_education").css({"background":"#cccccc","color":"#2b2b2b"});
			 
			 setTimeout(function(){teaching_tab();},800);
			 return true; 
			}
            break;
    }
}

function teach_ques(pdq) {
    switch (pdq) {
        case 2:
			if(	$('#who_inspire').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred');
			 $('.ques_progress2_status').css('width','33.3%'); 
			 teach_quesq(pdq);
			 return true; 
			}
            break;
        case 3:
			if(	$('#understand_child').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $('.ques_progress2_status').css('width','66.67%');
			 teach_quesq(pdq);
			 return true; 
			}
            break;
        case 4:
			if(	$('#significant_had').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $('.ques_progress2_status').css('width','100%');
			 $("#active_personal").css({"background":"#cccccc","color":"#2b2b2b"});
			 $("#active_you").css({"background":"#32a9d4","color":"#FFFFFF","display":"block"});
			 $("#active_education").css({"background":"#cccccc","color":"#2b2b2b"});
			 $("#active_teaching").css({"background":"#cccccc","color":"#2b2b2b"});
			 
			 setTimeout(function(){you_tab();},800);
			 return true; 
			}
            break;
    }
}

function you_ques(pdq) {
    switch (pdq) {
        /*case 2:
			if(	$('#image_self').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $('.ques_progress3_status').css('width','33.3%');
			 you_quesq(pdq);
			 return true; 
			}
            break;*/
        case 2:
			if(	$('#childhood_descrp').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $('.ques_progress3_status').css('width','66.6%');
			 you_quesq(pdq);
			 return true; 
			}
            break;
        case 3:
			if(	$('#passion_about').val()=='')
			{ 
			 err=1;
			 $('.txtbox_cntr').addClass('boxred');
			 return false;
			} else
			{
			 $('.txtbox_cntr').removeClass('boxred'); 
			 $('.ques_progress3_status').css('width','100%');
			 $('#submit_display').css('display','block');
			 return true; 
			}
            break;
    }
}

function submitContactFrm(){
	
	var err = 0;
	
	if(	$('#your_name').val()==''){ err=1; $('.txtbox_cntr').addClass('boxred'); } else{ $('.txtbox_cntr').removeClass('boxred'); }
	
	if(err==0){
		
	}
}

teacherList();
function teacherList() { 
	
	ajax({
		a:'teacher',
		b:'act=loadTeacherDtls',
		c:function(){},
		d:function(data){ 
			$('#teachertab').html(data);
		}
	});
}

function popViewTeacher(){
  	$("#teacher_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function teacherCancelBtn(){ $("#teacher_popup").dialog('close');  }

function showTeacherPopup(teacher_id){ 
	$("#teacher_popup").dialog('open');	
  	ajax({
		a:'teacher',
		b:'act=loadTeacherPopupDtls&teacher_id='+teacher_id,		
		c:function(){},
		d:function(data){
			//alert(data);
			$("#teacher_popup").html(data);
			popViewTeacher();
		}			
	});
}


function show_whyakka(){
	
  	$("#whyakka_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_whyakka_popup(){  $("#whyakka_popup").dialog('close');  }




function show_teacher_prof(){
	
  	$("#teacher_profile_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_profile_popup(){  $("#teacher_profile_popup").dialog('close');  }


</script>



<?
}
include "template.php";
?>
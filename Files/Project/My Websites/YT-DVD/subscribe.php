<?
function main() {	

?>

<div class="full_width"> 
<div class="content">

    <div class="full_width ytmethod_row2out"> 
        <div class="" style="height:30%; margin-top:17%;">
            <?
			if($_REQUEST['id']!="") {
				$error=0;
				//$_REQUEST['id'] = base64_encode($_REQUEST['id']."||NC");
				$unsubvalue = base64_decode($_REQUEST['id']); 
				
				$tempArr = explode("||", $unsubvalue);
				$email = trim($tempArr[0]);
				$email_type = trim($tempArr[1]);
				
				if($email_type=="SF" || $email_type=="SM" || $email_type=="SE") {
					$stud_obj = new Student();
					$stud_obj->check_all_emails=$email;
					$rs_student = $stud_obj->getAllStudentDtls();
					if(count($rs_student)>0) {
						foreach($rs_student as $K=>$V) {
							if($email==$V->email_address){  
								Student::updateStudentByField("e_email_subscription", "Y", $V->id);
							}
							if($email==$V->father_email){
								Student::updateStudentByField("f_email_subscription", "Y", $V->id);
							}
							if($email==$V->mother_email){ 
								Student::updateStudentByField("m_email_subscription", "Y", $V->id);
							}
							$error=1;
						}
					} 
				}
				else if($email_type=="T") {
					$teacher_obj = new Teacher();
					$teacher_obj->email_address=$email;
					$rs_teacher = $teacher_obj->getTeachersDtls();
					if(count($rs_teacher)>0) {
						foreach($rs_teacher as $K=>$V) {
							if($email==$V->email_address){
								Teacher::updateTeachersByfield("email_subscription", "Y", $V->id);
								$error=1;
							}
						}
					}
				}
				else if($email_type=="NS") {
					$news_obj = new NewsletterSub();
					$news_obj->email_address=$email;
					$rs_subs = $news_obj->getNewsletterSubDtls();
					if(count($rs_subs)<=0) {
						$error=1;
						NewsletterSub::insertNewsletterSub("", $email, "", date("Y-m-d"));
					}
				}
				
				Circulars::deleteContactFromCircularLog($email, $email_type);
				
			} else {
				$error=0;
				$err_msg = "Could not find the subscription";
			}
			?>
            
            <? if($error==1) { ?>
			<div align="center" style="">
                <h1>Thank you.</h1><br />
                <p>The address <?=$email?> has been subscribed successfully.</p>
            </div>
            <? } else { echo $err_msg; if($err_msg=="") header("Location: ".getSeoUrl(array('pn'=>'index.php'))); } ?>
        	
        </div>
    </div>

</div>
</div>


<!--<div class="full_width" style="padding-bottom:30px;"> 
<div class="content">
    
    <div class="contact_explore">
        <h2>What to Explore Next ?</h2>
        <ul>
            <li><a href="<?=getSeoUrl(array('pn'=>'yt_grade_school.php'))?>">The Campus</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'yt_practices.php'))?>">YT Practices</a></li>
            <li><a href="<?=getSeoUrl(array('pn'=>'curriculum.php'))?>">Curriculum</a></li>
        </ul>
    </div>
    
</div>
</div>
-->

<div class="full_width" style="height:230px; background:url(images/slide_texture.png) repeat;"></div>

<? 
}
include "template.php";
?>
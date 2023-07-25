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
								if($V->e_email_subscription=="Y") {
									$error=0;
									Student::updateStudentByField("e_email_subscription", "N", $V->id);
								} else {
									$error=2;
								}
							}
							if($email==$V->father_email){
								if($V->f_email_subscription=="Y") {
									$error=0;
									Student::updateStudentByField("f_email_subscription", "N", $V->id);
								} else {
									$error=2;
								}
							}
							if($email==$V->mother_email){
								if($V->m_email_subscription=="Y") {
									$error=0;
									Student::updateStudentByField("m_email_subscription", "N", $V->id);
								} else {
									$error=2;
								}
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
								Teacher::updateTeachersByfield("email_subscription", "N", $V->id);
								$error=1;
							}
						}
					} else {
						$error=2;
					}
				}
				else if($email_type=="NS") {
					$news_obj = new NewsletterSub();
					$news_obj->email_address=$email;
					$rs_subs = $news_obj->getNewsletterSubDtls(); 
					if(count($rs_subs)>0) {
						foreach($rs_subs as $K=>$V) {
							if($email==$V->email_address){
								NewsletterSub::deleteNewsletterSubByemail($email);
								$error=1;
							}
						}
					} else {
						$error=2;
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
                <p>The address <?=$email?> has been unsubscribed.</p>
            </div>
            <? } else if($error==2) { ?>
            
            <div align="center" style="">
            The email address <?=$email?> unsubscribed already..! Would you like to subscribe again click subscribe button below:
            <table border="0" cellpadding="0" cellspacing="0" width="50%" style="margin-top:20px;">
            	<tr>
                	<td align="right"> Address to Subscribe : </td>
                    <td><a href="subscribe.php?id=<?=$_REQUEST['id']?>">
                        <div class="contact_submitbtn" style="background:url(images/menu_bg.jpg) no-repeat; clear:both; float:left; width:75%;">Subscribe</div>
                        </a>
                    </td>
                </tr>
            </table>
            </div>
			<? } else { ?>
            <div align="center" style="">
                <p><?=$err_msg?></p>
            </div>
			<? } ?>
        	
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
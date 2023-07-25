<?
function main() {	

?>

<div class="full_width"> 
<div class="content">

    <div class="full_width ytmethod_row2out"> 
        <div class="" style="height:30%;">
            <?
			$error=0;
			if($_REQUEST['id']=="") {
				$err_msg = "Could not find the subscription";
			} else if($_REQUEST['id']!="") {
				
				//$_REQUEST['id'] = base64_encode($_REQUEST['id']."||NC");
				$unsubvalue = base64_decode($_REQUEST['id']); 
				//echo $unsubvalue;
				$tempArr = explode("||", $unsubvalue);
				$email = trim($tempArr[0]);
				$email_type = trim($tempArr[1]);
				
				if($email_type=="SF") {
					$stud_obj = new Student();
					$stud_obj->father_email=$email;
					$rs_student = $stud_obj->getAllStudentDtls();
					if($rs_student[0]->f_email_subscription=="Y") $error=1;
					else { $error=2;  }
				}
				else if($email_type=="SM") {
					$stud_obj = new Student();
					$stud_obj->mother_email=$email;
					$rs_student = $stud_obj->getAllStudentDtls(); 
					if($rs_student[0]->m_email_subscription=="Y") $error=1;
					else { $error=2;  }
				}
				else if($email_type=="SE") {
					$stud_obj = new Student();
					$stud_obj->email_address=$email;
					$rs_student = $stud_obj->getAllStudentDtls();
					if($rs_student[0]->e_email_subscription=="Y") $error=1;
					else { $error=2;  }
				}
				else if($email_type=="T") {
					$teacher_obj = new Teacher();
					$teacher_obj->email_address=$email;
					$rs_teacher = $teacher_obj->getTeachersDtls();
					if($rs_student[0]->e_email_subscription=="Y") $error=1;
					else { $error=2;  }
				}
				else if($email_type=="NS") {
					$news_obj = new NewsletterSub();
					$news_obj->email_address=$email;
					$rs_subs = $news_obj->getNewsletterSubDtls();
					if(count($rs_subs)>0) {
						foreach($rs_subs as $K=>$V) {
							$error=1;
						}
					}
					else { $error=2;  }
				}
				
			} 
			 ini_set("display_errors", 1);
			 echo $error;
			?>
			<?
			if($error==1) {
			?>
            <div align="center" style="">
            Click below to unsubscribe from this newsletter.
            <table border="0" cellpadding="0" cellspacing="0" width="50%" style="margin-top:20px;">
            	<tr>
                	<td align="right"> Address to Remove : </td>
                    <td><a href="unsubscribe_thankyou.php?id=<?=$_REQUEST['id']?>">
                    	<div class="contact_submitbtn" style="background:url(images/menu_bg.jpg) no-repeat; clear:both; float:left; width:75%;">
                        	Unsubscribe
                        </div></a>
                    </td>
                </tr>
            </table>
           
            
            </div>
            <?
			} 
			else if($error==2) { 
			?>
            <div align="center" style="">
            This email address unsubscribed already..! Would you like to subscribe again click subscribe button below:
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
            <?
			}
			else { 
				echo $err_msg;
			}
			?>
        	
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
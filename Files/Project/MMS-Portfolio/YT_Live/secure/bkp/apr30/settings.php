<?
function main(){
	
if($_POST['act']=="showSettingsDtls") {
	ob_clean();
	$mentType = $_POST['type'];
	
	if($mentType=="Sub") include "subjects.php";
	if($mentType=="Stu") include "students.php";
	
	exit();
}
	
?>


<link rel="stylesheet" type="text/css" href="css/default_style.css" />

<div class="fullsize">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright5" /></td>
                <td>List <br/> <span class="f30"><strong>Settings</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop50 cursor" id="show_addteacher">
            
        </div>
    </div>
    
</div>



<div class="fullsize">
    
    <div class="fullsize padtb15">

        <div class="newsletter_left"> <!-- Menu -->
            <div class="newsletter_submenu txtwhite">
                <div class="circular_outer">
                    <div class="newcircular_head" id="show_currentteacher" onclick="showSettings('Sub');">Subjects<span></span></div>
                </div>
                <div class="circular_outer">
                    <div class="newcircular_head" id="show_currentteacher" onclick="showSettings('Stu');">Students<span></span></div>
                </div>
                
            </div>
        </div><!-- Menu -->
        
        <div class="newsletter_right border_theme bgwhite" id="hide_allgradelist" style="width:79%;"> <!-- Grade -->
            <div class="fullsize" id="settingscontent">
            
            </div>
        </div>

    </div>
    
</div>

<div id="subject_popup" style="display:none; padding:0;"></div>


<script type="text/javascript">

showSettings('Sub');
function showSettings(type) {
	
	ajax({
		a:'settings',
		b:'act=showSettingsDtls&type='+type,
		c:function(){},
		d:function(data) { //alert(data);
			$("#settingscontent").html(data);
		}
	});
}

/*$("#show_currentteacher").click(function(){
   $(this).addClass('active');
   $("#show_applicants").removeClass('active');
   $("#show_archive").removeClass('active');
   $(".currentteacher_content").show();
});*/




</script>



<?
}
include "template.php";
?>
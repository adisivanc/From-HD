
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="border-bottom:1px solid #dab971;">
            <ul class="list_menu">
              	<?
               
                $param=array("receiver_type"=>"'".$_SESSION["user_type"]."','P'-IN","status"=>"N-ENUM","receiver_id"=>"".$_SESSION['studentId']."-INT");
                $rs_communication=Communication::getCommunication($param,'','');
                $unread_message=count($rs_communication);
                ?>
                <li class="sub_nav active" id="comm_mail" onclick="getCommunication('<?=$studentId?>')">Communication(<?=$unread_message?>)</li>
                <li class="sub_nav" id="menu_calendar" onclick="getSCalendar('<?=$studentId?>')">Calendar</li>
                <li class="sub_nav" onclick="getDownloads('<?=$gradeId?>','<?=$studentId?>')">Downloads</li>
                <li class="sub_nav" onclick="getSubjects('<?=$gradeId?>','<?=$studentId?>')">Subjects</li>
                
            </ul>
        </td>
      </tr>
      <tr>
        <td id="student_content" align="left">
       
        </td>
      </tr>
    </table>
                    
                    
                    
                    
<script type="text/javascript">
	
$('.sub_nav').click(function(){
	
	$('.sub_nav').removeClass('active');
	$(this).addClass('active');
	
});

</script>                    
                    
                    

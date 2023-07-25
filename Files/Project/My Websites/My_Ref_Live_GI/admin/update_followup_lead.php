<?

$btn = 'Add'; $followup_id=0;
if($_POST['followup_id']!='') {
$rsLeads = Leads::getLeadFollowups(array('id'=>$_POST['followup_id'].'-INT'));
foreach($rsLeads as $K=>$V) $$K=$V;
$followup_id = $_POST['followup_id'];
$btn = 'Update';
}

?>

    <table width="500" border="0" cellspacing="0" cellpadding="0" class="followuptbl">
    <input type="hidden" name="followup_id" id='followup_id' value="<?=$followup_id?>">
      <tr>
        <th colspan="3">Follow Up <span class="cursor" onClick="close_followup()" style="float:right; margin-right:10px;">X</span></th>
      </tr>
      <tr>
        <td valign="top" width="150">Date</td>
        <td colspan="2"> <input type="text" class="txtbox datepicker" id="followup_date" name="followup_date" value="<?=($followup_date!='')?date('d/m/Y',strtotime($followup_date)):'';?>" /> </td>
      </tr>
      <tr>
        <td valign="top">Notes</td>
        <td colspan="2"><textarea class="txtarea" id="followup_notes" name="followup_notes"><?=$followup_notes?></textarea></td>
      </tr>
      <tr>
        <td colspan="3" align="right"> 
            <input type="button" class="btn"  id="followup_btn" value="<?=$btn?>" onclick="addnew_followup(<?=$_POST['lead_id']?>)" />
        </td>
      </tr>
      <tr>
        <td colspan="3" style="border-top:1px solid #5fb138;" id="followup_dtls">
      
       </td>
      </tr>
    </table>
<script type="text/javascript">
$(function() {
   $(".datepicker").datepicker({
		minDate: -20,
		dateFormat: "dd-mm-yy",
		changeMonth: true
   });  
 

	$("#datepicker").datepicker({ dateFormat: "dd-mm-yy" }).val()


});
</script>

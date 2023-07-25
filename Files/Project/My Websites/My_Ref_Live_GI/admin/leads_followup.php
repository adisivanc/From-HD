<!-- Followup -->
                    <div class="row"> 
                    <?
                    $rsLeads = Leads::getLeadFollowups(array('lead_id'=>$_POST['lead_id'].'-INT','orderby'=>'followup_date','sortby'=>'DESC'));
                    ?>
                    	
                    <div class="row">
                        <div class="btn_right" onClick="show_notes_popup('<?=$V->id?>')"> <strong>Notes</strong> </div>
                        <div class="btn_right" onClick="show_followup('<?=$V->id?>')"> <strong>Follow Up</strong> </div>
                    </div>
                    
                    <table width="100%" border="0" cellspacing="1" cellpadding="10" bgcolor="#333333">
                    <tr style="background-color:#696; text-align:center; ">
                    <th style="padding:5px; width:100px">Date</th>
                    <th style="padding:5px;"> Notes </th>
                    <th style="padding:5px;width:100px"> Action </th>
                    </tr>
                    
                    <? 
                    if(count($rsLeads)>0) {
                    foreach($rsLeads as $K=>$V) {
                    
                    ?>
                    
                    <tr style="background-color:#FFF" id="Fid_<?=$V->id?>">
                
                    <td style="padding:5px;"><?=date('d M,Y',strtotime($V->followup_date))?></td>
                    <td style="padding:5px;"><?=$V->followup_notes?></td>
                    <td style="padding:5px;" > 
                    
                    <img src="images/edit_icon.png" alt="Edit" title="Edit" align="absmiddle" class="cursor" onclick="editFollowup(<?=$V->id?>,<?=$V->lead_id?>)" />
                    <img src="images/close.png" alt="Delete" title="Delete" align="absmiddle" class="cursor" onclick="deleteFollowup(<?=$V->id?>)" /> 
                    </td>
                    </tr>
                    <?
                    }
                    } else {
                    ?>
                    
                    <tr style="background-color:#FFF">
                    <td  colspan="3" valign="middle" align="center" style="padding:15px;">No Followups added yet!</td> </tr>   
                    <?
                    }
                    ?>  
                    </table>
                    
                    </div>
                    <!-- Followup -->
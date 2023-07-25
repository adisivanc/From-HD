<table width="95%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;">
      <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="upcomingtbl">
              <tr>
                <td style="border-bottom:1px solid #555555; cursor:pointer;" onclick="getSCalendar('<?=$studentId?>')">
                    <div style="float:left; font-weight:bold;">Coming Up </div>
                    <div style="float:right;"> <img src="images/cal_icon1.png" alt="" /> View Calendar</div>
                </td>
              </tr>
              <tr>
                <td>
                     <?  $count=0;
                      $rs_calendar=Calendar::getCalenarVisibilityByGrade($gradeId);
                      if(count($rs_calendar)>0)
                      {
                      foreach($rs_calendar as $K=>$V)
                      {                                    
                      if($count<2)
                      {                                 
                                $timestamp = strtotime($V->event_date);
                                $formattedDate = date('F d Y', $timestamp);
                                    
                            ?>
                    <div class="event_list" style="cursor:pointer" onclick="getComingUpDetail('<?=$V->id?>')">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="40" align="center"><img src="images/cal_icon2.png" alt="" /></td>
                            <td>
                                <div class="event_name">
                                
                                
                                    <h3><? echo substr($V->event_name,0,15);if(strlen($V->event_name)>15){echo "....";}?></h3>
                                    <h4><?=$formattedDate?></h4>
                                </div>
                            </td>
                          </tr>
                        </table>
                    </div>
                         <?
                     $count=$count+1;
                      }
                      }
                  }
                  ?>
                </td>
              </tr>
            </table>

        </td>
      </tr>
    </table>
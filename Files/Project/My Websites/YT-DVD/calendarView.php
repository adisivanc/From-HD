<?
include "includes.php";

	if(!function_exists(getWeekList)){
		function getWeekList($date, $wd){
			$weekdays = array();
			$aDay = 24 * 60 * 60 ;
			for($index=0; $index<7; $index++){
				$cDay = 0;
				if($index<=$wd){
					$cDay=$date-($aDay * ($wd-$index));
				}
				else{
					$cDay=$date+($aDay * ($index-$wd));
				}
				$weekdays[]=date('D', $cDay);
			}
			return $weekdays ;
		}
	}
	
	
	$mn = $_POST['month'];
	$yr = $_POST['year'];
	
	$today = time() ;
	$currmonth = mktime(0, 0, 0, date('m', $today), 1, date('Y', $today));
	$todaydate = mktime(0, 0, 0, date('m', $today), date('d', $today), date('Y', $today));
	$currmonth = mktime(0, 0, 0, date('m', $today), 1, date('Y', $today));
	
	if($mn!="")
		$mn = $mn;
	else 
		$mn = date('m');	
	
	if($yr!="")   
		$yr = $yr;
	else
		$yr = date('Y');		
	
	if($mn>0 && $yr>0)
		$currmonth = mktime(0, 0, 0, $mn, 1, $yr); 
		
	$pmonth = mktime(0, 0, 0, date('m', $currmonth)-1, 1, date('Y', $currmonth));
	$nmonth = mktime(0, 0, 0, date('m', $currmonth)+1, 1, date('Y', $currmonth));
	
	$pmn = date('m', $pmonth);
	$pyr = date('Y', $pmonth);
	
	$nmn = date('m', $nmonth);
	$nyr = date('Y', $nmonth);
	
	$date = getDate($currmonth);
	
	$day = $date["mday"];
	$month = $date["mon"];
	$month_name = $date["month"];
	$year = $date["year"];
	
	$this_month = getDate(mktime(0, 0, 0, $month, 1, $year));
	$next_month = getDate(mktime(0, 0, 0, $month + 1, 1, $year));
	
	$first_week_day = $this_month["wday"];
	
	$weekdays = getWeekList(mktime(0, 0, 0, $month, 1, $year), $first_week_day);
	
	$days_in_this_month = round(($next_month[0] - $this_month[0]) / (60 * 60 * 24));
		
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="90%" valign="top">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="border-bottom:8px solid #32a9d4;">
            <tr>
              <td valign="middle" align="center">
              	<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" class="cal_top_tbl">
                  <tr>
                    <td align="center" style="float:left; padding:5px;" id="spPrev"><img src="images/left_arrow.png" border="0" alt="Prev" title="Prev" align="absmiddle" onclick='callViewCalendar("<?=$pmn?>", "<?=$pyr?>")' style="cursor:pointer;" /><!--<span id="spPrev" onclick='callViewCalendar("<?=$pmn?>", "<?=$pyr?>")' style="cursor:pointer"><b>&lt;&lt; Prev</b></span>--></td>
                    <td align="center"><b style="color:#ffffff;">
                      <?=strtoupper($month_name) . " " . strtoupper($year)?>
                      </b></td>
                    <td align="center" style="float:right; padding:5px;" id="spPrev"><img src="images/right_arrow.png" border="0" alt="Next" title="Next" onclick='callViewCalendar("<?=$nmn?>", "<?=$nyr?>")' style="cursor:pointer;" /><!--<span id="spPrev" onclick='callViewCalendar("<?=$nmn?>", "<?=$nyr?>")' style="cursor:pointer"><b>Next &gt;&gt;</b></span>--></td>
                  </tr>
                </table>
              </td>
            </tr>
            
            <tr>
              <td valign="middle" align="center">
               	<table border="0" cellpadding="0" cellspacing="0" align="center" class="calendar_tbl"  style="border:1px solid #FFFFFF; ">
                      <tr>
                        <?
                for($week_dayindex = 0; $week_dayindex < 7; $week_dayindex++){
        ?>
                        <td align="center" valign="middle" style="color:#ffffff;"><?=strtoupper($weekdays[$week_dayindex])?></td>
                        <?
                }
        ?>
                      </tr>
                      <tr>
                        <?
                for($week_day = 0; $week_day < $first_week_day; $week_day++){
        ?>
                        <td class="empty">&nbsp;</td>
                        <?
                }
        
                $day = date('d');	
                $week_day = $first_week_day;
                
                
        
                for($day_counter = 1; $day_counter <= $days_in_this_month; $day_counter++){
                    $week_day %= 7;
                    if($week_day == 0){
        ?>
                      </tr>
                      <tr>
                        <?
                    }
                     $currmn =  date('m');
                     $curryr =  date('Y'); 
                    $today = $yr."_".$mn."_".$day_counter;
                    $dvid =  $id."_".$yr."_".$mn."_".$day_counter;
                    
                    $currentDateTS = mktime(0, 0, 0,  $mn, $day_counter ,$yr);
                    $db_date=date("Y-m-d",$currentDateTS);
                    
                    $currentdate = mktime(0, 0, 0, $month, $day_counter, $year);
                    $nwDate =$mn."-".$day_counter."-".$yr;
                    
                    $event_date = $yr."-".$mn."-".$day_counter;
					$rs_event_dates = Events::getAllEventsDates($event_date);
					
                    /*if($day_counter == $day && $currmn == $mn && $curryr == $yr){
                        $tdclass = 'cal_inner_cur';
                    }else {
                       $tdclass = 'cal_inner_default';
                    }*/
					if(in_array($event_date, $rs_event_dates)){
                       $tdclass = 'cal_inner_cur';
                    }else {
                       $tdclass = 'cal_inner_default';
                    }
                    
                    //$bgcolor = ' background-color:#edeeee;';
                    
                    
        ?>
                        <td align="center"><div class="<?=$tdclass?>" style="position:relative;"> 
                            <!--<div style="width:60px; height:30px; text-align:center; border:1px solid #9CB80E; padding:2px; <?= $bgcolor?>">-->
                            <div style="text-align:center; padding:2px; vertical-align:top;">
                              <div style="float: left; cursor:pointer; font-family:open_sanssemibold; font-weight: <? if($day_counter == $day && $currmn == $mn && $curryr == $yr){ ?>bold<? } else{ ?>normal<? } ?>;  vertical-align:top; width:100%; line-height:30px; color:#000000;" onClick="showUpEventDtls('<?=$day_counter?>','<?=$mn?>','<?=$yr?>')">
                                <?=$day_counter?>
                              </div>
                            </div>
                          </div></td>
                        <?
                    $week_day++;
                }
                
                for(; $week_day < 7; $week_day++){
        ?>
                        <td class="empty">&nbsp;</td>
                        <?
                }
        ?>
                      </tr>
                </table>
                </td>
            </tr>

             </table>
  </td>
  </tr>
  <tr><td style="padding:10px 0; color:#666666; line-height:1.8"><img src="images/gplus_icon.png" style="float:left; margin-right:10px;" alt="Google+" border="0" />
  <a href="http://www.google.com/calendar" class="gray" target="_blank" style="border:0px; outline:none;">Add events to your calendar</a></td></tr>
</table>
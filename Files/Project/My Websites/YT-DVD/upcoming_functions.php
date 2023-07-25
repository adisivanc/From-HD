<?


if($_POST['act']=="loadEvents") {
	ob_clean();
		
	$evnt_obj = new Events();
	$evnt_obj->sortby = "Desc";
	$evnt_obj->orderby = "id";
	$rs_events =$evnt_obj->getEventsDtls();
	
	if(count($rs_events)>0) {
		foreach($rs_events as $K=>$V) {
		?>
        <div class="event_row">
            <div class="eventrow_left">
                <div class="update_outer">
                    <div class="upevents_date"><?=$V->event_from_date?>DEC<br>20 <span>10:00 AM</span></div>
                    <div class="upevents_img"><img src="images/event_img1.jpg" alt="Upcoming Events" /></div>
                </div>
            </div>
            
            <div class="eventrow_right">
                <h2>Chrismas Bazaar <span>Grade School Campus</span></h2>
                <p>Annual marketplace offering an eclectic selection of gift items from local artists, craftspeople, and vendors. Also hosts live music. Annual marketplace offering an eclectic selection 
                 of gift items from local artists, craftspeople, and vendors. Also hosts live music. <a onclick="show_events()" class="blue cursor">more...</a></p>
            </div>
        </div>
        <?
		}
	}
		
	exit();
}

?>
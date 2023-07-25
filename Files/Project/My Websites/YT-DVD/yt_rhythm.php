<?
function main(){
?>


<style type="text/css">

.rhythm1_bg { width:100%; float:left; height:25px; position:relative; margin:255px 0 250px 0; }
.polebg_dark { width:100px; float:left; height:20px; background: url(images/rhythm/bg1.jpg) repeat; position:relative; }
.polebg_light { width:100px; float:left; height:20px; background: url(images/rhythm/bg2.jpg) repeat; position:relative; }

.pole_arrow_top { width:24px; height:13px; position:absolute; top:-13px; left:38px; }
.pole_arrow_btm { width:24px; height:13px; position:absolute; bottom:-13px; left:38px; }

.arrow_darkup { background-image:url(images/rhythm/arrow1.png); }
.arrow_darkdown { background-image:url(images/rhythm/arrow11.png); }

.arrow_litup { background-image:url(images/rhythm/arrow2.png); }
.arrow_litdown { background-image:url(images/rhythm/arrow12.png); }


.rhythm_wrapper_outer { width:250px; height:250px; position:relative; z-index:0; border:0px solid red; left:-75px; margin-top:-290px; } 
.rhythm_wrapper_outer1 { margin-top:55px; } 


.rhythm_wrapper { width:125px; height:125px; display: inline-block; -webkit-border-radius: 500px; -moz-border-radius: 500px; border-radius: 500px; -khtml-border-radius: 500px; left:60px; position:absolute; top:0;     
    -webkit-transition: all 250ms ease; -moz-transition: all 250ms ease; -o-transition: all 250ms ease; -ms-transition: all 250ms ease; transition: all 250ms ease; cursor:pointer; color:#FFFFFF; 
	 border:0px solid red; }
	
.rhythm_wrapper1 { right:60px; top:auto; bottom:0;  } 	

.rhythm_bgdark { background:url(images/rhythm/bg1.jpg) no-repeat center center; }
.rhythm_bglight { background:url(images/rhythm/bg2.jpg) no-repeat center center; }


.rhythm_wrapper h2 { width:100%; float:left; text-align:center; font-size:17px; margin-top:40px; font-weight:600; letter-spacing:-1; }
.rhythm_wrapper h2.title_single { margin-top:52px; }
.rhythm_wrapper h2.title_three { margin-top:30px; }

.rhythm_desc_outer { width:100%; float:left; display:none; -webkit-transform: scale(0, 0); -moz-transform: scale(0, 0); -o-transform: scale(0, 0); -ms-transform: scale(0, 0); } 
.rhythm_desc_img { width:100%; float:left; text-align:center; padding-bottom:3px; }
.rhythm_desc { width:100%; float:left; text-align:center; font-size:15px; letter-spacing:-1; }
 
.rhythm_wrapper:hover { width:250px; height:250px; bottom:0; left:0; z-index:10; overflow:hidden; box-shadow:0px 0px 10px #666666; filter: progid:DXImageTransform.Microsoft.Shadow(color=#888888,direction=120,strength=5);  }
.rhythm_wrapper:hover h2 { line-height: normal; margin-top:20px; margin-bottom:5px; }
.rhythm_wrapper:hover .rhythm_desc_outer { -webkit-transform: scale(1, 1); -moz-transform: scale(1, 1); -o-transform: scale(1, 1); -ms-transform: scale(1, 1); display: block; }
.rhythm_wrapper1:hover { bottom:0; left:0; }

.rhythm_time { position:absolute; width:100px; font-size:18px; color:#222222; text-align:center; }
.time_top { top:-45px; }
.time_btm { top:40px; }


</style>


<div class="rhythm_container">
	
    <div class="page_menu" style="padding-top:30px;">
    <div class="content">
        <div class="page_menu_container">
        
            <div class="page_menutop">
                <h1 class="page_menuhd">YT Rhythm</h1>
                <div class="pagemenu_right">
                    <div class="pagemenu_desctop" style="padding-top:5px;">As part of everyday rhythm children are expected to work <br/>with Language and Arithmetic during YT Fundamentals</div>
                </div>
            </div>

        </div>
    </div>
    </div>


	<div class="rhythm_content" style="background:none;">
	<div class="rhythm_bg" style="background:none;">    
    <div class="content">

		<div class="rhythm1_bg">
        
        	<div class="polebg_dark">
            	<div class="pole_arrow_btm arrow_darkdown"></div>
                
            	<div class="rhythm_time time_top">08:30 AM</div>
                <div class="rhythm_wrapper_outer rhythm_wrapper_outer1">
                <div class="rhythm_wrapper rhythm_bglight">
                	<h2 class="title_single">BREAKFAST</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_breakfast.png" alt="Breakfast" /></div>
                        <div class="rhythm_desc">Children are greeted by<br/> the ducks, hens and hot<br/> idlis. Some eat slow. Some<br/> gobble them up to<br/>get extra time in their<br/> cycles</div>
                    </div>
                </div>
                </div>
            </div>
            
            
	        <div class="polebg_light">
            	<div class="pole_arrow_top arrow_litup"></div>
                
            	<div class="rhythm_time time_btm">09:00 AM</div>
                <div class="rhythm_wrapper_outer ">
                <div class="rhythm_wrapper rhythm_wrapper1 rhythm_bgdark">
                	<h2>GOLDEN<br/>SILENCE</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_golden.png" alt="Golden Silence" /></div>
                        <div class="rhythm_desc">The whole school is silent.<br/> It is time for inward<br/> activity before we<br/> commence the day.</div>
                    </div>
                </div>
                </div>
            </div>
            
            
        	<div class="polebg_dark">
            	<div class="pole_arrow_btm arrow_darkdown"></div>
            
            	<div class="rhythm_time time_top">09:10 AM</div>
                <div class="rhythm_wrapper_outer rhythm_wrapper_outer1">
                <div class="rhythm_wrapper rhythm_bgdark">
                	<h2>MORNING<br/>CIRCLE</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_morning.png" alt="Breakfast" /></div>
                        <div class="rhythm_desc">The whole school comes<br/> together for singing,<br/> greeting, rhythm,<br/> movement and<br/> togetherness.</div>
                    </div>
                </div>
                </div>
            </div>
            
            
	        <div class="polebg_light">
            	<div class="pole_arrow_top arrow_litup"></div>
            
            	<div class="rhythm_time time_btm">09:20 AM</div>
                <div class="rhythm_wrapper_outer">
                <div class="rhythm_wrapper rhythm_wrapper1 rhythm_bglight">
                	<h2>MAIN<br/>
                	LESSON</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_lession.png" alt="Breakfast" style="margin-bottom:10px;" /></div>
                        <div class="rhythm_desc">Time for focus and a long<br/> period of concentration<br/> and work.</div>
                    </div>
                </div>
                </div>
            </div>
            
            
        	<div class="polebg_dark">
            	<div class="pole_arrow_btm arrow_darkdown"></div>
                
            	<div class="rhythm_time time_top">11:00 AM</div>
                <div class="rhythm_wrapper_outer rhythm_wrapper_outer1">
                <div class="rhythm_wrapper rhythm_bglight">
                	<h2>FRUIT<br/>&amp; PLAY</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_fruit.png" alt="Furit and Play" style="margin:15px 0;" /></div>
                        <div class="rhythm_desc">Refresh with a fruit and<br/> time to play.</div>
                    </div>
                </div>
                </div>
            </div>
            
            
	        <div class="polebg_light">
            	<div class="pole_arrow_top arrow_litup"></div>
            
            	<div class="rhythm_time time_btm">11:30 AM</div>
                <div class="rhythm_wrapper_outer ">
                <div class="rhythm_wrapper rhythm_wrapper1 rhythm_bgdark">
                	<h2>YT<br/>Fundamentals</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_fund.png" alt="Breakfast" style="margin:3px 0;" /></div>
                        <div class="rhythm_desc">I work on my own. At the<br/> pace I want. Time for<br/> practice and <br/>self-learning.</div>
                    </div>
                </div>
                </div>
            </div>
            
            
        	<div class="polebg_dark">
            	<div class="pole_arrow_btm arrow_darkdown"></div>
            
            	<div class="rhythm_time time_top">12:00 PM</div>
                <div class="rhythm_wrapper_outer rhythm_wrapper_outer1">
                <div class="rhythm_wrapper rhythm_bgdark">
                	<h2>LANGUAGE<br/>BLOCK</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_lang.png" alt="Breakfast" style="margin:25px 0;" /></div>
                        <div class="rhythm_desc">Languages – Hindi and<br/> Tamil</div>
                    </div>
                </div>
                </div>
            </div>
            
            
	        <div class="polebg_light">
            	<div class="pole_arrow_top arrow_litup"></div>
            
            	<div class="rhythm_time time_btm">01:00 PM</div>
                <div class="rhythm_wrapper_outer ">
                <div class="rhythm_wrapper rhythm_wrapper1 rhythm_bglight">
                	<h2 class="title_single">LUNCH</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_lunch.png" alt="Breakfast" style="margin:25px 0;" /></div>
                        <div class="rhythm_desc">Blessings on the meal.</div>
                    </div>
                </div>
                </div>
            </div>
            
            
        	<div class="polebg_dark">
            	<div class="pole_arrow_btm arrow_darkdown"></div>
            
            	<div class="rhythm_time time_top">01:45 PM</div>
                <div class="rhythm_wrapper_outer rhythm_wrapper_outer1">
                <div class="rhythm_wrapper rhythm_bglight">
                	<h2 class="title_three">ART &amp;<br/>HANDWORK<br/>BLOCK</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_art.png" alt="Breakfast" /></div>
                        <div class="rhythm_desc">Art, handwork, Recorder,<br/> Rhapsody, Singing, carpentry<br/> &amp; Clay Modelling alternate<br/> through the week.</div>
                    </div>
                </div>
                </div>
            </div>
            
            
            
	        <div class="polebg_light">
            	<div class="pole_arrow_top arrow_litup"></div>
            
            	<div class="rhythm_time time_btm">02:30 PM</div>
                <div class="rhythm_wrapper_outer ">
                <div class="rhythm_wrapper rhythm_wrapper1 rhythm_bgdark">
                	<h2>SPORTS<br/>BLOCK</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_sports.png" alt="Breakfast" style="margin-bottom:10px;" /></div>
                        <div class="rhythm_desc">Sports, play and games. It<br/> is a time to build<br/> 'camaraderie' over the<br/> 'war to win'.</div>
                    </div>
                </div>
                </div>
            </div>
            
            
            
        	<div class="polebg_dark">
            	<div class="pole_arrow_btm arrow_darkdown"></div>
            
            	<div class="rhythm_time time_top">03:00 PM</div>
                <div class="rhythm_wrapper_outer rhythm_wrapper_outer1">
                <div class="rhythm_wrapper rhythm_bgdark">
                	<h2 class="title_single">CLOSURE</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_closure.png" alt="Breakfast" /></div>
                        <div class="rhythm_desc">Recollect the day's work and<br/> close with juice or warm<br/> milk.</div>
                    </div>
                </div>
                </div>
            </div>
            
            
            
	        <div class="polebg_light">
            	<div class="pole_arrow_top arrow_litup"></div>
            
            	<div class="rhythm_time time_btm">03:10 PM</div>
                <div class="rhythm_wrapper_outer ">
                <div class="rhythm_wrapper rhythm_wrapper1 rhythm_bglight">
                	<h2>BUS LEAVES<br/>FOR THE DAY</h2>
                	<div class="rhythm_desc_outer">
                    	<div class="rhythm_desc_img"><img src="images/rhythm_bus.png" alt="Breakfast" style="margin:5px 0;" /></div>
                        <div class="rhythm_desc">Hurrying up, searching for<br/> water bottles, finishing the<br/> juice. Finally the bus <br/>leaves. That's the <br/>day school.</div>
                    </div>
                </div>
                </div>
            </div>
            
        
        </div>

    </div>
    </div>
    </div>
    
</div>

<?
}
include "template.php";
?>
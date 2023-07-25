
    <!-- it works the same with all jquery version from 1.x to 2.x -->
    <!-- use jssor.slider.mini.js (40KB) or jssor.sliderc.mini.js (32KB, with caption, no slideshow) or jssor.sliders.mini.js (28KB, no caption, no slideshow) instead for release -->
    <!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.js + jssor.slider.js) -->
    <script type="text/javascript" src="js/jssor.js"></script>
    <script type="text/javascript" src="js/jssor.slider.js"></script>
    
    
    <script>
        jQuery(document).ready(function ($) {

            var _CaptionTransitions = [];
            _CaptionTransitions["L"] = { $Duration: 900, x: 0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["R"] = { $Duration: 900, x: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["T"] = { $Duration: 900, y: 0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["B"] = { $Duration: 900, y: -0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
            _CaptionTransitions["ZMF|10"] = { $Duration: 900, $Zoom: 11, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 };
            _CaptionTransitions["RTT|10"] = { $Duration: 900, $Zoom: 11, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} };
            _CaptionTransitions["RTT|2"] = { $Duration: 900, $Zoom: 3, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 0.5} };
            _CaptionTransitions["RTTL|BR"] = { $Duration: 900, x: -0.6, y: -0.6, $Zoom: 11, $Rotate: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.8} };
            _CaptionTransitions["CLIP|LR"] = { $Duration: 900, $Clip: 15, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic }, $Opacity: 2 };
            _CaptionTransitions["MCLIP|L"] = { $Duration: 900, $Clip: 1, $Move: true, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic} };
            _CaptionTransitions["MCLIP|R"] = { $Duration: 900, $Clip: 2, $Move: true, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic} };

            var options = {
                $FillMode: 2,                                       //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideEasing: $JssorEasing$.$EaseOutQuint,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
                $SlideDuration: 800,                               //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $CaptionSliderOptions: {                            //[Optional] Options which specifies how to animate caption
                    $Class: $JssorCaptionSlider$,                   //[Required] Class to create instance to animate caption
                    $CaptionTransitions: _CaptionTransitions,       //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
                    $PlayInMode: 1,                                 //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
                    $PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
                },

                $BulletNavigatorOptions: {                          //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                 //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 8,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 8,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                },

                $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var bodyWidth = document.body.clientWidth;
                if (bodyWidth)
                    jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }


            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end
        });
    </script>
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles to css file or css block. -->
    <div id="slider1_container" style="position: relative; margin: 0 auto;
        top: 0px; left: 0px; width:1920px; height: 1050px; overflow: hidden;">
        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block;
                top: 0px; left: 0px; width: 100%; height: 100%;">
            </div>
            <div style="position: absolute; display: block; background: url(images/loading.gif) no-repeat center center;
                top: 0px; left: 0px; width: 100%; height: 100%;">
            </div>
        </div>
        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width:1920px; height: 1050px; overflow: hidden; ">
   
            <div><!-- Slides 1-->
                <img u="image" src="images/slide1_bg.png"/>
                
                <div class="content" style="position:relative;">
                
                    <div class="slide1_bubble1"><img src="images/slide1_bubble_img1.png"/></div>
                    <div class="slide1_10years">
                    	<span class="slide1_head_over">OVER</span> 10 YEARS<br/> OF EXPERIENCE
                    </div>
                    <div class="slide1_bubble2"><img src="images/slide1_bubble_img2.png"/></div>
                    <div class="slide1_img"><img src="images/slide1_img.png"/></div>
                    
                    <div style="position:absolute; top:300px; left:800px; ">
                    	<div class="slide1_subhead">GET MORE FROM <br/>YOUR NEXT WEBSITE...</div>
                        <div class="slide1_list">
                            <ul class="slide1_leftcnt">
                                <li>More Leads</li>
                                <li>More Sales</li>
                                <li>More Traffic</li>
                                <li>More Support</li>
                            </ul>
                            <ul class="slide1_rightcnt">
                                <li>More Freedom</li>
                                <li>More Features</li>
                                <li>More Control</li>
                                <li>More Savings</li>
                        	</ul>
                        </div>
                    </div>
                    
                    <div class="slide1_cnt">Talk to us today to find out how you can get<br/>a Business Class website on an Economy budget. </div>
                    <div class="slide1_btn"><a href="portfolio.php" target="_blank"><img src="images/seeportfolio_btn.png"/></a></div>
                    
                </div>
            </div><!-- Slides 1-->
            
            
             <div><!-- Slides 2-->
                <img u="image" src="images/slide2_bg.png"/>
               	
                <div style="position:relative;">
                	<div class="slide2_img"><img src="images/slide2_image.png"/></div>
					<div class="slide2_wecreate slide_head">WE CREATE<br/>YOU CONTROL</div> 
                    <div class="slide2_content slide_content">WITH A MASTERMIND WEBSITE, YOU CAN MAKE CHANGES<br/> ANY TIME, FROM ANYWHERE. NO TECHNICAL SKILLS <br/>REQUIRED. WE PROMISE.</div> 
                    <div class="slide2_btn"><a href="contact.php" target="_blank"><img src="images/freequote_btn.png"/></a></div>              
                </div>
                	
            </div><!-- Slides 2-->
            
            
            <div style="width:1920px; height: 1050px; overflow: hidden;"><!-- Slides 3-->
                <img u="image" src="images/slide3_bg.png" />
                
                <div style="position:relative;">
                	<div class="slide_head slide3_introduce">INTRODUCE MOBILITY TO<br/> YOUR BUSINESS</div>
                    <div class="slide_content slide3_content">MMS expertise in mobile technologies can assist<br/> you in rapidly developing apps and mobility solutions</div> 
                    <div class="slide1_list">
                    	<ul class="slide3_points">
                            <li>Build custom mobile app - utilities, games, business apps</li>
                            <li>Rapidly build cross platform apps - iPhone, iPad, Android, Windows</li>
                            <li>Design and develop mobile optimized websites</li>
                            <li>Develop innovative mobile solutions for M-commerce and social media</li>
                        </ul>
                    </div>
                    <div class="slide3_portbtn"><a href="portfolio.php" target="_blank"><img src="images/seeportfolio_btn.png"/></a></div>
                    <div class="slide3_mobile"><img src="images/slide3_image.png"/></div>       
                </div>
            </div><!-- Slides 3-->
            
            
            
            <div><!-- Slides 4-->
                <img u="image" src="images/slide4_bg.png" />
                
                <div style="position:relative;">
                	<div class="slide_head slide4_social">SOCIAL MEDIA MARKETING</div>
                    <div class="slide_content slide4_content">We'll help you create a social media campaign <br/> that will increase traffic, promote your brand <br/> and increase your presence in the marketplace
					       <br/>using the most popular social media</div> 
                    <div class="slide4_24hr"><a href="contact.php" target="_blank"><img src="images/slide4--24hr.png"/></a></div>
                     
                    <div class="slide4_users slide4_pos1">901 million <br/> <span class="slide4_media_type">Facebook users</span></div>
                    <div class="slide4_users slide4_pos2">555 million <br/> <span class="slide4_media_type">Twitter users</span></div>
                    <div class="slide4_users slide4_pos3">170 million <br/> <span class="slide4_media_type">Google+ users</span></div>
                    <div class="slide4_users slide4_pos4">150 million <br/> <span class="slide4_media_type">Linkedin users</span></div>
                    <div class="slide4_media_plays">Social media plays a very <br/>vital & potential role in <br/> current day business </div>
                    
                    <div class="slide4_img"><img src="images/slide4_image.png"/></div>
                          
                </div>
                
            </div><!-- Slides 4-->
            
            
            <div><!-- Slides 5-->
                <img u="image" src="images/slide5_bg.png" />
                
                <div style="position:relative;">
                	<div class="slide5_face"><img src="images/slide5_image.png"/></div> 
                    <div class="slide5_time slide_head">WORK IN YOUR TIME ZONE</div> 
                    <div class="slide5_clock"><img src="images/slide5_watch.png"/></div> 
                    <div class="slide5_newyrk slide5_common">New York</div> 
                    <div class="slide5_london slide5_common">London</div>
                    <div class="slide5_melborne slide5_common">Melbourne</div>
                    <div class="slide5_common slide5_points">
                        <p style="padding:7px 0;">We have the resources & intrastructure to provide you a team to<br/> work in your time zone.</p>
                        <p style="padding:7px 0;">Quick & timely responsive of our team in all phases of the<br/> development really sets us apart.</p>
                        <p style="padding:7px 0;">Our unique code inspection process ensures the highest standards<br/> in the quality of the software our developers write.</p>
                    </div>
                    <div class="slide5_skypeus"><img src="images/skype_image.png" align="middle" /> us</div>   
                </div>
                
            </div>
            
            <div><!-- Slides 6-->
                <img u="image" src="images/slide6_bg.png" />
                
                <div style="position:relative;">
                	 <div style="position:absolute; left:0px; top:0px;"><img src="images/slide6_image.png"/></div>
                     <div class="slide6_clients slide_head">WOW YOUR CLIENTS</div> 
                     <div style="position:absolute; right:260px; top:250px; font-size:24px; color:#FFFFFF;">
                        <p style="padding-bottom:10px;">Create the right impression with a professional branding team <br/>Knock their socks off and reap the rewards</p>
                        <p>Without heart stopping graphic design your competitors will<br/> leave you behind! Let us revolutions your graphics so that they<br/> demand attention</p>
                     </div>
                     <div style="position:absolute; right:580px; top:450px; cursor:pointer;"><a href="contact.php" target="_blank"><img src="images/slid6-brand.png"/></a></div>     
                </div>
                
            </div>
            <!-- Example to add fixed static share buttons in slider BEGIN -->
            <!-- Remove it if no need -->
            <!-- Share Button Styles -->
            <style>
                .share-icon {
                    display: inline-block;
                    float: left;
                    margin: 4px;
                    width: 32px;
                    height: 32px;
                    cursor: pointer;
                    vertical-align: middle;
                    background-image: url(../img/share/share-icons.png);
                }

                .share-facebook {
                    background-position: 0px 0px;
                }

                    .share-facebook:hover {
                        background-position: 0px -40px;
                    }

        .share-twitter {
            background-position: -40px 0px;
        }

            .share-twitter:hover {
                background-position: -40px -40px;
            }

        .share-pinterest {
            background-position: -80px 0px;
        }

            .share-pinterest:hover {
                background-position: -80px -40px;
            }

                .share-linkedin {
                    background-position: -240px 0px;
                }

                    .share-linkedin:hover {
                        background-position: -240px -40px;
                    }


                .share-googleplus {
                    background-position: -120px 0px;
                }

                    .share-googleplus:hover {
                        background-position: -120px -40px;
                    }


        .share-stumbleupon {
            background-position: -360px 0px;
        }

            .share-stumbleupon:hover {
                background-position: -360px -40px;
            }

                .share-email {
                    background-position: -320px 0px;
                }

                    .share-email:hover {
                        background-position: -320px -40px;
                    }
            </style>

            <!-- Example to add fixed static share buttons in slider BEGIN -->
            <!-- Remove it if no need -->
            <div u="any" style="position: absolute; display: block; top: 6px; right: 170px; width: 280px; height: 40px;">


                <a class="share-icon share-facebook" target="_blank" href="http://www.facebook.com/sharer.php?u=http://jssor.com" title="Share on Facebook"></a>
                <a class="share-icon share-twitter" target="_blank" href="http://twitter.com/share?url=http://jssor.com&text=jQuery%20Image%20Slider/Slideshow/Carousel/Gallery/Banner%20javascript+html%20TOUCH%20SWIPE%20Responsive" title="Share on Twitter"></a>
                <a class="share-icon share-googleplus" target="_blank" href="https://plus.google.com/share?url=http://jssor.com" title="Share on Google Plus"></a>
                <a class="share-icon share-linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=http://jssor.com" title="Share on LinkedIn"></a>
                <a class="share-icon share-stumbleupon" target="_blank" href="http://www.stumbleupon.com/submit?url=http://jssor.com&title=jQuery%20Image%20Slider/Slideshow/Carousel/Gallery/Banner%20javascript+html%20TOUCH%20SWIPE%20Responsive" title="Share on StumbleUpon"></a>
                <a class="share-icon share-pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=http://jssor.com&media=http://jssor.com/img/site/jssor.slider.jpg&description=jQuery%20Image%20Slider/Slideshow/Carousel/Gallery/Banner%20javascript+html%20TOUCH%20SWIPE%20Responsive" title="Share on Pinterst"></a>
                <a class="share-icon share-email" target="_blank" href="mailto:?Subject=Jssor%20Slider&Body=Highly%20recommended%20jQuery%20Image%20Slider/Slideshow/Carousel/Gallery/Banner%20javascript+html%20TOUCH%20SWIPE%20Responsive%20http://jssor.com" title="Share by Email"></a>
            </div>
            <!-- Example to add fixed static share buttons in slider END -->
        </div>
                
        <!-- Bullet Navigator Skin Begin -->
        <style>
            /* jssor slider bullet navigator skin 21 css */
            /*
            .jssorb21 div           (normal)
            .jssorb21 div:hover     (normal mouseover)
            .jssorb21 .av           (active)
            .jssorb21 .av:hover     (active mouseover)
            .jssorb21 .dn           (mousedown)
            */
            .jssorb21 div, .jssorb21 div:hover, .jssorb21 .av
            {
                background: url(images/b21.png) no-repeat;
                overflow:hidden;
                cursor: pointer;
            }
            .jssorb21 div { background-position: -5px -5px; }
            .jssorb21 div:hover, .jssorb21 .av:hover { background-position: -35px -5px; }
            .jssorb21 .av { background-position: -65px -5px; }
            .jssorb21 .dn, .jssorb21 .dn:hover { background-position: -95px -5px; }
        </style>
        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb21" style="position: absolute; bottom: 26px; left: 6px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 19px; HEIGHT: 19px; text-align:center; line-height:19px; color:White; font-size:12px;"></div>
        </div>
        <!-- Bullet Navigator Skin End -->

        <!-- Arrow Navigator Skin Begin -->
        <style>
            /* jssor slider arrow navigator skin 21 css */
            /*
            .jssora21l              (normal)
            .jssora21r              (normal)
            .jssora21l:hover        (normal mouseover)
            .jssora21r:hover        (normal mouseover)
            .jssora21ldn            (mousedown)
            .jssora21rdn            (mousedown)
            */
            .jssora21l, .jssora21r, .jssora21ldn, .jssora21rdn
            {
            	position: absolute;
            	cursor: pointer;
            	display: block;
                background: url(images/a21.png) center center no-repeat;
                overflow: hidden;
            }
            .jssora21l { background-position: -3px -33px; }
            .jssora21r { background-position: -63px -33px; }
            .jssora21l:hover { background-position: -123px -33px; }
            .jssora21r:hover { background-position: -183px -33px; }
            .jssora21ldn { background-position: -243px -33px; }
            .jssora21rdn { background-position: -303px -33px; }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora21l" style="width: 55px; height: 55px; top: 123px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora21r" style="width: 55px; height: 55px; top: 123px; right: 8px">
        </span>
        <!-- Arrow Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">javascript</a>
    </div>
    <!-- Jssor Slider End -->
    
   
   <div id="slide_fixed">
   <img src="images/slide01_640.jpg"/>
   </div>
   
    
    
    <div class="home_container work_cloud">
    <div class="content">
        	
            <div class="slide_cloud_outer">
            	<div class="slide_cloud_inner" align="center">
                	<img src="images/webdesign_img.png"/>
                    <div class="cloud_head">WEB DESIGN & <br/> BUILD</div>
                    <p >Would you like a beautiful, effective website your company can be proud of? We design and develop engaging websites like this everyday.</p>
                    <div class="read_more"><a href="<?=getSeoUrl(array('pn'=>'service_detail.php','Type'=>'WEB'))?>" target="_blank" style="color:#039bac;">Read more <img src="images/arrow_blue.png" style="margin-bottom:-3px;"/></a> </div>	
                </div>
            </div>
            
            <div class="slide_cloud_outer">
            	<div class="slide_cloud_inner" align="center">
                	<img src="images/iMarketing_img.png"/>
                    <div class="cloud_head">INTERNET <br/>MARKETING	</div>
                    <p >Would you like more enquiries? With our leading SEO service we can drastically increase your search engine visibility, traffic and conversions.</p>
                    <div class="read_more"><a href="<?=getSeoUrl(array('pn'=>'service_detail.php','Type'=>'INTERNET'))?>" target="_blank" style="color:#039bac;">Read more <img src="images/arrow_blue.png" style="margin-bottom:-3px;"/></a> </div>
                </div>
            </div>
            
            <div class="slide_cloud_outer">
            	<div class="slide_cloud_inner" align="center">
                	<img src="images/mobile_img.png"/>
                    <div class="cloud_head">MOBILE & <br/>APP LAYOUTS</div>
                    <p >Are you missing out on mobile? If you don't have a mobile website or app, you are missing out on customers. Let us help you go mobile today.</p>
                    <div class="read_more"><a href="<?=getSeoUrl(array('pn'=>'service_detail.php','Type'=>'MOBILE'))?>" target="_blank" style="color:#039bac;">Read more <img src="images/arrow_blue.png" style="margin-bottom:-3px;"/> </a></div>
                </div>
            </div>
            
            <div class="slide_cloud_outer">
            	<div class="slide_cloud_inner" align="center">
                	<img src="images/visual_img.png"/>
                    <div class="cloud_head">VISUAL <br/>BRANDING</div>
                    <p >Need to stand out in the crowd? Our design team can update your branding and make the impact you want for your business</p>
                    <div class="read_more"><a href="<?=getSeoUrl(array('pn'=>'service_detail.php','Type'=>'VISUAL'))?>" target="_blank" style="color:#039bac;">Read more <img src="images/arrow_blue.png" style="margin-bottom:-3px;"/> </a></div>	
                </div>
            </div>
            	
        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
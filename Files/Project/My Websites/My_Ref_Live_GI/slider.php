<!-- use jssor.slider.min.js for release -->
<!-- jssor.slider.min.js = (jssor.js + jssor.slider.js) -->
<script type="text/javascript" src="js/jssor.js"></script>
<script type="text/javascript" src="js/jssor.slider.js"></script>
<script>
    jssor_slider1_starter = function (containerId) {
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
            $FillMode: 2,                                      
            $AutoPlay: true,                                    
            $AutoPlayInterval: 4000,                            
            $PauseOnHover: 1,                                  

            $ArrowKeyNavigation: true,   			           
            $SlideEasing: $JssorEasing$.$EaseOutQuint,         
            $SlideDuration: 800,                              
            $MinDragOffsetToSlide: 20,                        
            $SlideSpacing: 0, 					              
            $DisplayPieces: 1,                                 
            $ParkingPosition: 0,                              
            $UISearchMode: 1,                                  
            $PlayOrientation: 1,                               
            $DragOrientation: 1,                               

            $CaptionSliderOptions: {                           
                $Class: $JssorCaptionSlider$,                  
                $CaptionTransitions: _CaptionTransitions,      
                $PlayInMode: 1,                                
                $PlayOutMode: 3                                 
            },

            $BulletNavigatorOptions: {                                
                $Class: $JssorBulletNavigator$,                       
                $ChanceToShow: 2,                              
                $AutoCenter: 1,                                
                $Steps: 1,                                      
                $Lanes: 1,                                      
                $SpacingX: 8,                                  
                $SpacingY: 8,                                  
                $Orientation: 1                                 
            },

            $ArrowNavigatorOptions: {                       
                $Class: $JssorArrowNavigator$,              
                $ChanceToShow: 1,                               
                $AutoCenter: 2,                                 
                $Steps: 1                                       
            }
        };

        var jssor_slider1 = new $JssorSlider$(containerId, options);

        //responsive code begin
        //you can remove responsive code if you don't want the slider scales while window resizes
        function ScaleSlider() {
            var bodyWidth = document.body.clientWidth;
            if (bodyWidth)
                jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
            else
                $Jssor$.$Delay(ScaleSlider, 30);
        }

        ScaleSlider();
        $Jssor$.$AddEvent(window, "load", ScaleSlider);


        if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
            $Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
        }

    };
</script>


<div id="slider1_container" style="position: relative; margin: 0 auto; top: 0px; left: 0px; overflow: hidden; " >
    
    <!-- Slides Container -->
    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; overflow: hidden;" class="slide_ht">
        <div>
            <div class="container_fluid">
                <div class="slider_container">
                    <div class="slider1_left">
                        <h3>Our clients come to us because <br/> we offer amazing quality <br/> white cement based wallputty <br/> at unbeatable low prices.</h3>
                        <p><span>From</span> White Cement based Wall Putty, Tile Adesive, White Portland Cement, <br/> G-lose - Optimized Putty Additive  <br/> <span> all prices exclude delivery and VAT*.</span> </p>
                        <div>
                            <a href="<?=getSeoUrl(array('pn'=>'dealer.php'))?>"> <input type="button" class="slide1_btn bg-green" name="become_dealer" value="Become a Dealer" /> </a>
                            <a href="<?=getSeoUrl(array('pn'=>'contact.php'))?>"> <input type="button" class="slide1_btn bg-pink" name="order_sample" value="Order a Sample" /> </a>
                        </div>
                    </div>
                    <div class="slider1_right">
                        <img src="images/slide_img01.png" alt="Wall Putty" />
                    </div>
                </div>
            </div>
        </div>
       
        <!--
        <div>
            <div class="container_fluid">
                <div class="slider_container">
                    <div class="slider1_left">
                        <h3>Our clients come to us because <br/> we offer amazing quality <br/> white cement based wallputty <br/> at unbeatable low prices.</h3>
                        <p><span>From</span> White Cement based Wall Putty, Tile Adesive, White Portland Cement, <br/> G-lose - Optimized Putty Additive  <br/> <span> all prices exclude delivery and VAT*.</span> </p>
                        <div>
                            <input type="button" class="slide1_btn bg-green" name="become_dealer" value="Become a Dealer" />
                            <input type="button" class="slide1_btn bg-pink" name="order_sample" value="Order a Sample" />
                        </div>
                    </div>
                    <div class="slider1_right">
                        <img src="images/slide_img01.png" alt="Wall Putty" />
                    </div>
                </div>
            </div>
        </div>
		-->

        </div>
        <!-- Example to add fixed static share buttons in slider END -->
    </div>
            
    <!-- Bullet Navigator Skin Begin -->
    <style>
    
        #slider1_container, .slide_ht { width: 1910px; height: 600px; }
    
        @media screen and (min-width:1280px) and (max-width:1479px)
        {
            #slider1_container, .slide_ht { width: 1910px; height: 700px; }
        }
        @media screen and (min-width:1024px) and (max-width:1279px)
        {
            #slider1_container, .slide_ht { width: 1910px; height: 800px; }
        }
        
        @media screen and (min-width:960px) and (max-width:1023px)
        {
            #slider1_container, .slide_ht { width: 1910px; height: 850px; }
        }
        
        @media screen and (min-width:800px) and (max-width:959px)
        {
            #slider1_container, .slide_ht { width: 1910px; height: 950px; }
        }
        
        @media screen and (min-width:768px) and (max-width:799px)
        {
            #slider1_container, .slide_ht { width: 1910px; height: 980px; }
        }
        
        @media screen and (min-width:640px) and (max-width:767px)
        {
            #slider1_container, .slide_ht { width: 1910px; height: 1050px; }
        }
        
        @media screen and (min-width:480px) and (max-width:639px)
        {
            #slider1_container, .slide_ht { width: 1910px; height: 1100px; }
        }
        
        @media screen and (min-width:320px) and (max-width:479px)
        {
            #slider1_container, .slide_ht { width: 1910px; height: 1400px; }
        }

        .jssorb21 div, .jssorb21 div:hover, .jssorb21 .av { background: url(../img/b21.png) no-repeat; overflow:hidden; cursor: pointer; }
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
        .jssora21l, .jssora21r, .jssora21ldn, .jssora21rdn { position: absolute; cursor: pointer; display: block; background: url(../img/a21.png) center center no-repeat; overflow: hidden; }
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
<!-- Trigger -->

<script>
    jssor_slider1_starter('slider1_container');
</script>
<!-- Jssor Slider End -->

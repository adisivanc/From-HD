<?
	$PageUrlArr = explode('/',$_SERVER['SCRIPT_NAME']);
	$curpage=end($PageUrlArr);
?>


<div class="menu_container menu_pos_default">

<!--<div class="menubg_top <?=($curpage!='index.php')?'showcontent':'none'?>"><div class="content"> A School founded on LOVE for Children</div></div>-->     <!--<img src="images/header_text.jpg" alt="" />-->

<? if($curpage!='index.php'){ ?>
<div class="menubg_top"><div class="content"> A School founded on LOVE for Children</div></div>    
<? }else{ ?>
<div class="menubg_top" style="display:none;"><div class="content">A School founded on LOVE for Children </div></div>    
<? } ?>




<div class="content" style="position:relative">        

    <div class="logo"><a href="<?=getSeoUrl(array('pn'=>'index.php'))?>"><img src="images/logo.png" alt="Yellow Train" /></a></div>
    
    
    <!-- /Nav Starts -->
    
    <a href="https://www.facebook.com/yellowtrainschool" target="_blank" class="menufb"><img src="images/fb_icon1.png" alt="Facebook" title="Facebook" /></a>
    <div class="nav_menu_outer">
    <div class="wrapper">
        <div class="main">
        
                    
            <!-- Nav -->
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item nav_item_btm">
                        <a href="<?=getSeoUrl(array('pn'=>'index.php#slide1'))?>" class="<?=($curpage=='index.php')?'active':''?>">ABOUT</a>
                    </li>

                   <!-- <li class="nav-item" id="hide_lg">
                        <a href="admission.php">ADMISSION</a>
                    </li> -->

                      <li class="nav-item">
                        <a class="pointer <?=($curpage=='belief.php' || $curpage=='yt_grade_school.php' || $curpage=='teacher.php')?'active':''?>">GRADE CAMPUS <span class="caret"></span></a>
                    
                        <ul class="nav-submenu">
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'belief.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>Belief &amp; Values</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'yt_grade_school.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>The Campus</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'faq.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>FAQ</h2>
                                    </div>
                                </a>
                            </li>
                            <!--<li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'teacher.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>The Teacher</h2>
                                    </div>
                                </a>
                            </li>-->
                            
                        </ul>
                        
                    </li>
                    
                    <li class="nav-item">
                        <a class="pointer <?=($curpage=='philosophy.php')?'active':''?>">GARDEN CAMPUS <span class="caret"></span></a>
                    
                        <ul class="nav-submenu">
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'philosophy.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>The Philosophy</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'garden_campus.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>The Campus</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'garden_program.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>The Program</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'garden_teachers.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>The KG Teacher</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'garden_rhythm.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>The Rhythm</h2>
                                    </div>
                                </a>
                            </li>
                            
                        </ul>
                        
                    </li>
                    
                    <li class="nav-item">
                        <a class="pointer <?=($curpage=='yt_methodology.php' || $curpage=='curriculum.php' || $curpage=='yt_practices.php')?'active':''?>">THE PROGRAM <span class="caret"></span></a>
                        
                        <ul class="nav-submenu">
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'yt_methodology.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>Methodology</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'curriculum.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>Curriculum</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'yt_practices.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>YT - Practices</h2>
                                    </div>
                                </a>
                            </li>
                            <!--<li class="nav-submenu-item" id="menuitem_rhythm">
                                <a href="<?=getSeoUrl(array('pn'=>'yt_rhythm.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>YT - Rhythm</h2>
                                    </div>
                                </a>
                            </li>-->
                        </ul>
                        
                    </li>
                    <li class="nav-item">
                        <a class="pointer <?=($curpage=='videos.php' || $curpage=='funstop.php' || $curpage=='press.php')?'active':''?>">YT WORLD <span class="caret"></span></a>
                        
                        <ul class="nav-submenu">
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'videos.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>Videos</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'funstop.php','Type'=>'gallery'))?>">
                                    <div class="submenu_desc">
                                        <h2>Gallery &amp; Events</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'press.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>Press</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'contact.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>Contact Us</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'joinus.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>Join Us</h2>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        
                    </li>
                    <!--<li class="nav-item">
                        <a href="#">TEAM</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=getSeoUrl(array('pn'=>'funstop.php','Type'=>'events'))?>" class="<?=($curpage=='funstop.php')?'active':''?>">EVENTS</a>
                    </li>
                    <li class="nav-item">
                        <a href="#">BLOG</a>
                    </li>-->
                    
                    
                    
                    <li class="nav-item">
                        <a href="<?=getSeoUrl(array('pn'=>'admission.php'))?>" class="pointer <?=($curpage=='admission.php' )?'active':''?>">ADMISSION</a>
                        
                        <!--<ul class="nav-submenu">
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'contact.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>Contact Us</h2>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-submenu-item">
                                <a href="<?=getSeoUrl(array('pn'=>'joinus.php'))?>">
                                    <div class="submenu_desc">
                                        <h2>Join Us</h2>
                                    </div>
                                </a>
                            </li>
                        </ul> -->
                        
                    </li>
                    
                 </ul>
            </nav>
            <!-- /Nav -->
                    
        </div>
    </div>
    </div>
    
    <!-- /Nav Ends -->

</div>
</div>




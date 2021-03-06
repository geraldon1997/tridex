<?php
use App\Core\Request;

?>
<!doctype html>
<html lang="en">
  <head>
    <title><?= APP_NAME; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- carousel CSS -->
    <link rel="stylesheet" href="<?= ASSETS; ?>css/owl.carousel.min.css">
    <!--header icon CSS -->
    <link rel="icon" href="<?= ASSETS; ?>img/logo.png">
    <!-- animations CSS -->
    <link rel="stylesheet" href="<?= ASSETS; ?>css/animate.min.css">
    <!-- font-awsome CSS -->
    <link rel="stylesheet" href="<?= ASSETS; ?>css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= ASSETS; ?>css/bootstrap.min.css">
    <!-- mobile menu CSS -->
    <link rel="stylesheet" href="<?= ASSETS; ?>css/slicknav.min.css">
    <!--css animation-->
    <link rel="stylesheet" href="<?= ASSETS; ?>css/animation.css">
    <!--css animation-->
    <link rel="stylesheet" href="<?= ASSETS; ?>css/material-design-iconic-font.min.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="<?= ASSETS; ?>css/style.css">
    <!-- responsive CSS -->
    <link rel="stylesheet" href="<?= ASSETS; ?>css/responsive.css">

    <script src="<?= ASSETS; ?>js/jquery-2.2.4.min.js"></script>
    <script>
        const app_url = 'http://tridex.test/';
    </script>
    
  </head>
  <body>
  
    <!--header area start-->
    <div class="header-area wow fadeInDown header-absolate" id="nav" data-0="position:fixed;" data-top-top="position:fixed;top:0;" data-edge-strategy="set">
        <div class="container">
            <div class="row">
                <div class="col-4 d-block d-lg-none">
                    <div class="mobile-menu"></div>
                </div>
                
                <div class="col-4 col-lg-2">
                    <div class="logo-area">
                        <a href="<?= HOME; ?>"><img src="<?= ASSETS; ?>img/logo.png" alt="" style="height: 50px !important;"></a>
                    </div>
                </div>
                
                <div class="col-4 col-lg-8 d-none d-lg-block">
                    <div class="main-menu text-center">
                        <nav>
                            <ul id="slick-nav">
                            
                                <li><a class="scroll" href="<?= HOME; ?>">home</a></li>
                                <li><a class="scroll" href="<?= ABOUT; ?>">About</a></li>
                                <li><a class="scroll" href="<?= PAPER; ?>">White Paper</a></li>
                                
                                <li><a class="scroll" href="<?= PLANS; ?>">Plans</a></li>
                                <li><a class="scroll" href="<?= WAPSPEED; ?>">WapSpeed</a></li>
                                <li><a class="scroll" href="<?= TEAM; ?>">Team</a></li>
                                <li><a class="scroll" href="<?= APP; ?>">APP</a></li>
                                <li><a class="scroll" href="<?= WHY_US; ?>">Why Us</a></li>
                                
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-4 col-lg-2 text-right">
                    <a href="<?= SIGNUP; ?>" class="logibtn gradient-btn">get started</a>
                </div>
                <div id="google_translate_element" ></div>
            </div>
        </div>
    </div>
    <!--header area end-->
    

{{content}}


    <!--footer area start-->
    <div class="footera-area section-padding wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-footer">
                        <div class="logo-area footer">
                            <a href="#"><img src="<?= ASSETS; ?>img/logo.png" style="height: 50px !important;" alt=""></a>
                        </div>
                        <div class="space-20"></div>
                        <p>Tridex is a leading Cryptocurrency trading Group that utilizes innovative proprietary technologies to provide managed cryptocurrency trading services to yield higher profits.</p>
                        <div class="space-10"></div>
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <div class="single-footer">
                        <ul>
                            <li><a href="#about">About</a></li>
                            <!-- <li><a href="#token">Token Sale</a></li> -->
                            <li><a href="#plans">Plans</a></li>
                            <li><a href="#roadmap">WapSpeed</a></li>
                            <!-- <li><a href="#contact">Contact</a></li> -->
                        </ul>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="single-footer">
                        <ul>
                            <li><a href="#Paper">White Paper</a></li>
                            <li><a href="#team">Team</a></li>
                            <li><a href="#apps">APP</a></li>
                            <li><a href="#faq">Why Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-footer">
                        <p>Subscribe to our Newsletter</p>
                        <div class="space-20"></div>
                        <div class="footer-form">
                            <form action="#">
                                <input type="email" placeholder="Email Address">
                                <a style="cursor: pointer;" onclick="subscribeToNewsLetter();" class="gradient-btn subscribe">GO</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--footer area end-->

    <script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <!-- jquery 2.2.4 js-->
    <script src="<?= ASSETS; ?>js/jquery-2.2.4.min.js"></script>
    <!-- popper js-->
    <script src="<?= ASSETS; ?>js/popper.js"></script>
    <!-- carousel js-->
    <script src="<?= ASSETS; ?>js/owl.carousel.min.js"></script>
    <!-- wow js-->
    <script src="<?= ASSETS; ?>js/wow.min.js"></script>
    <!-- bootstrap js-->
    <script src="<?= ASSETS; ?>js/bootstrap.min.js"></script>\
    <!--skroller js-->
    <script src="<?= ASSETS; ?>js/skrollr.min.js"></script>
    <!--mobile menu js-->
    <script src="<?= ASSETS; ?>js/jquery.slicknav.min.js"></script>
    <!--particle s-->
    <script src="<?= ASSETS; ?>js/particles.min.js"></script>
    <!-- main js-->
    <script src="<?= ASSETS; ?>js/main.js"></script>
    <!-- forms js-->
    <script src="<?= ASSETS; ?>js/forms.js?v=1"></script>
    


    

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5fc96755920fc91564cd4199/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->



  </body>
</html>
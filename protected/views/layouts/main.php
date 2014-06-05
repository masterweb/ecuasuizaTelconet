<?php
//echo $_SERVER['HTTP_USER_AGENT'];
$IE6 = (ereg('MSIE 6', $_SERVER['HTTP_USER_AGENT'])) ? true : false;
$IE7 = (ereg('MSIE 7', $_SERVER['HTTP_USER_AGENT'])) ? true : false;
$IE8 = (ereg('MSIE 8', $_SERVER['HTTP_USER_AGENT'])) ? true : false;
$IE9 = (ereg('MSIE 9', $_SERVER['HTTP_USER_AGENT'])) ? true : false;

$navie = false;
if (($IE8 == 1)) {
   $navie = true;
} 
?>
<?php

//$seguros = Seguros::model()->findAll(array('order' => 'pos'));
$seguros = Seguros::model()->findAll(array('order' => 'categoria'));
$servicios = Servicios::model()->findAll();
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $mobile_agents = '!(tablet|pad|mobile|phone|symbian|android|ipod|ios|blackberry|webos)!i';
    if (preg_match($mobile_agents, $_SERVER['HTTP_USER_AGENT'])) {
        $mobile = true;
    } else {
        $mobile = false;
    }
}
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/validationEngine.jquery.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/css/bootstrap-responsive.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/fancybox/source/jquery.fancybox.css?v=2.1.4" type="text/css"/>               
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css"/>        
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css"/>
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/menudrop.css" type="text/css"/>
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.ico" type="image/x-icon" />
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.ico" type="image/x-icon">
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery.validate.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/functions.js"></script>
        <?php if ($navie == false && !$mobile): ?>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/menudrop.js"></script>
        <?php endif; ?>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
        <!-- Add fancyBox -->
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/fancybox/source/jquery.fancybox.pack.js?v=2.1.4"></script>
        <!-- Optionally add helpers - button, thumbnail and/or media -->
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                //alert('ready');
                $('.fancybox').fancybox();
                // slide toogle para menu responsive
                /*$('.menudrop a').on('click', function(){
                    $('.submenuec').hide();
                });*/
                <?php if($mobile): ?> 
                $('.has-sub').click(function(){
                    //alert('altura del elemento: '+h)
                    $(".submenuec").css('opacity','1');
                    $(this).next(".submenuec" ).slideToggle(500);
                    return false;
                });
                // submenu ley de transparencia
                $('.has-level').click(function(){
                    //alert('altura del elemento: '+h)
                    $(".sub-level").css('opacity','1');
                    $(this).next(".sub-level" ).slideToggle(500);
                    return false;
                });
                <?php endif; ?>
            });
        </script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php if ($mobile == false): ?>
            <!--Start of Zopim Live Chat Script-->
            <script type="text/javascript">
                window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
                        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
                            _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
                    $.src='//v2.zopim.com/?1yrsDtbpeh47BVNtjoMUIa87K9yIfRl0';z.t=+new Date;$.
                        type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
            </script>
            <!--End of Zopim Live Chat Script-->
            

            <style>
                .form-signin{
                    width: 50%;
                    margin: 0 auto;
                }
                .data-register a{
                    color: #555555;
                    display: block;
                    text-align: right;
                }
                .data-register .link-register{
                    font-weight: bold;
                }
                .register-divisor{
                    background: none;
                    border-bottom: 1px dotted #4b9e44 !important;
                    border-top: none !important;
                }
                .form label{
                    font-size: 15px !important;
                }
                .popie{
                    font-size: 11px !important;
                    margin-left: 7px;
                }
                .uno, .dos, .tres, .cuatro{
                    position: absolute;
                    width: 170px;
                    z-index: 4000;
                }
                .uno{
                    left: 2px;
                    top: 150px;
                }
                .dos{
                    left: 160px;
                    top: 150px;
                }
                .tres{
                    left: 280px;
                    top: 150px;
                }
                .cuatro{
                    left: 400px;
                    top: 150px;
                }
                .modal-header{
                    border: none !important;
                }
                .title-pop{
                    color:#4C9E45; 
                    font-size: 28px;
                    line-height: 29px;
                    font-family: Arial;
                    font-weight: bold;
                    letter-spacing: -1px;
                    margin-top: -15px;
                    text-align: left !important;
                }
            </style>
        <?php else: ?>
            <style>
                .has-level{
                    color: #4A9D43 !important;
                }
                .sub-level a{
                    font-size: 13px !important;
                    color: #9E989A !important;
                }
                .sub-level{
                    border-bottom: 1px solid #4A9D43;
                }
            </style>
        <?php endif; ?>
        <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
    </head>

    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="nav-collapse collapse">

                        <?php if (Yii::app()->user->isEditorUser()): ?>
                            <?php
                            $this->widget('zii.widgets.CMenu', array(
                                'htmlOptions' => array("class" => "nav", "id" => "nav-top-menu"),
                                'items' => array(
                                    array('label' => 'Nosotros', 'url' => array('/site/nosotros', 'id' => 5)),
                                    array('label' => 'Contáctanos', 'url' => array('/site/contactenos')),
                                    array('label' => 'Cerrar Sesión', 'url' => array('/site/logout'))
                                ),
                            ));
                            ?>
                        <?php else: ?>
                            <?php
                            $this->widget('zii.widgets.CMenu', array(
                                'htmlOptions' => array("class" => "nav", "id" => "nav-top-menu"),
                                'items' => array(
                                    array('label' => 'Nosotros', 'url' => array('/site/nosotros', 'id' => 5)),
                                    array('label' => 'Contáctanos', 'url' => array('/site/contactenos'))
                                ),
                            ));
                            ?>
                        <?php endif; ?>
                        <div class="navbar-text pull-right">
                            <div class="span2" id="reference">
                                <p>Síguenos en:</p> 
                                <ul class="list-unstyled">
                                    <li><a href="https://twitter.com/EcuaSuiza" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/header/twitter.png"/></a></li>
                                    <li><a href="http://www.youtube.com/user/EcuaSuiza" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/header/youtube.png"/></a></li>
                                </ul>
                            </div>
                        </div> 
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container" id="page">
            <div class="row">
                <div class="span6">
                    <a href="<?php echo Yii::app()->createUrl('/site/index'); ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/header/logo.jpg" id="logo"/></a>
                </div>
                <div class="span3 offset1">
                    <form id="custom-search-form" class="form-search form-horizontal pull-right" method="post" action="<?php echo Yii::app()->createUrl('site/busqueda'); ?>">
                        <div class="input-append span3">
                            <button type="submit" class="btn btn-ecu icon_buscador"><i class="icon-search icon-search-ecu"></i></button>
                            <input type="text" class="search-query search-ecu" placeholder="Buscar" id="txt_search" name="buscar">
                        </div>
                    </form>
                </div>
            </div>
            <div class="navbar">
                <div class="navbar-inner navbar-ecu">
                    <?php
                    $categorias = Categorias::model()->findAll(array('order' => 'pos'));
                    ?>
                    <ul class="nav nav-principal menudrop" id="menudrop">
                        <?php foreach ($categorias as $cat) { ?>
                            <li><a href="#" class="no-link has-sub"><?php echo $cat['title_categoria']; ?></a>
                                <?php echo $this->getSubSecciones($cat['id']); ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="span11" id="divisor-up-menu">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/line_menu.png"/> 
                </div>
            </div>
            <!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>
            <div class="clear"></div>
            <div class="row">
                <div class="span11" id="divisor-up">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/divisor_up.gif"/> 
                </div>
            </div>
            <div id="footer">
                <div class="row">
                    <div class="span7">
                        <ul class="access-links">
                            <li><a href="<?php echo Yii::app()->createUrl('site/index') ?>">Inicio</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('seguros/individuales') ?>">Seguros Individuales</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('seguros/empresariales') ?>">Seguros Empresariales</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('/servicios/'); ?>">Servicios</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('/informacion/info'); ?>">Información</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('site/nosotros', array('id' => 5)); ?>">Nosotros</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('site/contactenos/'); ?>">Contáctanos</a></li>
                        </ul>
                        <p class="copy-pbx">Atención a Nivel Nacional PBX: 3731515</p>
                        <p class="copy">Copyright © 2014 EcuaSuiza.</p>
                    </div>
                    <div class="span3" id="social-twitter">
                        <div class="twitter-big">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/footer/twitter_big.png" width="75%"/>
                        </div>
                        <div class="list-twitter">
                            <a class="twitter-timeline" data-widget-id="446696202617110528" data-chrome="noheader nofooter transparent" data-tweet-limit="" data-link-color="#4b9e44" data-border-color="#FFFFFF" lang="EN" data-theme="" height="150" width="220" data-screen-name="EcuaSuiza" data-show-replies="" data-aria-polite="assertive" > </a> 
                            <!-- Thank you for using "TweetsDecoder" <a href="//tweetsdecoder.com"> @TweetsDecoder.COM</a>--> 
                            <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                        <!--                        <div class="span2" id="reference2">
                                                    <p>Síguenos en:</p> 
                                                    <ul class="list-unstyled">
                                                        <li><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/header/twitter.png"/></a></li>
                                                        <li><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/header/youtube.png"/></a></li>
                                                    </ul>
                                                </div>-->
                    </div>
                </div>

            </div><!-- footer -->

        </div><!-- page -->
        <div id="inline1" style="display: none; width: 500px;">

            <div class="form">
                <form class="form-signin" action="/index.php/admin/loginEditor" method="post" id="form-login">
                    <div id="error-login" style="color:#4b9e44"></div>
                    <div class="row">
                        <label for="LoginForm_Usuario">Usuario:</label>
                        <input name="LoginForm[username]" id="LoginForm_username" type="text">
                    </div>
                    <div class="row">
                        <label for="LoginForm_Password">Contraseña:</label>
                        <input name="LoginForm[password]" id="LoginForm_password" type="password">
                    </div>
                    <div class="row submit">
                        <input type="submit" name="yt0" value="Ingresar" id="ingresar">
                    </div>
                </form>
                <hr class="register-divisor">
                <div class="data-register">
<!--                    <a href="<?php echo Yii::app()->createUrl('user/create') ?>" class="link-register">Registrarme</a>-->
                    <a href="<?php echo Yii::app()->createUrl('admin/remember') ?>" style="text-decoration: underline;">*No recuerdo mis datos</a>
                </div>
            </div>
        </div>
       
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 10%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div
            <div class="row">
                <div class="span2" style="margin-left: 10px;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/ico_popup.png" style="float:left;"/>
                </div>
                <div class="span4">
                    <div class="modal-body" style="float:left; position: relative;height: 120px;">
                        <h4 class="title-pop">Disfruta tu experiencia al máximo actualizando tu navegador<h4>
                                
                    </div>
                </div>
                <div class="row" class="popupie">
                    <div class="uno"><a href="http://windows.microsoft.com/es-419/internet-explorer/ie-11-worldwide-languages" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/img_105.jpg" style="margin-left: 40px;"/><span class="popie">Internet Explorer 11</span></a></div>
                    <div class="dos"><a href="http://www.google.com/intl/es-419/chrome/browser/beta.html" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/img_99.jpg" style="margin-left: 40px;"/><span class="popie">Chrome 35</span></a></div>
                    <div class="tres"><a href="https://www.mozilla.org/es-ES/firefox/new/" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/img_107.jpg" style="margin-left: 40px;"/><span class="popie">Firefox 28</span></a></div>
                    <div class="cuatro"><a href="http://www.opera.com/es-419/computer/windows" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/img_102.jpg" style="margin-left: 40px;"/><span class="popie">Opera 21</span></a></div>
                </div>
            </div>
        <div id="myModal2" style="display: none;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div
            <div class="row">
                <div class="span2" style="margin-left: 10px;">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/ico_popup.png" style="float:left;"/>
                </div>
                <div class="span4">
                    <div class="modal-body" style="float:left;" >
                        <h4 style="color:#4C9E45; font-size: 28px;
line-height: 29px;
font-family: Arial;
font-weight: bold;
letter-spacing: -1px;">Disfruta tu experiencia al máximo actualizando tu navegador<h4>
                                <div class="row" class="popupie">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/img_105.jpg" style="margin-left: 40px;"/>Internet Explorer 11
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/img_99.jpg" style="margin-left: 40px;"/>Chrome 35
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/img_107.jpg" style="margin-left: 40px;"/>Firefox 28
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/img_102.jpg" style="margin-left: 40px;"/>Opera 21
                
                
                
            </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    var menudrop=new menudrop.dd("menudrop");
    menudrop.init("menudrop","menuhover");
    $('.icon_buscador').click(function()
    {
        sendSearch();
    });
    
    $("#txt_search").keypress(function(event) {
        if(event.which == 13)
            sendSearch(); 
    });
    //$( "#seccion7" ).mouseover(function() {
    //    $( ".juiciocrudo" ).show();
    //});
    //$( "#seccion7" ).mouseout(function() {
    //    $( ".juiciocrudo" ).hide();
    //});
    
    function sendSearch()
    {
        var txt = $('#txt_search').val();
        if(txt != "")
        {
            var url =  "<?php echo Yii::app()->createUrl('site/busqueda'); ?>";
            url += "/" + txt;
            document.location.href = url;
        }
    }
</script>

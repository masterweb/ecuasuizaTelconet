<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/nivoslider/nivo-slider.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/assets/nivoslider/jquery.nivo.slider.pack.js"></script>

<?php if (!Yii::app()->user->isEditorUser()): ?>
    <script  type="text/javascript">
        $(document).ready(function () {
            //            $.fancybox({
            //                'href': '#divFancy'
            //            });
        });
    </script>

<?php endif; ?>    

<?php
$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$articulo = Articulos::model()->findByAttributes(array('id_articulos' => $id));
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links' => array(
        'Información',
        $articulo['title'],
    ),
    'homeLink' => CHtml::link('Inicio', Yii::app()->homeUrl),
));
?>
<style>
    .fancybox-opened{
        background: #ffffff !important;
        width: 40% !important;
    }
    .fancybox-inner{
        width: 100% !important;
    }
    .form-signin{
        width: 50%;
        margin: 0 auto;
    }
</style>
<div class="row">
    <div class="span8 ieframe" id="cont-hogar">
        <div class="hogar-title">
            <h2><?php echo $articulo['title']; ?></h2>
        </div>
        <div class="clear"></div>
        <div>
            <?php echo $articulo['contenido']; ?>
        </div>
        
        <br>
        <?php // LINKS DE DESCARGA O ACCORDION CON PDFS ------------------------------------
        $criteria = new CDbCriteria(array(
                    'condition' => "id_articulo='{$articulo['id_articulos']}' AND titulo_cat <> ''",
                    'group' => 'titulo_cat'
                ));
        $criteria2 = new CDbCriteria(array(
                    'condition' => "id_articulo='{$articulo['id_articulos']}'",
                    'order' => 'name_real ASC'
                ));
        $countPdf = Pdf::model()->count($criteria);
        //echo $countPdf;
        if ($countPdf > 0) {
            
            $pdf = Pdf::model()->findAll($criteria2);
            $cat = Pdf::model()->findAll($criteria);
            $counter = 1; ?>
                <div class="descargas">
                <div class="accordion" id="accordion<?php echo $counter; ?>">
            <?php foreach ($cat as $value) { ?>
                    <?php if($counter <= $countPdf ){ ?>
                    
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-parent="#accordion2" data-toggle="collapse" href="#collapse<?php echo $counter; ?>"><?php echo $value['titulo_cat']; ?> </a>
                            </div>
                            <div class="accordion-body collapse" id="collapse<?php echo $counter; ?>">
                                <div class="accordion-inner">
                                    <ul>
                                        <?php $criteriaAccordion = new CDbCriteria(array(
                                            'condition' => "titulo_cat='{$value['titulo_cat']}'"
                                        ));
                                        $pdfAcc = Pdf::model()->findAll($criteriaAccordion);    
                                        ?>
                                        <?php foreach ($pdfAcc as $value) { ?>
                                            <li>
                                                <!--<a href="<?php echo Yii::app()->request->baseUrl; ?>/uploads/pdf/<?php echo $value['pdf'] ?>" target="_blank">-->
                                                <!-- Poner link de ecuasuiza de nuevo -->
                                                        <a href="http://166.78.229.104/ecuasuiza/uploads/pdf/<?php echo $value['pdf'] ?>" target="_blank">
                                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/icon_pdf.png"><?php echo $value['name'] ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul></div>
                            </div>
                        </div>
                    
                   <?php } ?> 
           <?php   $counter++; } ?> 
                </div> 
                </div>  
         <?php } else { 
            $pdf = Pdf::model()->findAll($criteria2);
            $data = '<div class="descargas">
                     <ul>';
            foreach ($pdf as $value) {
//                $data .= '<li>
//                            <a href="' . Yii::app()->request->baseUrl . '/uploads/pdf/' . $value['pdf'] . '" target="_blank">
//                            <img src="' . Yii::app()->request->baseUrl . '/img/hogar/icon_pdf.png">' . $value['name'] . '</a>
//                         </li>';
                $data .= '<li>
                            <a href="http://166.78.229.104/ecuasuiza/uploads/pdf/' . $value['pdf'] . '" target="_blank">
                            <img src="' . Yii::app()->request->baseUrl . '/img/hogar/icon_pdf.png">' . $value['name'] . '</a>
                         </li>';
            }
            $data .= '</ul></div>';
        }
        echo $data;
        
        ?>
    </div>
    <div class="span2">
        <div class="btn-cotizar">
            <a href="<?php echo Yii::app()->createUrl('site/contactenos') ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/contactenos.jpg"/></a>
            <!--<a href="<?php echo Yii::app()->createUrl('cotizador/cotizador') ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/cotizar.jpg"/></a>-->
        </div>
    </div>
</div>
<div class="row">
    <div class="span11" id="divisor-down">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/line_down.png"/> 
    </div>
</div>
<div class="row cont-icos">
    <h4>OTROS PRODUCTOS ></h4>
    <div class="span2"><a href="<?php echo Yii::app()->createUrl('seguros/individuales', array('id' => 53)) ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/seg_auto.png"/></a></div>
    <div class="span2"><a href="<?php echo Yii::app()->createUrl('hogar/index') ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/seg_hogar.png"/></a></div>
    <div class="span2"><a href="<?php echo Yii::app()->createUrl('seguros/individuales', array('id' => 54)) ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/seg_vida.png"/></a></div>
    <div class="span2"><a href="<?php echo Yii::app()->createUrl('seguros/empresariales') ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/seg_empresarial.png"/></a></div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });

        $('.scrollup').click(function () {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });

    });
</script>

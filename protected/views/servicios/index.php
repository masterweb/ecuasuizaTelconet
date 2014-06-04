<?php
/* @var $this SiteController */
$id = 0;
//echo 'site url'.Yii::app()->request->baseUrl;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
$servicios = Servicios::model()->findByAttributes(array('id' => $id));
$this->pageTitle = Yii::app()->name;
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links' => array(
        'Reclamos',
        $servicios['title'],
    ),
    'homeLink' => CHtml::link('Inicio', Yii::app()->homeUrl),
));
?>
<?php if ($id == 0): ?><!-- CODIGO PARA PAGINA INTERNA DE SERVICIOS -->
    <div class="row">
        <div class="span11">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/servicios/banner_servicios.jpg"/>	
        </div>
    </div>
    <br>
    <div class="row empresarial">
        <div class="span3 serv">
            <ul>
                <li><a href="http://secure.ecuasuiza.ec/ecuasuiza/SoloPortal_Logon.asp" target="_blank">TRANSPORTE ONLINE</a></li>
            </ul>
        </div>
        <div class="span3 serv">
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('/site/suizamovil') ?>">SUIZA MÓVIL PLUS</a></li></ul>
        </div>
        <div class="span3 serv">
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('/servicios/index', array('id' => 6)); ?>">RECLAMOS</a></li></ul></div>
    </div>
<?php endif; ?><!-- FIN DE PAGINA DE SERVICIOS -->
<div class="row">
    <div class="span8 ieframe" id="cont-hogar">
        <!--            <div class="home-icon">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/icon_empresarial.png"/> 
                    </div>-->
        <div class="hogar-title">
            <h2><?php echo $servicios['title']; ?></h2>
        </div>
        <div class="clear"></div>
        <p><?php echo $servicios['desc_min']; ?></p>
        <div>
            <?php echo $servicios['contenido']; ?>
            <?php
            // LINKS DE DESCARGA O ACCORDION CON PDFS ------------------------------------
            $criteria = new CDbCriteria(array(
                        'condition' => "id_articulo='{$servicios['id']}' AND titulo_cat <> ''",
                        'group' => 'titulo_cat'
                    ));
            $criteria2 = new CDbCriteria(array(
                        'condition' => "id_articulo='{$servicios['id']}'",
                        'order' => 'name_real ASC'
                    ));
            $countPdf = Pdf::model()->count($criteria);
            //echo $countPdf;
            if ($countPdf > 0) {

                $pdf = Pdf::model()->findAll($criteria2);
                $cat = Pdf::model()->findAll($criteria);
                $counter = 1;
                ?>
                <div class="descargas">
                    <div class="accordion" id="accordion<?php echo $counter; ?>">
                        <?php foreach ($cat as $value) { ?>
                            <?php if ($counter <= $countPdf) { ?>

                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle" data-parent="#accordion2" data-toggle="collapse" href="#collapse<?php echo $counter; ?>"><?php echo $value['titulo_cat']; ?> </a>
                                    </div>
                                    <div class="accordion-body collapse" id="collapse<?php echo $counter; ?>">
                                        <div class="accordion-inner">
                                            <ul>
                                                <?php
                                                $criteriaAccordion = new CDbCriteria(array(
                                                            'condition' => "titulo_cat='{$value['titulo_cat']}'"
                                                        ));
                                                $pdfAcc = Pdf::model()->findAll($criteriaAccordion);
                                                ?>
                                                <?php foreach ($pdfAcc as $value) { ?>
                                                    <li>
                                                        <!--<a href="<?php echo Yii::app()->request->baseUrl; ?>/uploads/pdf/<?php echo $value['pdf'] ?>" target="_blank">-->
                                                        <a href="http://166.78.229.104/ecuasuiza/uploads/pdf/<?php echo $value['pdf'] ?>" target="_blank">
                                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/icon_pdf.png"><?php echo $value['name'] ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul></div>
                                    </div>
                                </div>

                            <?php } ?> 
                            <?php $counter++;
                        }
                        ?> 
                    </div> 
                </div>  
                <?php
            } else {
                $pdf = Pdf::model()->findAll($criteria2);
                $data = '<div class="descargas">
                     <ul>';
                foreach ($pdf as $value) {
                    $data .= '<li>
                            <a href="http://166.78.229.104/ecuasuiza/uploads/pdf/' . $value['pdf'] . '" target="_blank">
                            <img src="' . Yii::app()->request->baseUrl . '/img/hogar/icon_pdf.png">' . $value['name'] . '</a>
                         </li>';
                }
                $data .= '</ul></div>';
            }
            echo $data;
            ?>    

            <!--            <h3 class="desc-title">Descargas:</h3>-->
            <?php if ($id != 0): ?><!-- SI NO ES PAGINA INTERNA DE SERVICIOS -->
                <?php
//                $criteria = new CDbCriteria(array(
//                            'condition' => "categoria='reclamos'",
//                            'order' => 'pos'
//                        ));
//
//                $pdf = Pdf::model()->findAll($criteria);
                ?>
    <?php //if ($pdf) {   ?>
                <!--                    <div class="descargas">
                                        <div class="accordion" id="accordion2">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                                        Documentos necesarios para la atención de un reclamo.
                                                    </a>
                                                </div>
                                                <div id="collapseOne" class="accordion-body collapse">
                                                    <div class="accordion-inner">
                                                        <ul>
                <?php
//                                            foreach ($pdf as $var) {
//                                                echo '<li><a href="/ecuasuiza/uploads/pdf/' . $var['pdf'] . '" target="_blank">
//                            <img src="' . Yii::app()->request->baseUrl . '/img/hogar/icon_pdf.png"/>' . $var['name'] . '</a></li>';
//                                            }
                ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                <?php //}  ?>
<?php endif; ?>
        </div>

    </div>
<?php if ($id != 0): ?>
        <div class="span2">
            <div class="btn-cotizar">
                <a href="<?php echo Yii::app()->createUrl('site/contactenos') ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/contactenos.jpg"/></a>
                <!--<a href="<?php echo Yii::app()->createUrl('cotizador/cotizador') ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/cotizar.jpg"/></a>-->
            </div>
        </div>
<?php endif; ?>
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

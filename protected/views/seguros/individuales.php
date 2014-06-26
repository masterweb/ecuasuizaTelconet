<?php
$id = 0;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
$seguros = Seguros::model()->findByAttributes(array('id' => $id));
//echo $seguros['id'];
$this->pageTitle = Yii::app()->name . '- Seguros Individuales - ' . $seguros['title'];
?>
<?php
$this->widget('zii.widgets.CBreadcrumbs', array(
    'links' => array(
        'Seguros Individuales',
        $seguros['title']
    ),
    'homeLink' => CHtml::link('Inicio', Yii::app()->homeUrl),
));
?>
<?php if ($id == 0): ?>
    <div class="row">
        <div class="span11">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/seguros/individuales.jpg"/>	
        </div>
    </div>
    <br>
    <div class="row empresarial">
        <div class="span3">
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('/seguros/individuales', array('id' => 53)) ?>">SUIZA AUTO</a></li>
             </ul>
        </div>
        <div class="span3">
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('/seguros/individuales', array('id' => 49)) ?>">SUIZA HOGAR</a></li>
              </ul>
        </div>
        <div class="span3">
            <ul>
                <li><a href="<?php echo Yii::app()->createUrl('/seguros/individuales', array('id' => 54)) ?>">SUIZA VIDA</a></li>
            </ul>
        </div>
    </div>  
<?php else: ?>
    <div class="row">
        <div class="span11">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/seguros/<?php echo $seguros['link_img']; ?>"/>	
        </div>
    </div>
    <div class="row">
        <div class="span8 ieframe" id="cont-hogar">
<!--            <div class="home-icon">
                <?php
                switch ($seguros['categoria']) {
                    case 'hogar':
                        echo '<img src="' . Yii::app()->request->baseUrl . '/img/hogar/icon_home.png"/>';
                        break;
                    case 'auto':
                        echo '<img src="' . Yii::app()->request->baseUrl . '/img/hogar/icon_auto.png"/>';
                        break;
                    case 'vida':
                        echo '<img src="' . Yii::app()->request->baseUrl . '/img/hogar/icon_vida.png"/>';
                        break;
                    case 'empresarial':
                        echo '<img src="' . Yii::app()->request->baseUrl . '/img/hogar/icon_empresarial.png"/>';
                        break;

                    default:
                        break;
                }
                ?>
            </div>-->
            <div class="hogar-title">
                <h2><?php echo $seguros['title']; ?></h2>
            </div>
            <div class="clear"></div>
            <p><?php echo $seguros['desc_min']; ?></p>
            <div>

                <?php echo $seguros['contenido']; ?>
                <?php // LINKS DE DESCARGA O ACCORDION CON PDFS ------------------------------------
                $criteria = new CDbCriteria(array(
                            'condition' => "id_articulo='{$seguros['id']}' AND titulo_cat <> ''",
                            'group' => 'titulo_cat'
                        ));
                $criteria2 = new CDbCriteria(array(
                            'condition' => "id_articulo='{$seguros['id']}'",
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
                                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/files/pdf/<?php echo $value['pdf'] ?>" target="_blank">
                                                        <!--<a href="http://166.78.229.104/ecuasuiza/uploads/pdf/<?php echo $value['pdf'] ?>" target="_blank">-->
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
//                        $data .= '<li>
//                                    <a href="' . Yii::app()->request->baseUrl . '/uploads/pdf/' . $value['pdf'] . '" target="_blank">
//                                    <img src="' . Yii::app()->request->baseUrl . '/img/hogar/icon_pdf.png">' . $value['name'] . '</a>
//                                 </li>';
                        $data .= '<li>
                            <a href="'.Yii::app()->request->baseUrl.'/files/pdf/' . $value['pdf'] . '" target="_blank">
                            <img src="' . Yii::app()->request->baseUrl . '/img/hogar/icon_pdf.png">' . $value['name'] . '</a>
                         </li>';
                    }
                    $data .= '</ul></div>';
                }
                echo $data;

                ?>
            </div>
        </div>
        <div class="span2">
            <div class="btn-cotizar">
                <a href="<?php echo Yii::app()->createUrl('site/contactenos') ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/contactenos.jpg"/></a>
                <?php
                switch ($id) {
                    case 53: // auto
//                        echo '<a href="' . Yii::app()->createUrl('cotizador/cotizadorinfo', array('tipo' => 'auto')) . '">
//                            <img src="' . Yii::app()->request->baseUrl . '/img/hogar/cotizar.jpg"/></a>';
                        break;
                    case 49: // hogar
//                        echo '<a href="' . Yii::app()->createUrl('cotizador/cotizadorinfo', array('tipo' => 'hogar')) . '">
//                            <img src="' . Yii::app()->request->baseUrl . '/img/hogar/cotizar.jpg"/></a>';
                        break;
                    case 54: // vida
//                        echo '<a href="' . Yii::app()->createUrl('cotizador/cotizadorinfo', array('tipo' => 'vida')) . '">
//                            <img src="' . Yii::app()->request->baseUrl . '/img/hogar/cotizar.jpg"/></a>';
                        break;

                    default:
                        break;
                }
                ?>
                <!--<a href="<?php echo Yii::app()->createUrl('cotizador/cotizador') ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/cotizar.jpg"/></a>-->
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="span11" id="divisor-down">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/line_down.png"/> 
    </div>
</div>
<?php if ($id != 0): ?>

    <div class="row cont-icos">
        <h4>OTROS PRODUCTOS ></h4>
        <?php
        switch ($seguros['id']) {
            case 49:
                $data = '<div class="span3"><a href="' . Yii::app()->createUrl('seguros/individuales', array('id' => 53)) . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_auto.png"/></a></div>
            <div class="span3"><a href="' . Yii::app()->createUrl('seguros/individuales', array('id' => 54)) . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_vida.png"/></a></div>
                <div class="span3"><a href="' . Yii::app()->createUrl('seguros/empresariales') . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_empresarial.png"/></a></div>';
                echo $data;
                break;
            case 53:
                $data = '<div class="span3"><a href="' . Yii::app()->createUrl('seguros/individuales', array('id' => 49)) . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_hogar.png"/></a></div>
                <div class="span3"><a href="' . Yii::app()->createUrl('seguros/individuales', array('id' => 54)) . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_vida.png"/></a></div>
            <div class="span3"><a href="' . Yii::app()->createUrl('seguros/empresariales') . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_empresarial.png"/></a></div>';
                echo $data;
                break;
            case 54:
                $data = '<div class="span3"><a href="' . Yii::app()->createUrl('seguros/individuales', array('id' => 53)) . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_auto.png"/></a></div>
                <div class="span3"><a href="' . Yii::app()->createUrl('seguros/individuales', array('id' => 49)) . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_hogar.png"/></a></div>
            <div class="span3"><a href="' . Yii::app()->createUrl('seguros/empresariales') . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_empresarial.png"/></a></div>';
                echo $data;
                break;
            case 'empresarial':
                $data = '<div class="span3"><a href="' . Yii::app()->createUrl('seguros/individuales', array('id' => 53)) . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_auto.png"/></a></div>
                <div class="span3"><a href="' . Yii::app()->createUrl('seguros/individuales', array('id' => 49)) . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_hogar.png"/></a></div>
            <div class="span3"><a href="' . Yii::app()->createUrl('seguros/individuales', array('id' => 54)) . '"><img src="' . Yii::app()->request->baseUrl . '/img/hogar/seg_vida.png"/></a></div>';
                echo $data;
                break;

            default:
                break;
        }
        ?>
    <!--    <div class="span3"><a href="<?php echo Yii::app()->createUrl('hogar/index') ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/seg_hogar.png"/></a></div>
        <div class="span3"><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/seg_auto.png"/></a></div>
        <div class="span3"><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/hogar/seg_vida.png"/></a></div>-->
    </div>
<?php endif; ?>

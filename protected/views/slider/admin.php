<?php
//if (!Yii::app()->user->isAdminUser()) {
//    $this->redirect($this->createUrl('admin/login'));
//}
?>
<?php
/* @var $this SliderController */
/* @var $model Slider */

$this->breadcrumbs = array(
    'Sliders' => array('index'),
    'Administrar',
);

$this->menu = array(
    array('label' => 'Listar Slider', 'url' => array('index')),
    array('label' => 'Crear Slider', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#slider-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style>
    input[type="text"]{
        padding: 0 !important;
    }
</style>
<!--<a href="<?php echo Yii::app()->createUrl('slider/create'); ?>"><button class="btn btn-primary" type="button">Crear Nuevo Slider</button></a>-->
<h4>Administrar Sliders</h4>


<?php echo CHtml::link('Busqueda Avanzada', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'slider-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        array(
            'name' => 'link',
            'type' => 'raw', //because of using html-code <br/>
            //call the controller method gridProduct for each row
            'value' => 'Util::getImageSlider($data)',
        ),
        'descripcion',
        //'activo',
        //'fecha',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update} {delete} {up} {down} ',
            'buttons' => array(
                'up' => array(
                    'label' => 'Subir',
                    'visible' => 'Util::minMaxPosSlider("MIN", $data->orden, "tbl_slider")',
                    'imageUrl' => Yii::app()->request->baseUrl . '/img/upBtn.png',
                    'url' => 'Util::getIdLink($data->id, $data->orden)',
                    'options' => array(
                        "class" => "up"
                    ),
                ),
                'down' => array(
                    'label' => 'Bajar',
                    'visible' => 'Util::minMaxPosSlider("MAX", $data->orden, "tbl_slider")',
                    'imageUrl' => Yii::app()->request->baseUrl . '/img/downBtn.png',
                    'url' => 'Util::getIdLink($data->id, $data->orden)',
                    'options' => array(
                        "class" => "down"
                    ),
                ),
            ),
        ),
    ),
));
?>
<script type="text/javascript">
    $(document).ready(function(){
        var url = "<?php echo Yii::app()->createUrl("slider/admin"); ?>";
        
        $(".up").live("click", function(){
            var id = $(this).attr("href").split("#")[1].split("-")[0];
            var posAct = $(this).attr("href").split("#")[1].split("-")[1];

            var idAnt = jQuery(this).closest('tr').prev().find('a.down').attr("href").split("#")[1].split("-")[0]
            var posAnt = jQuery(this).closest('tr').prev().find('a.down').attr("href").split("#")[1].split("-")[1];

            /*$.post('<?php echo Yii::app()->createUrl("slider/setposition"); ?>', {"idAct": id, "posAct":posAct, "idSig":idAnt, "posAnt":posAnt },
            function(data){
                if(data.exito){
                    $(location).attr('href', url);
                }
            });*/
            
            $.ajax({
                'url':'<?php echo Yii::app()->createUrl("slider/setposition"); ?>',
                data: {"idAct": id, "posAct":posAct, "idSig":idAnt, "posAnt":posAnt},
                type: 'post',
                success: function(data){
                    if(data == true){
                        $(location).attr('href', url);
                    }
                }
            });
        });
		
        $(".down").live("click", function(){
            var id = $(this).attr("href").split("#")[1].split("-")[0];
            var posAct = $(this).attr("href").split("#")[1].split("-")[1];

            var idSig = jQuery(this).closest('tr').next().find('a.up').attr("href").split("#")[1].split("-")[0]
            var posSig = jQuery(this).closest('tr').next().find('a.up').attr("href").split("#")[1].split("-")[1];

            /*$.post('<?php echo Yii::app()->createUrl("slider/setposition"); ?>', {"idAct": id, "posAct":posAct, "idSig":idSig, "posAnt":posSig },
            function(data){
                if(data.exito){
                    $(location).attr('href', url);
                }
            });*/
            
            $.ajax({
                'url':'<?php echo Yii::app()->createUrl("slider/setposition"); ?>',
                data: {"idAct": id, "posAct":posAct, "idSig":idSig, "posAnt":posSig},
                type: 'post',
                success: function(data){
                    if(data == true){
                        $(location).attr('href', url);
                    }
                }
            });

        });
    });
	
    function tryme(id){
        alert("click me!> "+id);
    }
</script>


<?php
if (!Yii::app()->user->isAdminUser()) {
    $this->redirect($this->createUrl('admin/login'));
}
?>
<?php
/* @var $this PdfController */
/* @var $model Pdf */

$this->breadcrumbs = array(
    'Pdfs' => array('index'),
    'Administrar',
);

$this->menu = array(
    //array('label'=>'List Pdf', 'url'=>array('index')),
    array('label' => 'Crear Pdf', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pdf-grid').yiiGridView('update', {
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
<a href="<?php echo Yii::app()->createUrl('pdf/create'); ?>"><button class="btn btn-primary" type="button">Subir pdf</button></a>
<h4>Administrador de Pdfs</h4>
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
    'id' => 'pdf-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        //'descripcion',
        'titulo_cat',
//        array(
//            'name' => 'id_articulo',
//            'type' => 'raw', //because of using html-code <br/>
//            //call the controller method gridProduct for each row
//            'value' => 'Util::getNameCategoria($data)',
//        ),
        'pdf',
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
        ),
    ),
));
?>

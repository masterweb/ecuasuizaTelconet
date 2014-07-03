<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs = array(
    'Images' => array('index'),
    'Administrar',
);
//
//$this->menu = array(
//    array('label' => 'List Image', 'url' => array('index')),
//    array('label' => 'Create Image', 'url' => array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#image-grid').yiiGridView('update', {
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
<a href="<?php echo Yii::app()->createUrl('image/create'); ?>"><button class="btn btn-primary" type="button">Subir imágen</button></a>
<?php if (Yii::app()->user->hasFlash('admin')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('admin'); ?>
    </div>
<?php endif; ?>
<h4>Manage Images</h4>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'image-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id_image',
        'name',
        //'descripcion',
        //'name_real',
        array(
            'name' => 'image',
            'type' => 'raw', //because of using html-code <br/>
            //call the controller method gridProduct for each row
            'value' => 'Util::getImageMultimediaLink($data)',
        ),
        'categoria',
        /*
          'title',
         */
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>

<h1>Agregar PDF</h1>
<?php if (Yii::app()->user->hasFlash('create')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('create'); ?>
    </div>
<?php endif; ?>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
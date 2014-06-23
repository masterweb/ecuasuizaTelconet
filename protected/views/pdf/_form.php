<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pdf-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'categoria'); ?>
		<?php echo $form->dropDownList($model,'categoria',
                        array('' => '---Seleccione una opción---',
                            '1' => 'Nosotros',
                            '2' => 'Contáctanos',
                            '3' => 'Seguros Individuales',
                            '4' => 'Seguros Empresariales',
                            '5' => 'Servicios',
                            '6' => 'Información',
                            '7' => 'Noticias'
                            )); ?>
		<?php echo $form->error($model,'categoria'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'subcategoria'); ?>
		<?php echo $form->dropDownList($model,'subcategoria',
                        array('' => '---Seleccione una opción---' )); ?>
		<?php echo $form->error($model,'categoria'); ?>
	</div>
        <div class="row" id="titulo-des-container">
                <label>Título Desplegable</label>
		<select id="titulo-desplegable" name="titulo-desplegable">
                    <option value="">--Seleccione--</option>
                    <option value="nuevo">Nuevo Desplegable</option>
                    <option value="ninguno">Ninguno</option>
                </select>
	</div>
        <div class="row" id="titulo-cat-field" style="display: none;">
		<?php echo $form->labelEx($model,'titulo_cat'); ?>
		<?php echo $form->textField($model,'titulo_cat',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'titulo_cat'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
        <div class="row" style="display: none;">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>
        
        <?php //if($model->pdf == ''): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'pdf'); ?>
	    <?php echo $form->FileField($model, 'pdf'); ?>
		<?php echo $form->error($model,'pdf'); ?>
	</div>
        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
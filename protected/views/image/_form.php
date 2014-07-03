<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'image-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>
        <div class="row">
		<?php echo $form->labelEx($model,'categoria'); ?>
		<?php echo $form->dropDownList($model,'categoria',
                        array('' => '---Seleccione una opción---',
                            'Nosotros' => 'Nosotros',
                            'Contactanos' => 'Contáctanos',
                            'Seguros Individuales' => 'Seguros Individuales',
                            'Seguros Empresariales' => 'Seguros Empresariales',
                            'Servicios' => 'Servicios',
                            'Informacion' => 'Información',
                            'Noticias' => 'Noticias'
                            )); ?>
		<?php echo $form->error($model,'categoria'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
	    <?php echo $form->FileField($model, 'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	  <fieldset>
 	<legend><b>SEO:</b></legend>
    <div class="row">
		<?php echo $form->labelEx($model,'alt'); ?>
		<?php echo $form->textField($model,'alt',array('size'=>60,'maxlength'=>100)); ?> 
		<?php echo $form->error($model,'alt'); ?>
	</div>
    
     <div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?> 
		<?php echo $form->error($model,'title'); ?>
	</div>
    
    </fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
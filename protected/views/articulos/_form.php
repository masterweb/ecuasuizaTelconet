<?php
if (!Yii::app()->user->isAdminUser()) {
    $this->redirect($this->createUrl('admin/login'));
}
?>
<?php if (isset($_GET['categoria'])): $categoriaSeccion = $_GET['categoria']; ?>
<?php endif; ?>
<script src="<?php echo Yii::app()->baseUrl . '/ckeditor/ckeditor.js'; ?>"></script>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'articulos-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>

    <p class="note">Campos con <span class="required">*</span> son requeridos.</p>

    <?php echo $form->errorSummary($model); ?>
    <?php if($categoriaSeccion == 'news'): ?>
    <div class="row" id="thumb-noticia">
        <?php echo $form->labelEx($model, 'thumb'); ?>
        <select id="imageSelect" name="Articulos[has_image]">
            <option value="Si">Si</option>
            <option value="No" selected>No</option>
        </select>
        <?php echo $form->error($model, 'thumb'); ?>
    </div>
    <?php endif; ?>
    <div class="control-group" id="upload-file">
        <label class="control-label" for="inputPassword">Seleccione imágen</label>
        <div class="controls">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-preview thumbnail" style="width: 310px; height: 150px;" id="results">
                </div>
                <div>
                    <span class="btn btn-file" id="btnEscoger">
                        <span class="fileupload-new">Seleccionar imágen</span>
                        <span class="fileupload-exists">Cambiar</span>
                        <input type="file" name="Articulos[thumb]" class="validate[required] text-input"/>
                        <?php echo $form->FileField($model, 'thumb'); ?>
                    </span>
                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remover</a>
                </div>
                <input type="hidden" id="categoria" name="categoria" value="<?php
                        if (isset($_GET['categoria'])) {
                            echo $_GET['categoria'];
                        }
                        ?>"/>
                <input type="hidden" id="tipo" name="tipo" value="' . $tipo . '"/>
            </div>
        </div>
    </div>
    <?php if($categoriaSeccion == 'news'): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'galeria'); ?>
        <?php
        echo $form->dropDownList($model, 'galeria', array('' => '---Seleccione una opción---',
            '1' => 'Si',
            '0' => 'No'
                ), array('id' => 'galeria-select'));
        ?>
        <?php echo $form->error($model, 'galeria'); ?>
    </div>
    <?php endif; ?>
    <div class="row" id="fields-galeria" style="display: none;">
        <?php echo $form->labelEx($model, 'link_string'); ?>
        <?php
        $this->widget('CMultiFileUpload', array(
            'model' => $model,
            'attribute' => 'link_string',
            'accept' => 'jpg|gif|png',
            'name' => 'photos',
            'options' => array(
            // 'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
            // 'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
            // 'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
            // 'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
            // 'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
            // 'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
            ),
            'denied' => 'File is not allowed',
            'max' => 5, // max 10 files
        ));
        ?>
    </div>
    <div id="wrapper-fields" style="display: none;">
        <a href="#" id="AddMoreFileBox" class="btn btn-info">Add More Field</a>
        <div id="InputsWrapper">
            <div><input type="text" name="mytext[]" id="field_1" value="Text 1"><a href="#" class="removeclass">&times;</a></div>
        </div>
    </div>
    <?php if($categoriaSeccion == 'informacion'):?>
    <div class="row">
        <?php echo $form->labelEx($model, 'principal'); ?>
        <?php
        echo $form->dropDownList($model, 'principal', array('' => '---Seleccione una opción---',
            '1' => 'Principal',
            '0' => 'Secundario'
        ));
        ?>
<?php echo $form->error($model, 'principal'); ?>
    </div>
    <?php endif; ?>
    <div class="row" id="selec-menu2" style="display: none;">
        <label>Submenú</label>
        <select id="menus-id" name="Articulos[id_menu_principal]">
            <option value="">--Seleccione un menú--</option>
        </select>
    <?php echo $form->error($model, 'id_menu_padre'); ?>
    </div>
        <?php //endif; ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 150)); ?>
<?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'desc_min'); ?>
<?php echo $form->textArea($model, 'desc_min', array('rows' => 3, 'cols' => 20)); ?>
        <?php echo $form->error($model, 'desc_min'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contenido'); ?>
        <?php //echo $form->textArea($model, 'contenido', array('rows' => 6, 'cols' => 50, 'class' => 'textarea2', 'style' => 'height:400px;'));    ?>
        <?php $this->widget('application.extensions.TheCKEditor.TheCKEditorWidget', array(
            'model' => $model, # Data-Model (form model)
            'attribute' => 'contenido', # Attribute in the Data-Model
            'height' => '400px',
            'width' => '100%',
            'toolbarSet' => 'Full', # EXISTING(!) Toolbar (see: ckeditor.js)
            'ckeditor' => Yii::app()->basePath . '/../ckeditor/ckeditor.php',
            # Path to ckeditor.php
            'ckBasePath' => Yii::app()->baseUrl . '/ckeditor/',
            # Relative Path to the Editor (from Web-Root)
            'css' => Yii::app()->baseUrl . '/css/index.css',
            # Additional Parameters
            'config' => array('toolbar' => "Full",
                "filebrowserImageUploadUrl" => Yii::app()->baseUrl . '/kcfinder/upload.php?type=images',
                "filebrowserBrowseUrl" => Yii::app()->baseUrl . '/kcfinder/browse.php?type=files',
                "filebrowserImageBrowseUrl" => Yii::app()->baseUrl . '/kcfinder/browse.php?type=images',
                "filebrowserFlashBrowseUrl" => Yii::app()->baseUrl . '/kcfinder/browse.php?type=flash',)
        ));
        ?>
    </div>
    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
    </div>

<?php $this->endWidget(); ?>
    <script type="text/javascript">
        //CKEDITOR.replace( 'editor1');
        // resolved link with pdfs
    </script>

</div><!-- form -->
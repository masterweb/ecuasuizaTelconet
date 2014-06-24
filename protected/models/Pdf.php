<?php

/**
 * This is the model class for table "tbl_pdf".
 *
 * The followings are the available columns in table 'tbl_pdf':
 * @property integer $id
 * @property string $name
 * @property string $descripcion
 * @property string $name_real
 * @property string $categoria
 * @property string $subcategoria
 * @property string $keyword
 * @property string $pdf
 * @property string $activo
 * @property integer $pos
 */
class Pdf extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_pdf';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, categoria, subcategoria', 'required'),
            array('pos', 'numerical', 'integerOnly' => true),
            array('name, name_real, pdf', 'length', 'max' => 255),
            array('categoria, keyword', 'length', 'max' => 150),
            array('subcategoria', 'length', 'max' => 100),
            array('activo', 'length', 'max' => 15),
            array('pdf','file', 'types'=>'pdf', 'allowEmpty'=>false),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, descripcion, name_real, categoria, subcategoria, titulo_cat, pdf, activo, pos,id_articulo', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Nombre',
            //'descripcion' => 'Descripción',
            'name_real' => 'Name Real',
            'categoria' => 'Categoría',
            'subcategoria' => 'Menú',
            'keyword' => 'Palabra Clave',
            'titulo_cat' => 'Título Categoría',
            'pdf' => 'Pdf',
            'activo' => 'Activo',
            'pos' => 'Pos',
            'id_articulo' => 'Id Artículo',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('descripcion', $this->descripcion, true);
        $criteria->compare('name_real', $this->name_real, true);
        $criteria->compare('categoria', $this->categoria, true);
        $criteria->compare('subcategoria', $this->subcategoria, true);
        $criteria->compare('keyword', $this->keyword, true);
        $criteria->compare('pdf', $this->pdf, true);
        $criteria->compare('id_articulo', $this->id_articulo, true);
        $criteria->compare('titulo_cat', $this->titulo_cat, true);
        $criteria->compare('activo', $this->activo, true);
        $criteria->compare('pos', $this->pos);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pdf the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}

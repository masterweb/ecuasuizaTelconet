<?php

/**
 * This is the model class for table "tbl_image".
 *
 * The followings are the available columns in table 'tbl_image':
 * @property integer $id_image
 * @property string $name
 * @property string $descripcion
 * @property string $name_real
 * @property string $image
 */
class Image extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Image the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_image';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, title,categoria,alt', 'required'),
            array('name, name_real, image', 'length', 'max' => 250),
            array('image', 'file', 'types' => 'png,jpg,gif'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_image, name, descripcion, name_real, image, categoria', 'safe', 'on' => 'search'),
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
            'id_image' => 'Id Image',
            'name' => 'Nombre',
            'descripcion' => 'Descripcion',
            'name_real' => 'Nombre Real',
            'image' => 'Image',
            'alt' => 'ALT Imagen',
            'title' => 'Titulo Imagen',
            'categoria' => 'Categoría',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_image', $this->id_image);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('descripcion', $this->descripcion, true);
        $criteria->compare('name_real', $this->name_real, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('categoria', $this->categoria, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}
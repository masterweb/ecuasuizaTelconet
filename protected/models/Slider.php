<?php

/**
 * This is the model class for table "tbl_slider".
 *
 * The followings are the available columns in table 'tbl_slider':
 * @property string $id
 * @property string $link
 * @property string $descripcion
 * @property integer $activo
 * @property string $fecha
 */
class Slider extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_slider';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('link, descripcion', 'required'),
            array('activo', 'numerical', 'integerOnly' => true),
            array('link, fecha', 'length', 'max' => 150),
            array('descripcion', 'length', 'max' => 200),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, link, descripcion, activo, fecha', 'safe', 'on' => 'search'),
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
            'link' => 'Imágen para slider (1024 x 402px)',
            'descripcion' => 'Descripción',
            'activo' => 'Activo',
            'fecha' => 'Fecha',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('descripcion', $this->descripcion, true);
        $criteria->compare('activo', $this->activo);
        $criteria->compare('orden', $this->orden);
        $criteria->compare('fecha', $this->fecha, true);

        $sort = new CSort();
        $sort->defaultOrder = array(
            //'create_time' => CSort::SORT_DESC,
            'orden' => CSort::SORT_ASC,
            'sort' => $sort,
        );

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => $sort,
                ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Slider the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}

<?php

class ImageController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/main_cms';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
//    public function accessRules() {
//        return array(
//            array('allow', // allow all users to perform 'index' and 'view' actions
//                'actions' => array('index', 'view'),
//                'users' => array('*'),
//            ),
//            array('allow', // allow authenticated user to perform 'create' and 'update' actions
//                'actions' => array('create', 'update', 'delete'),
//                'users' => array('@'),
//            ),
//            array('allow', // allow admin user to perform 'admin' and 'delete' actions
//                'actions' => array('admin',),
//                'users' => array('admin'),
//            ),
//            array('deny', // deny all users
//                'users' => array('*'),
//            ),
//        );
//    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function getNumActual($type) {
        $c = Resource::model()->countByAttributes(array("type_resource" => $type));
        return $c + 1;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Image;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Image'])) {
            $model->attributes = $_POST['Image'];
            if ($model->validate()) {
                require_once 'upload/upload.php';
                $upload = new Upload();
                $targetDirectory = Yii::getPathOfAlias("webroot") . "/files/images/";
                $nameFile = $this->sanear_string($_FILES['Image']['name']['image']);
                $upload->SetFileName($nameFile);
                $upload->SetTempName($_FILES['Image']['tmp_name']['image']);
                $upload->SetUploadDirectory($targetDirectory);
                //$fimage = CUploadedFile::getInstance($model, 'image');

                $name_real = $upload->GetFileName();
                $actual = $this->getNumActual(5);
                $folder = "imagenes{$actual}";
//                $path = Yii::app()->params['folder'] . "/imagenes/" . $folder;
//                $model->image = $path . "." . $fimage->extensionName;
//                $fimage->saveAs($model->image);
                $fileName = $upload->GetFileName();  // file name
                $fileName = $this->sanear_string($fileName);
                $model->image = $fileName;
                //$fimage->saveAs(Yii::getPathOfAlias("webroot") . "/uploads/images/" . $fileName);
                $model->name_real = $folder;
                $res = new Resource;
                $res->type_resource = 5;
                $res->name_resource = $model->name;
                $res->folder_resource = $folder;
                $res->date_register = date("Y-m-d H:i:s");
                $res->account = 1;
                $res->name_real = $name_real;
                $res->save();
                if ($model->save()) {
                    $upload->UploadFile();
                    $this->redirect(array('image/admin'));
                    Yii::app()->user->setFlash('admin', 'Imágen subida exitosamente.');
                    $this->refresh();
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $name_temp = $model->name_real;
        $file = $model->image;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Image'])) {
            $model->attributes = $_POST['Image'];
            $fimage = CUploadedFile::getInstance($model, 'image');
            if ($fimage == "" || $fimage->getHasError()) {
                $model->name_real = $name_temp;
                if ($model->save()) {
                    Resource::model()->updateResource($model->name_real, $model, false, '');
                    $this->redirect(array('multimedia/index'));
                }
            } else {
                $name_real = $fimage->getName();
                $path = Yii::app()->params['folder'] . "/imagenes/" . $name_temp;
                $model->image = $file;
                $fimage->saveAs($model->image);
                Resource::model()->updateResource($model->name_real, $model, true, $fimage->getName());
                if ($model->save())
                    $this->redirect(array('multimedia/index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Image');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Image('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Image']))
            $model->attributes = $_GET['Image'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Image::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'image-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    private function sanear_string($string) {
        $string = (string) $string;
        $string = trim($string);

        $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string
        );

        $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string
        );

        $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string
        );

        $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string
        );

        $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string
        );

        $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string
        );
        $string = str_replace("+", "", $string);
        //Esta parte se encarga de eliminar cualquier caracter extraño
        $string = str_replace(
                array("\\", "¨", "º", "-", "~",
            "#", "@", "|", "!", "\"",
            "$", "%", "&", "/",
            "(", ")", "?", "'", "¡",
            "¿", "[", "^", "`", "]",
            "}", "{", "¨", "´",
            ">", "< ", ";", ",", ":",
            "+", " "), '_', $string
        );


        return $string;
    }

}

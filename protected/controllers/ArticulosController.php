<?php

class ArticulosController extends Controller {

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
            'postOnly + delete', // we only allow deletion via POST request
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
//                'actions' => array('index', 'view', 'create', 'admin', 'update', 'delete', 'adjuntar'),
//                'users' => array('*'),
//            ),
//            array('allow', // allow authenticated user to perform 'create' and 'update' actions
//                'actions' => array('create', 'update'),
//                'users' => array('@'),
//            ),
//            array('allow', // allow admin user to perform 'admin' and 'delete' actions
//                'actions' => array('admin', 'delete'),
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Articulos;
        //$_SESSION['KCFINDER']['disabled'] = false; // enables the file browser in the admin
        //$_SESSION['KCFINDER']['uploadURL'] = Yii::app()->baseUrl . "/uploads/"; // URL for the uploads folder
        //$_SESSION['KCFINDER']['uploadDir'] = Yii::app()->basePath . "/../uploads/"; // path to the uploads folder
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Articulos'])) {
            $categoria = '';
            if (isset($_GET['categoria']))
                $categoria = $_GET['categoria'];
            $model->attributes = $_POST['Articulos'];
            $model->categoria = $categoria;
            $model->fecha = date("Y-m-d");
            if (isset($_POST['Articulos']['principal'])) {
                $model->principal = $_POST['Articulos']['principal'];
            }
            if ($_POST['Articulos']['principal'] == 0 && $_POST['Articulos']['principal'] != '') {
                $model->id_menu_principal = $_POST['Articulos']['id_menu_principal'];
                $this->setMenuPrincipal($_POST['Articulos']['id_menu_principal']);
            }
            // get array of images for nivo slider galery
            $photos = CUploadedFile::getInstancesByName('photos');
            // proceed if the images have been set
            if (isset($photos) && count($photos) > 0) {
                // go through each uploaded image
                $spic = '';
                foreach ($photos as $image => $pic) {
                    if ($pic->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/images/' . $pic->name)) {
                        // add string to field link_string in table tbl_articulos
                        //echo 'archivo subido';
//                        $model->link_string = Yii::getPathOfAlias('webroot') . '/uploads/images/' . $pic->name;
//                        $image = Yii::app()->image->load($model->link_string);
//                        $image->resize(347, 188)->quality(100);
//                        $image->save();
                        $spic .= $pic->name . '@';
                    } else {
                        //echo 'Cannot upload!';
                    }
                }
                $model->link_string = $spic; // save string of images for nivo slider
                $model->galeria = 1; // save 1 if gallery exists
            }
            //die('before save new:' . $model->link_string);
            if ($_POST['Articulos']['has_image'] == 'Si') {
                // subir miniatura de la noticia al servidor
                require_once 'upload/upload.php';
                $upload = new Upload();
                $targetDirectory = Yii::getPathOfAlias("webroot") . "/img/noticias/thumbs/";
                $upload->SetFileName($_FILES['Articulos']['name']['thumb']);
                $upload->SetTempName($_FILES['Articulos']['tmp_name']['thumb']);
                $upload->SetUploadDirectory($targetDirectory);
                //$archivoThumb = CUploadedFile::getInstance($model, 'thumb');
                //$fileName = "{$archivoThumb}";  // file name
                $model->thumb = $upload->GetFileName();
                
                if ($model->save()) {
                    //$archivoThumb->saveAs(Yii::getPathOfAlias("webroot") . "/img/noticias/thumbs/" . $fileName);
                    $upload->UploadFile();
                    $this->redirect(array('articulos/admin', 'categoria' => $categoria));
                }
            } else {
                if ($model->save())
                    $this->redirect(array('articulos/admin', 'categoria' => $categoria));
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
        $_SESSION['KCFINDER']['disabled'] = false; // enables the file browser in the admin
        $_SESSION['KCFINDER']['uploadURL'] = Yii::app()->baseUrl . "/uploads/"; // URL for the uploads folder
        $_SESSION['KCFINDER']['uploadDir'] = Yii::app()->basePath . "/../uploads/"; // path to the uploads folder
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Articulos'])) {
            $model->attributes = $_POST['Articulos'];
            if ($model->save()) {
                //$this->redirect(array('articulos/admin', 'id' => $id));
                $this->redirect(array('articulos/admin', 'categoria' => $model->categoria));
            }
        }

        $this->render('update', array(
            'model' => $model, 'id' => $id
        ));
    }

    // adjuntar una foto thumb a la noticia
    public function actionAdjuntar($id) {

        $model = new Articulos;
        if (isset($_POST['Articulos'])) {
            die('articulos');
        }
        $this->render('adjuntar', array(
            'model' => $model,
        ));
    }

    public function actionGetdesplegables() {
        //$sql = "SELECT id, modelo, submodelo FROM tbl_marcas WHERE marca='{$modeloAuto}' GROUP BY submodelo ORDER BY modelo";
        $idarticulo = isset($_POST["idarticulo"]) ? $_POST["idarticulo"] : "";
        //die('id articulo: '.$idarticulo);
        $criteria = new CDbCriteria(array(
                    'condition' => "id_articulo='{$idarticulo}' AND titulo_cat <> ''",
                    'group' => 'titulo_cat'
                ));
        $pdfs = Pdf::model()->count($criteria);
        $data = '';
        $count = 0;
        if ($pdfs > 0) {
            $pdfAll = Pdf::model()->findAll($criteria);
            $data .= '<option value="">--Seleccione--</option><option value="nuevo">Nuevo Desplegable</option>
                <option value="ninguno">Ninguno</option>';
            foreach ($pdfAll as $value) {
                $data .= '<option value="' . $value['titulo_cat'] . '">' . $value['titulo_cat'] . '</option>';
            }
            $count = 1;
        } else {
            $data .= '<option value="">--Seleccione--</option><option value="nuevo">Nuevo Desplegable</option>
                <option value="ninguno">Ninguno</option>';
        }
        $options = array('options' => $data, 'pdfs' => $count);
        //echo json_encode($options);
        echo $data;
    }

    public function actionGetmenus() {
        //$sql = "SELECT id, modelo, submodelo FROM tbl_marcas WHERE marca='{$modeloAuto}' GROUP BY submodelo ORDER BY modelo";
        $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : "";
        $criteria = new CDbCriteria(array(
                    'condition' => "categoria='{$categoria}' and principal = 1"
                ));
        $art = Articulos::model()->findAll($criteria);
        $data = '<option value="">--Seleccione--</option>';
        foreach ($art as $value) {
            $data .= '<option value="' . $value['id_articulos'] . '">' . $value['title'] . '</option>';
        }
        $options = array('options' => $data);
        //echo json_encode($options);
        echo $data;
    }

    public function actionGetsubmenus() {
        //$sql = "SELECT id, modelo, submodelo FROM tbl_marcas WHERE marca='{$modeloAuto}' GROUP BY submodelo ORDER BY modelo";
        $categoria = isset($_POST["menu"]) ? $_POST["menu"] : "";
        $menus = array('none', 'nosotros', 'contactanos', 'individuales', 'empresarial', 'servicios', 'informacion');
        switch ($categoria) {
            case 1:// informacion, nosotros, contactenos
            case 2:
            case 6:
                $criteria = new CDbCriteria(array(
                            'condition' => "categoria='{$menus[$categoria]}'"
                        ));
                $art = Articulos::model()->findAll($criteria);
                $data = '<option value="">--Seleccione--</option>';
                foreach ($art as $value) {
                    $data .= '<option value="' . $value['id_articulos'] . '">' . $value['title'] . '</option>';
                }
                break;
            case 3:// seguros individuales, empresariales
            case 4:
                $criteria = new CDbCriteria(array(
                            'condition' => "categoria='{$menus[$categoria]}'"
                        ));
                $seguros = Seguros::model()->findAll($criteria);
                $data = '<option value="">--Seleccione--</option>';
                foreach ($seguros as $value) {
                    $data .= '<option value="' . $value['id'] . '">' . $value['title'] . '</option>';
                }
                break;
            case 5:// servicios
                $servicios = Servicios::model()->findAll(array('order' => 'orden'));
                $data = '<option value="">--Seleccione--</option>';
                foreach ($servicios as $value) {
                    $data .= '<option value="' . $value['id'] . '">' . $value['title'] . '</option>';
                }
                break;
            case 7:// noticias
                $criteria = new CDbCriteria(array(
                            'condition' => "categoria='news' and principal = 1"
                        ));
                $art = Articulos::model()->findAll($criteria);
                $data = '<option value="">--Seleccione--</option>';
                foreach ($art as $value) {
                    $data .= '<option value="' . $value['id_articulos'] . '">' . $value['title'] . '</option>';
                }
                break;

            default:
                break;
        }
        $options = array('options' => $data);
        //echo json_encode($options);
        echo $data;
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $sub = $this->getMenuTipo($id);
        if ($sub != '') {
            $this->setMenuNormal($sub);
        }

        $this->loadModel($id)->delete();


        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->layout = 'main';
        $dataProvider = new CActiveDataProvider('Articulos');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $id = "";
        if (isset($_GET['categoria']))
            $id = $_GET['categoria'];
        $model = new Articulos('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Articulos']))
            $model->attributes = $_GET['Articulos'];
        $model->categoria = $id;

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Articulos the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Articulos::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Articulos $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'articulos-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    // fecha en formato humano
    public function getFecha($fecha) {
        $params = explode("-", $fecha);
        //print_r($params);
        $year = $params[0];
        $mes = $params[1];
        $dia = $params[2];

        switch ($mes) {
            case 01:
                $mesH = 'enero';
                break;
            case 02:
                $mesH = 'febrero';
                break;
            case 03:
                $mesH = 'marzo';
                break;
            case 04:
                $mesH = 'abril';
                break;
            case 05:
                $mesH = 'mayo';
                break;
            case 06:
                $mesH = 'junio';
                break;
            case 07:
                $mesH = 'julio';
                break;
            case 08:
                $mesH = 'agosto';
                break;
            case 09:
                $mesH = 'septiembre';
                break;
            case 10:
                $mesH = 'octubre';
                break;
            case 11:
                $mesH = 'noviembre';
                break;
            case 12:
                $mesH = 'diciembre';
                break;


            default:
                break;
        }

        $fechaString = $dia . ' de ' . $mesH . ' del ' . $year;
        return $fechaString;
    }

    // cambiar a submenu el menu principal
    private function setMenuPrincipal($id) {
        $con = Yii::app()->db;
        $sql = "UPDATE tbl_articulos SET submenu = 1 WHERE id_articulos = {$id}";
        $request = $con->createCommand($sql)->query();
    }

    private function setMenuNormal($id) {
        $con = Yii::app()->db;
        $sql = "UPDATE tbl_articulos SET submenu = 0 WHERE id_articulos = {$id}";
        $request = $con->createCommand($sql)->query();
    }

    private function getMenuTipo($id) {
        $con = Yii::app()->db;
        //die('sql: '.$sql);
        $user = Yii::app()->db->createCommand()
                ->select('id_menu_principal')
                ->from('tbl_articulos')
                ->where('id_articulos=:id', array(':id' => $id))
                ->queryRow();
        return $user['id_menu_principal'];
    }

}

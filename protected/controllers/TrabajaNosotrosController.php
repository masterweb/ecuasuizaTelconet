<?php

class TrabajaNosotrosController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionCreate() {
        $model = new TrabajaNosotros;
        if (isset($_POST['TrabajaNosotros'])) {
            require_once 'email/mail_func.php';
            require_once 'upload/upload.php';
            $model->attributes = $_POST['TrabajaNosotros'];
            $model->fecha = date("Y-m-d G:i:s");

            //$archivoAdjunto = CUploadedFile::getInstance($model, 'link');
            //$fileName = "{$archivoAdjunto}";  // file name
            //$fileName = $this->sanear_string($fileName);
            //$model->link = $fileName;
            if ($model->validate()) {
                if (@!empty($_FILES['TrabajaNosotros']['name']['link'])) {
                    //$archivoAdjunto->saveAs(Yii::getPathOfAlias("webroot") . "/uploads/hvs/" . $fileName);
                    $upload = new Upload();
                    $targetDirectory = Yii::getPathOfAlias("webroot") . "/uploads/hvs/";
                    $nameFile = $this->sanear_string($_FILES['TrabajaNosotros']['name']['link']);
                    //die('namefile: '.$nameFile);
                    $upload->SetFileName($nameFile);
                    $upload->SetTempName($_FILES['TrabajaNosotros']['tmp_name']['link']);
                    $upload->SetUploadDirectory($targetDirectory);
                    //$upload->SetValidExtensions(array('gif', 'jpg', 'jpeg', 'png'));
                    //$upload->SetMaximumFileSize(2097152); //2 MB de limite
                    $upload->UploadFile();
                    $model->link = $upload->GetFileName();
                    $attachment = $targetDirectory.$model->link;
                    $model->save();
                    $body = '<table border=0>
                            <tr><td><b>Formulario enviado desde Trabaja con Nosotros :</b></td></tr>
                            <tr><td><b>Nombres:</b></td><td>' . $_POST['TrabajaNosotros']['nombres'] . '</td></tr>
                            <tr><td><b>Apellidos:</b></td><td>' . $_POST['TrabajaNosotros']['apellidos'] . '</td></tr>
                            <tr><td><b>Teléfono de Contacto:</b></td><td>' . $_POST['TrabajaNosotros']['telefono'] . '</td></tr>
                            <tr><td><b>Celular:</b></td><td>' . $_POST['TrabajaNosotros']['celular'] . '</td></tr> 
                            <tr><td><b>Ciudad:</b></td><td>' . $_POST['TrabajaNosotros']['ciudad'] . '</td></tr>
                            <tr><td><b>Email:</b></td><td>' . $_POST['TrabajaNosotros']['email'] . '</td></tr> 
                            <tr><td><b>Disponibilidad de Tiempo:</b></td><td>' . $_POST['TrabajaNosotros']['disponibilidad'] . '</td></tr>
                            <tr><td><b>Área de interés:</b></td><td>' . $_POST['TrabajaNosotros']['area_interes'] . '</td></tr>
                            </table>';
                    $codigohtml = $body;
                    $headers = 'From: jorge.rodriguez@ariadna.com.ec' . "\r\n";
                    $headers .= 'Content-type: text/html' . "\r\n";

                    $asunto = 'Formulario enviado desde Ecuasuiza Ecuador';
                    if (sendEmailFunction('jorge.rodriguez@ariadna.com.ec', "Ecuasuiza", 'vanessa.diaz@ecuasuiza.ec', html_entity_decode($asunto), $codigohtml, 'utf-8')) {
                        // $email = 'servicioalcliente@ecuasuiza.ec';
                        Yii::app()->user->setFlash('create', 'Gracias, tu hoja de vida ha sido enviada exitosamente.');
                        $this->refresh();
                    }
                }
            }
        }
        $this->render('create', array('model' => $model));
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
            "+"," "), '-', $string
        );


        return $string;
    }

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}
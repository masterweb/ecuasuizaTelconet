<?php

class Util {

    public static function getIdLink($id, $pos) {
        return "#" . $id . "-" . $pos;
    }

    public static function getTitleSeccionFromSeccion($data, $field) {
        $titulo = $data->title_seccion;
        $titulo = str_replace("</strong>", "", $titulo);
        $titulo = str_replace("<strong>", "", $titulo);
        return $titulo;
    }

    public static function getTitleSeccion($data) {
        $sp = Categorias::model()->findByAttributes(array('id' => $data['id_categoria']));
        return $sp['title_categoria'];
    }
    
    public static function minMaxPos($minMax, $posCurrent, $tabla) {
        $sql = 'SELECT ' . $minMax . '(pos) FROM ' . $tabla;
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        if ($posCurrent == $count)
            return false;
        else
            return true;
    }

    public static function minMaxPosContSubseccion($minMax, $data, $tabla) {
        $sql = 'SELECT ' . $minMax . '(pos) FROM ' . $tabla . ' WHERE id_subseccion = ' . $data->id_subseccion;
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        if ($data->pos == $count)
            return false;
        else
            return true;
    }

    public static function minMaxPosContSala($minMax, $data, $tabla) {
        if ($data->id_subseccion == 0)
            $sql = 'SELECT ' . $minMax . '(pos) FROM ' . $tabla . ' WHERE id_salaprensa = ' . $data->id_salaprensa;
        else {
            if ($data->agrupar == 0)
                $sql = 'SELECT ' . $minMax . '(pos) FROM ' . $tabla . ' WHERE id_salaprensa = ' . $data->id_salaprensa . ' AND id_subseccion=' . $data->id_subseccion;
            else
                $sql = 'SELECT ' . $minMax . '(pos) FROM ' . $tabla . ' WHERE id_salaprensa = ' . $data->id_salaprensa . ' AND id_subseccion=' . $data->id_subseccion . ' AND agrupar = ' . $data->agrupar;
        }
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        if ($data->pos == $count)
            return false;
        else
            return true;
    }

    public static function minMaxPosCategory($minMax, $posCurrent, $tabla, $category, $id_category) {
        $sql = 'SELECT ' . $minMax . '(pos) FROM ' . $tabla . " WHERE " . $category . " = " . intval($id_category);
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        if ($posCurrent == $count)
            return false;
        else
            return true;
    }

    public static function getMinMaxPos($minMax, $tabla) {
        $sql = 'SELECT ' . $minMax . '(pos) FROM ' . $tabla;
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        return $count;
    }

    public static function getIp() {
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function validateVar($unaVariable) {
        $unaVariable = trim($unaVariable);
        $unaVariable = addslashes($unaVariable);
        $unaVariable = strip_tags($unaVariable, "<br><br /><b><div><h1><h2><h3><i><ul><ol><li>");
        $unaVariable = htmlspecialchars($unaVariable, ENT_QUOTES);
        //$overnet = htmlspecialchars(addslashes(stripslashes(strip_tags(trim($_GET['pagina'])))));
        echo "VarProd1> " . $unaVariable;
        return $unaVariable;
    }

    public static function validateVar2($unaVariable) {
        $unaVariable = trim($unaVariable);
        $unaVariable = addslashes($unaVariable);
        $unaVariable = strip_tags($unaVariable, "<br><br /><b><div><h1><h2><h3><i><ul><ol><li><strong><em><a>");
        echo "Var2> " . $unaVariable;
        return $unaVariable;
    }

    /** Position Actualidad ** */
    public static function minMaxPosSlider($minMax, $posCurrent, $tabla) {
        $sql = 'SELECT ' . $minMax . '(orden) FROM ' . $tabla;
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        if ($posCurrent == $count)
            return false;
        else
            return true;
    }

    public static function getTitulo($data) {
        return $data->title;
    }

    public static function getDesc($data) {
        return $data->desc_min;
    }
    
    public static function getImage($data) {
        $html = '<img src="'. Yii::app()->request->baseUrl.'/img/seguros/'.$data->link_img.'" width="85%"/>'; 
        return $html;
    }
    
    public static function getImageMultimediaLink($data) {
        $html = '<img src="'. Yii::app()->request->baseUrl.'/uploads/images/'.$data->image.'" width="30%"/><br><br>'; 
        $html .= '<p>http://preproduccion.ariadna.us/'. Yii::app()->request->baseUrl.'/uploads/images/'.$data->image.'</p>'; 
        return $html;
    }
    
    public static function getImageMultimedia($data) {
        $html = '<img src="'. Yii::app()->request->baseUrl.'/uploads/images/'.$data->image.'" width="90%"/>'; 
        //$html .= '<p>http://preproduccion.ariadna.us/'. Yii::app()->request->baseUrl.'/uploads/images/'.$data->image.'</p>'; 
        return $html;
    }
    
    public static function getImageSlider($data) {
        $html = '<img src="'. Yii::app()->request->baseUrl.'/img/sliderSeguros/'.$data->link.'" width="60%"/>'; 
        return $html;
    }
    
    public static function getImageBanner($data) {
        $html = '<img src="'. Yii::app()->request->baseUrl.'/img/slider/'.$data->link.'" width="60%"/>'; 
        return $html;
    }
    
    public static function getNameCategoria($data) {
        $sp = Articulos::model()->findByAttributes(array('id_articulos' => $data['id_articulos']));
        return $sp['title_categoria'];
    }

    public static function getTexto_actualidad($data, $id) {
        return $data->texto_actualidad;
    }

    public static function getOrder($model) {
        $num = $model->orden;
        if ($num == 1)
            return "Principal";
        else if ($num == 2)
            return "Secundario";
        else if ($num == 3)
            return "Mas Informacion";
        else
            return "Archivado";
    }

    public static function getURLDeleteSeguro($model) {
        return Yii::app()->createUrl('adminseguros/delete', array('id' => $model->id), array('onclick' => 'delete();'));
    }
    
    public static function getURLDeleteSeguroEmp($model) {
        return Yii::app()->createUrl('adminseguros/delete', array('id' => $model->id), array('onclick' => 'delete();'));
    }

    public static function getURLUpdateSeguro($model) {
        return Yii::app()->createUrl('adminseguros/update', array('id' => $model->id));
    }

    public static function getURLArchivarSeguro($model) {
        return Yii::app()->createUrl('adminseguros/archivar', array('id' => $model->id));
    }
    public static function getURLAdjuntarArticulo($model) {
        return Yii::app()->createUrl('articulos/adjuntar', array('id' => $model->id_articulos));
    } 
    
    public static function getURLDeleteAdjunto($model) {
        return Yii::app()->createUrl('adminseguros/deleteadjunto', array('id' => $model->id));
    }

    public static function getURLActivarSeguro($model) {
        $activo = $model->activo;
        if ($activo == 0) {
            return Yii::app()->createUrl('adminseguros/activar', array('id' => $model->id_articulo));
        } else if ($activo == 1 || ($activo == '')) {
            return '';
        }

//        if ($activo == 0) {
//            $data = array('activar' => array(
//                'label' => 'Activar',
//                'url' => 'Util::getURLActivarArticulo($data)'),
//            );
//        }else if ($activo == 1 || ($activo == '')) {
//            $data = array('Desactivar' => array(
//                'label' => 'Activar',
//                'url' => 'Util::getURLActivarArticulo($data)'),
//            );
//        }
//        return $data;
    }

    public static function getURLUpdateVideo($model) {
        return Yii::app()->createUrl('subseccionvideo/update', array('id' => $model->id_video));
    }

    public static function getURLDeleteVideo($model) {
        return Yii::app()->createUrl('subseccionvideo/delete', array('id' => $model->id_video));
    }

    public static function getURLUpdateTipoDocumento($model) {
        return Yii::app()->createUrl('TipoDocumento/update', array('id' => $model->id_tipo_documento));
    }

    public static function getURLDeleteTipoDocumento($model) {
        return Yii::app()->createUrl('TipoDocumento/delete', array('id' => $model->id_tipo_documento));
    }

    public static function getURLUpdateDocumento($model) {
        return Yii::app()->createUrl('Documento/update', array('id' => $model->id_documento));
    }

    public static function getURLDeleteDocumento($model) {
        return Yii::app()->createUrl('Documento/delete', array('id' => $model->id_documento));
    }

    public static function getOpen($model) {
        if ($model->open == 1)
            return "En la misma ventana";
        else
            return "Otra pestaña";
    }

    public static function getSalaPrensaSubsection($data, $n) {
        if ($data['id_subseccion'] != 0) {
            $sp = SalaPrensaSubseccion::model()->findByAttributes(array('id_subseccion' => $data['id_subseccion']));
            return $sp['name_subseccion'];
        } else {
            return "";
        }
    }

    public static function haveSubsection($data, $n) {
        if ($data['have_subsection'] == 1)
            return "Tiene";
        else
            return "No tiene";
    }

    public static function getThumb($model) {
        return Yii::app()->request->baseUrl . '/' . $model->thumb;
    }

    public static function getAgrupador($data) {
        if ($data->id_subseccion == 6)
            return $data->idAgrupar['nombre_agrupador'];
        else
            return "";
    }

}

?>
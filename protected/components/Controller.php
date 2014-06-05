<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function getSubSecciones($id) {
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $mobile_agents = '!(tablet|pad|mobile|phone|symbian|android|ipod|ios|blackberry|webos)!i';
            if (preg_match($mobile_agents, $_SERVER['HTTP_USER_AGENT'])) {
                $mobile = true;
            } else {
                $mobile = false;
            }
        }
        $subseccion = Subcategorias::model()->findAllByAttributes(array("id_categoria" => $id), array('order' => 'posicion'));

        $ss = '';
        switch ($id) {
            case 1:
                $criteria = new CDbCriteria(array(
                            "condition" => "categoria='individuales'",
                            'order' => 'title ASC'
                        ));
                $seguros = Seguros::model()->findAll($criteria);
                $ss = "<ul class='seguros-ind submenuec'>";
                foreach ($seguros as $s) {
                    $ss.= '<li><a href="' . Yii::app()->createUrl('/seguros/individuales', array('id' => $s['id'])) . '">' . $s['title'] . '</a></li>';
                }
                $ss .= '</ul>';
                break;
            case 2:
                $ss = "<ul class='sub-empresariales submenuec'>";
                $condition = 'categoria ="empresarial"';

                $criteria = new CDbCriteria(array(
                            'condition' => $condition,
                            'order' => 'title ASC'
                        ));

                $segurosEmp = Seguros::model()->findAll($criteria);
                $resultado = count($segurosEmp);
                $numFilas = ceil($resultado / 2);
                //echo $numFilas;
                $condition = 'categoria ="empresarial"';
                $limit = $numFilas;
                $offset = 0;

                $criteria2 = new CDbCriteria(array(
                            'condition' => $condition,
                            'limit' => $limit,
                            'offset' => $offset,
                            'order' => 'title ASC'
                        ));

                $segurosEmp = Seguros::model()->findAll($criteria2);

                $ss .= '<p class="column-emp">';
                foreach ($segurosEmp as $se) {
                    if ($se['categoria'] == 'empresarial'):
                        $ss .= '<a href="' . Yii::app()->createUrl('/seguros/empresariales', array('id' => $se['id'])) . '">' . $se['title'] . '</a>';
                    endif;
                }
                $ss .= '</p>';

                $condition = 'categoria ="empresarial"';
                $limit = $resultado;
                $offset = $numFilas;
                $criteria2 = new CDbCriteria(array(
                            'condition' => $condition,
                            'limit' => $limit,
                            'offset' => $offset,
                            'order' => 'title ASC'
                        ));

                $segurosEmp = Seguros::model()->findAll($criteria2);

                $ss .= '<p class="column-emp">';
                foreach ($segurosEmp as $se) {
                    if ($se['categoria'] == 'empresarial'):
                        $ss .= '<a href="' . Yii::app()->createUrl('/seguros/empresariales', array('id' => $se['id'])) . '">' . $se['title'] . '</a>';
                    endif;
                }
                $ss .= '</p>';
                $ss .= '</ul>';

                break;
            case 3:
                $servicios = Servicios::model()->findAll(array('order' => 'orden'));
                $ss .= '<ul class="submenuec">';
                foreach ($servicios as $s) {
                    if ($s['direct_link'] != null):
                        $ss .= '<li><a href="' . $s['direct_link'] . '" target = "_blank">' . $s['title'] . '</a></li>';
                    else:
                        $ss .= '<li><a href="' . Yii::app()->createUrl('/servicios/index', array('id' => $s['id'])) . '">' . $s['title'] . '</a></li>';
                    endif;
                }
                $ss .= '</ul>';
                break;
//            case 4: // como respaldo del menu
//                $ss = '<ul>
//                            <li><a href="' . Yii::app()->createUrl('/noticias/') . '">Noticias</a></li>
//                            <li><a href="' . Yii::app()->createUrl('/informacion/index', array('cat' => 'programaEducacion')) . '">Programa de Educación Financiera</a></li>
//                            <li><a href="' . Yii::app()->createUrl('/informacion/index', array('cat' => 'gobiernoCorporativo')) . '">Gobierno Corporativo</a></li>
//                            <li><a href="#" class="no-link">Ley de Transparencia</a>
//                                <ul>
//                                    <li><a href="' . Yii::app()->createUrl('/informacion/index', array('subcat' => 'informacionFinanciera')) . '">Información Financiera</a></li>
//                                    <li><a href="' . Yii::app()->createUrl('/informacion/index', array('subcat' => 'indicadoresServicioCliente')) . '">Indicadores de Servicio al Cliente</a></li>';
//                if (!Yii::app()->user->isEditorUser()):
//                    $ss .= '<a href="#inline1" class="fancybox">Información de accionistas</a>';
//                else:
//                    $ss .= '<li><a href="' . Yii::app()->createUrl('/informacion/index', array('subcat' => 'informacionAccionistas')) . '">Información de accionistas </a></li>';
//                endif;
//                $ss .= '</ul>
//                            </li>
//                            <li><a href="' . Yii::app()->createUrl('/informacion/index', array('cat' => 'lavadoActivos')) . '">Lavado de Activos</a></li>
//                            <li><a href="' . Yii::app()->createUrl('/informacion/index', array('cat' => 'glosario')) . '">Glosario de Términos</a></li>
//                            <li><a href="' . Yii::app()->createUrl('/informacion/index', array('cat' => 'preguntasFrecuentes')) . '">Preguntas Frecuentes</a></li>
//                        </ul>';
//                break;

            case 4:
                $criteria = new CDbCriteria(array("condition" => "categoria='informacion' and principal=1", "order" => "orden"));
                $art = Articulos::model()->findAll($criteria);
                $ss = '<ul class="submenuec">';
                $ss .= '<li><a href="' . Yii::app()->createUrl('/noticias/') . '">Noticias</a></li>';
                foreach ($art as $value) {
                    if ($value['submenu'] == 1) {
                        if($mobile){
                            $ss .= '<li><a href="#" class="no-link has-level" style="color:#4A9D43 !important;">' . $value['title'] . '</a>';
                        }else{
                            $ss .= '<li><a href="#" class="no-link has-level">' . $value['title'] . '</a>';
                        }
                        $criteria = new CDbCriteria(array("condition" => "id_menu_principal={$value['id_articulos']}", "order" => "orden"));
                        $submenu = Articulos::model()->findAll($criteria);
                        $ss .= '<ul class="sub-level">';
                        foreach ($submenu as $sub) {
                            if ($sub['access'] == 0) {
                                if (!Yii::app()->user->isEditorUser()):
                                    $ss .= '<a href="#inline1" class="fancybox">' . $sub['title'] . '</a>';
                                else:
                                    $ss .= '<li><a href="' . Yii::app()->createUrl('/informacion/index', array('id' => $sub['id_articulos'])) . '">' . $sub['title'] . '</a></li>';
                                endif;
                            }else {
                                $ss .= '<li><a href="' . Yii::app()->createUrl('/informacion/index', array('id' => $sub['id_articulos'])) . '">' . $sub['title'] . '</a></li>';
                            }
                        }
                        $ss .= '</ul>
                                </li>';
                    } else {
                        $ss .= '<li><a href="' . Yii::app()->createUrl('/informacion/index', array('id' => $value['id_articulos'])) . '">' . $value['title'] . '</a></li>';
                    }
                }
                $ss .= '</ul>';
                break;
            default:
                break;
        }

        return $ss;
    }

}
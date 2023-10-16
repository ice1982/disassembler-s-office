<?php
/**
 * Created by PhpStorm.
 * User: ice
 * Date: 07.03.2017
 * Time: 23:01
 */

namespace app\core;

class Controller extends Config
{
    public $userinfo;
    public $text;
    public $lang;
	public $flags;

    public function __construct()
    {
        session_start();
        if (isset($_COOKIE) && is_array($_COOKIE)) {
            $this->userinfo = (object)$_COOKIE;
            $_SESSION       = $_COOKIE;
        } else {
            $this->userinfo = (object)$_SESSION;
        }
		$model       = new Model();
        $result      = $model->translate();
		$this->text  = $result['text'];
		$this->lang  = $result['lang'];
		$this->flags = $model->get_flags();
    }

    function render($view, $ygjb = null, $modal = false)
    {
        ob_start();
        if (is_array($ygjb)) {
            extract($ygjb);
            unset($ygjb);
        }
        $module = new Router();
        $module = $module->module();
        include '../modules/' . $module . '/views/' . $view;
        $content = ob_get_clean();

        if ($modal) {
            return $content;
        } else {
            $css = 'css/modules/' . $module . '.css';
            $js  = 'js/modules/' . $module . '.js';
            $obj = new Model();
            if (isset($_SESSION['sellers_id'])) {
                $schedule = $obj->schedule($_SESSION['sellers_id']);
                $fio      = $obj->fio($_SESSION['sellers_id']);

            }
            return include '../template/template.php';
        }
    }
}
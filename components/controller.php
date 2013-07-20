<?php
class Controller{
    public $layout = 'main';

    public function __construct(){
        $this->init();
    }

    public function init(){
        YDatabase::set_db();
    }


    public function getControllerName(){
		$arr = explode('Controller',get_class($this));
		return strtolower($arr[0]);
	}

    public function render($view,$bind){
        ob_start();
        extract($bind,EXTR_OVERWRITE);
        unset($bind);
        require(YROOT.'/view/'.$this->getControllerName().'/'.$view.'.php');
        $content=ob_get_contents();
        ob_end_clean();
        require(YROOT.'/view/layout/'.$this->layout.'.php');
        unset($content);
    }

    public function actionIndex(){
    	echo 'undefined default action..';
    }
}
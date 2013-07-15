<?php
class MainController extends Controller{
    public function actionMain(){
        $info = 'test';
        //end
        $view = 'main';
        $bind = array();
        $bind['info'] = $info;
        $this->render($view,$bind);
    }

    public function actionTest(){
        $info = 'test1';
        //end
        $view = 'main';
        $bind = array();
        $bind['info'] = $info;
        $this->render($view,$bind);
    }
}
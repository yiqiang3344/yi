<?php
class MainController extends Controller{
    public function actionMain(){
        $info = MUser::getBlog();
        print_r($info);
        //end
        $view = 'main';
        $bind = array();
        $bind['info'] = $info;
        $this->render($view,$bind);
    }

    public function actionAddBlog(){
        MUser::addBlog();
        $info = '添加成功';
        //end
        $view = 'main';
        $bind = array();
        $bind['info'] = $info;
        $this->render($view,$bind);
    }
}
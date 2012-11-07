<?php

class IndexController extends Controller
{
    public function init(){
        $this->layout = "front_layout";
    }

    private function getUserInfo(){
        $mySession = new CHttpSession();
        $mySession->open();
        $userInfo = $mySession->get("userInfo");

        return $userInfo;
    }

	public function actionIndex()
	{
        //入口页
        //qq用户接入
        $qqMember = new Qqmember;
        $qqMember->memberEnter();

        $userInfo = self::getUserInfo();

        if(empty($userInfo['userid'])){
            die('user auth error');
        }

        $url = Yii::app()->createUrl("main/Index/TryPageOne");
        $this->redirect($url);
	}

    //tabOne
    public function actionTryPageOne(){
        $this->render('index');
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
<?php

class IndexController extends Controller
{
    public $_userInfo;
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
        $type_id = 1;
        $items = self::findByCondition($type_id);
        $userInfo = self::getUserInfo();
        $this->_userInfo = $userInfo;

        $this->render('index',
                array(
                    'items' => $items,
                )
        );
    }

    //tabtwo
    public function actionTryPageTwo(){
        $type_id = 2;
        $items = self::findByCondition($type_id);
        $userInfo = self::getUserInfo();
        $this->_userInfo = $userInfo;

        $this->render('page2',
            array(
                'items' => $items,
            )
        );
    }

    private function findByCondition($type_id){
        $cacheKey = md5(__CLASS__.__FUNCTION__.$type_id);
        $cacheTime = 5 * 60;
        $cacheVal = Yii::app()->cache->get($cacheKey);

        if($cacheVal != null){
            $items = $cacheVal;
        }else{
            $criteria = new CDbCriteria();
            /*
            $criteria->addCondition("endtime>".time());
            */
            $criteria->addCondition("is_top=1");
            $criteria->addCondition("type_id={$type_id}");

            $criteria->limit = 10;
            $criteria->order = "item_id desc";
            $items = Item::model()->findAll($criteria);

            if($items != null){
                Yii::app()->cache->set($cacheKey, $items, $cacheTime);
            }
        }

        return $items;
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
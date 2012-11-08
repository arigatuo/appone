<?php
class AjaxController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = false;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',
						'users'=>array('*'),
					),
				/*
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index','view'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update'),
						'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete', 'Uploadimg'),
						'users'=>array('admin'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
				*/
		);
	}
	
	public function actionUploadimg(){
		Yii::import("ext.EAjaxUpload.qqFileUploader");
		
		$folder='upload/'.date("Ymd", time()).'/';// folder for uploaded files
        if(!is_dir("upload")){
            mkdir("upload");
        }
		if(!is_dir($folder)){
			mkdir($folder);
		}
		
		$allowedExtensions = array("jpg");//array("jpg","jpeg","gif","exe","mov" and etc...
		$sizeLimit = 1 * 1024 * 1024;// maximum file size in bytes
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($folder);
		$result['folder'] = $folder;
		$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		
		$fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
		$fileName=$result['filename'];//GETTING FILE NAME
		
		echo $return;// it's array
	}

    //增加分享
    //需要参数 itemId, uid, type
    public function actionAddTimes(){
        if(Yii::app()->request->isAjaxRequest){
            $newSession = new CHttpSession();
            $newSession->open();
            $userInfo = $newSession->get('userInfo');
            if(!empty($userInfo['userid']))
                $uid = $userInfo['userid'];

            if(!empty($_POST['itemId']) && !empty($uid) && is_numeric($_POST['itemId']) && is_numeric($uid)
                && in_array($_POST['type'], array('share_time', 'fav_time'))
            ){
            }else{
                echo -1;
                die();
            }

            $result = Appcache::setCache($_POST['itemId'], $_POST['type'], $uid);

            //收藏会返回是否收藏成功
            if($_POST['type'] == "fav_time"){
                echo $result;
            }
        }
    }

    public function actionUpdateIsFans(){
        if(Yii::app()->request->isAjaxRequest){
            $qqMember = new Qqmember();
            $return = $qqMember->update_user_is_login();
            echo $return;
        }
    }

}
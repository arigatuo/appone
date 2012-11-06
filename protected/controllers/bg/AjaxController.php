<?php
class AjaxController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
						'actions'=>array('Uploadimg'),
						'users'=>array('@'),					
					),
				array('deny',  // deny all users
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
		$sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($folder);
		$result['folder'] = $folder;
		$return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		
		$fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
		$fileName=$result['filename'];//GETTING FILE NAME
		
		echo $return;// it's array
	}
}
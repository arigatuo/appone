<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lizhen
 * Date: 11/4/12
 * Time: 11:59 PM
 * To change this template use File | Settings | File Templates.
 */
class Qqmember extends CController
{
    private $_appKey, $_appId, $_appRecallUrl, $_serverName;

    public function __construct(){
        ;
    }

    public function init(){
        $config = new CConfiguration();
        $config->loadFromFile("protected/config/qq_connect.php");
        $this->_appKey = $config->itemAt("appKey");
        $this->_appId = $config->itemAt("appId");
        $this->_appRecallUrl = $config->itemAt("appRecallUrl");
        $this->_serverName = $config->itemAt("serverName");
    }

    public function get_user_info($sdk, $openid, $openkey, $pf){
        $params = array(
            'openid' => $openid,
            'openkey' => $openkey,
            'pf' => $pf,
        );
        $script_name = '/v3/user/get_info';
        return $sdk->api($script_name, $params,'post');
    }

    public function memberEnter(){
        self::init();
        Yii::import('application.vendors.qqsdk.*');
        Yii::import('application.vendors.qqsdk.lib.*');
        require_once("OpenApiV3.php");

        $sdk = new OpenApiV3($this->_appId, $this->_appKey);
        $sdk->setServerName($this->_serverName);

        if(!empty($_REQUEST['openid']) && !empty($_REQUEST['openkey']) && !empty($_REQUEST['pf'])){
            $ret = $this->get_user_info($sdk, $_REQUEST['openid'], $_REQUEST['openkey'], $_REQUEST['pf']);
            if($ret['ret'] !== 0){
                throw new CHttpException("404");
            }else{
                var_dump($ret);
            }
        }
    }
}

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: lizhen
 * Date: 11/6/12
 * Time: 11:27 PM
 * To change this template use File | Settings | File Templates.
 */
class Appcache extends CController
{
    const KEY_HEAD = "read_nums_";
    //设置缓存， 并新增用户收藏记录
    //@type (enum){share_time, fav_time}
    public static function setCache($itemId, $type, $uid=0){
        self::init();

        if(!empty($itemId) && is_numeric($itemId) && !empty($type) && in_array($type, array('share_time', 'fav_time'))){
        }else{
            die();
        }

        $cacheKey = md5(self::KEY_HEAD.$itemId.$type);
        $cacheTime = 24 * 3600;

        $cacheVal = Yii::app()->cache->get($cacheKey);
        if($cacheVal != null){
            $cacheVal['times'] += 1;
            $cacheVal['changed'] = 1;
            Yii::app()->cache->set($cacheKey, $cacheVal, $cacheTime);
        }else{
            $theOneAttribute = Item::model()->findByPk($itemId)->getAttribute($type);
            $cacheVal = array(
                'times' => $theOneAttribute,
                'lastUpdateTime' => time(),
                'changed' => 0,
            );
            Yii::app()->cache->set($cacheKey, $cacheVal, $cacheTime);
        }

        //如果是收藏还要添加用户记录
        if($type == "fav_time" && !empty($uid)){
            //$uid relations
        }
    }

    //读取cache, 并在一定时间后存入数据库
    //@type (enum){share_time, fav_time}
    public static function getCache($itemId, $type){
        self::init();
        if(!empty($itemId) && is_numeric($itemId) && !empty($type) && in_array($type, array('share_time', 'fav_time'))){
        }else{
            die();
        }

        $cacheKey = md5(self::KEY_HEAD.$itemId.$type);
        $cacheTime = 24 * 3600;

        $cacheVal = Yii::app()->cache->get($cacheKey);

        echo "cache***";
        var_dump($cacheVal);

        if($cacheVal != null){
            //60秒更新到数据库
            if(!empty($cacheVal['lastUpdateTime']) && (time()-$cacheVal['lastUpdateTime']) > 60){
                //如果状态改变
                if(!empty($cacheVal['changed']) && $cacheVal['changed'] == 1){
                    $theOne = Item::model()->findByPk($itemId);
                    $theOne->setAttribute($type, $cacheVal['times']);
                    if($theOne->update()){
                        $cacheVal['changed'] = 0;
                        $cacheVal['lastUpdateTime'] = time();
                    }
                }else{
                    $cacheVal['lastUpdateTime'] = time();
                }
                Yii::app()->cache->set($cacheKey, $cacheVal, $cacheTime);
            }
        }else{
            $theOneAttribute = Item::model()->findByPk($itemId)->getAttribute($type);
            $cacheVal = array(
                'times' => $theOneAttribute,
                'lastUpdateTime' => time(),
                'changed' => 0,
            );
            Yii::app()->cache->set($cacheKey, $cacheVal, $cacheTime);
        }
        return $cacheVal['times'];
    }

}

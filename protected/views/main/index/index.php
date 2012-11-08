    <ul class="prolist">
<?php
    foreach($items as $item){
        $itemAttributes = $item->getAttributes();
        $curUrl = $itemAttributes['url'];
?>
        <li class="item">
            <h2><img src="<?php echo Yii::app()->baseUrl;?>/images/y.gif" width="37" height="36"><a href="javascript:fusion2.nav.open({url:'<?php echo $curUrl;?>'});" target="_blank">［包邮] <?php echo $itemAttributes['title'];?></a></h2>
            <div class="pic"><a href="javascript:fusion2.nav.open({url:'<?php echo $curUrl;?>'});"><img src="<?php echo $itemAttributes['photo'];?>" width="310" height="310"></a></div>
            <div class="txt">
                <div class="price-try">
                    <div class="price"> <span class="cp"><?php echo $itemAttributes['special_price']?></span> <span class="op">原价：<i><?php echo $itemAttributes['price'];?></i></span> </div>
                    <div class="try"><a href="javascript:fusion2.nav.open({url:'<?php echo $curUrl;?>'});" title="马上试用">马上试用</a></div>
                </div>
                <div class="sl">
                    <div class="s"><?php $tmp = $itemAttributes['pieces'] - $itemAttributes['already_buy'];echo $tmp > 0 ? $tmp : 0 ?></div>
                    <div class="l"><?php echo $itemAttributes['already_buy']; ?></div>
                </div>
                <div class="time" timevalue="<?php echo strtotime($itemAttributes['endtime']);?>"> <span class="shi">03</span> <span class="fen">29</span> <span class="miao">52</span> </div>
                <ul class="comment">
                    <?php
                        $cacheKey = md5("read_items_comment_cache".$itemAttributes['item_id']);
                        $cacheTime = 12 * 3600;
                        $cacheVal = Yii::app()->cache->get($cacheKey);
                        if($cacheVal != null){
                            $comments = $cacheVal;
                        }else{
                            $comments = Comment::getCommentsByItemId($itemAttributes['item_id']);
                            Yii::app()->cache->set($cacheKey, $comments, $cacheTime);
                        }
                        if(!empty($comments)){
                            foreach($comments as $comment){
                    ?>
                                <li><img src="<?php echo $comment[0];?>" width="30" height="30"><?php echo $comment[1];?></li>
                    <?php
                            }
                        }
                    ?>
                </ul>
                <div class="favorite-handsel">
                    <a href="javascript:" id="favNumber_<?php echo $itemAttributes['item_id'];?>" xid="<?php echo $itemAttributes['item_id'];?>" title="收藏" class="favorite"><span>( <font class="number"><?php echo Appcache::getCache($itemAttributes['item_id'], 'fav_time'); ?></font> )</span></a>
                    <a href="javascript:" id="shareNumber_<?php echo $itemAttributes['item_id'];?>" xid="<?php echo $itemAttributes['item_id'];?>" title="请好友赠送" class="handsel handsel-style2"><span>( <font class="number"><?php echo Appcache::getCache($itemAttributes['item_id'], 'share_time'); ?></font> )</span></a>
                </div>
            </div>
            <div class="qzone" style="display:none"><iframe src="http://open.qzone.qq.com/like?url=http%3A%2F%2Fuser.qzone.qq.com%2F625617480&type=button&width=400&height=30&style=3" allowtransparency="true" scrolling="no" border="0" frameborder="0" style="width:65px;height:30px;border:none;overflow:hidden; margin:17px 0 5px 15px;"></iframe><p>关注我，每天有新试用哦</p></div>
        </li>
<?php
    }
?>
    </ul>

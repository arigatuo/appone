    <ul class="prolist">
<?php
    foreach($items as $item){
        $itemAttributes = $item->getAttributes();
        $curUrl = $itemAttributes['url'];
        /*
        echo "<a class='favLink' href='javascript:tools.addFav(".$itemAttributes['item_id'].")' item_id='".$itemAttributes['item_id']."'>收藏</a>";
        echo "<a class='favLink' href='javascript:tools.addShare(".$itemAttributes['item_id'].")' item_id='".$itemAttributes['item_id']."'>推荐</a>";
        echo "<hr/>";
        */
?>
        <li class="item">
            <h2><img src="images/y.gif" width="37" height="36"><a href="#" target="_blank">［包邮] <?php echo $itemAttributes['title'];?></a></h2>
            <div class="pic"><a href="<?php echo $curUrl;?>" target="_blank"><img src="<?php echo $itemAttributes['photo'];?>" width="310" height="310"></a></div>
            <div class="txt">
                <div class="price-try">
                    <div class="price"> <span class="cp"><?php echo $itemAttributes['special_price']?></span> <span class="op">原价：<i><?php echo $itemAttributes['price'];?></i></span> </div>
                    <div class="try"><a href="<?php echo $curUrl;?>" target="_blank" title="马上试用">马上试用</a></div>
                </div>
                <div class="sl">
                    <div class="s"><?php $tmp = $itemAttributes['pieces'] - $itemAttributes['already_buy'];echo $tmp > 0 ? $tmp : 0 ?></div>
                    <div class="l"><?php echo $itemAttributes['already_buy']; ?></div>
                </div>
                <div class="time"> <span class="shi">03</span> <span class="fen">29</span> <span class="miao">52</span> </div>
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
                    <a href="#" target="_blank" title="收藏" class="favorite"><span>( <?php echo $itemAttributes['fav_time']; ?> )</span></a>
                    <a href="#" target="_blank" title="请好友赠送" class="handsel"><span>( <?php echo $itemAttributes['share_time'];?> )</span></a>
                </div>
            </div>
        </li>
<?php
    }
?>
    </ul>

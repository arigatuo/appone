<?php header('P3P: CP=CAO PSA OUR'); ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/style/base.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/style/master.css">
    <script src="http://www.lady8844.com/images/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/js/tools.js" type="text/javascript"></script>
    <?php
        $config = new CConfiguration();
        $config->loadFromFile("protected/config/qq_connect.php");
        $appId = $config->itemAt("appId");
    ?>
    <script type="text/javascript" charset="utf-8"  src="http://fusion.qq.com/fusion_loader?appid=<?php echo $appId?>&platform=qzone"> </script>
    <script type="text/javascript">
        <?php
            if(!empty($this->_userInfo['isFans'])){
                        $_isFans = 1;
            }
        ?>

        var _isFans = <?php echo !empty($_isFans) ? 1 : 0?>;
        var _update = 0;

        var serverTime = <?php echo time()*1000; ?>;
        var tools = {
            addFav : function(item_id){
                jQuery.ajax({
                    type: "POST",
                    url: '<?php echo Yii::app()->createUrl("main/Ajax/AddTimes"); ?>',
                    data: { type : "fav_time", itemId:item_id },
                    success: function(msg){
                        if(parseInt(msg) > 0){
                            var numberSpan = jQuery("#favNumber_"+item_id).find(".number").eq(0);
                            numberSpan.html(parseInt(numberSpan.html()) + 1);
                        }
                    }
                });
            },
            addShare : function(item_id){
                jQuery.ajax({
                    type: "POST",
                    url: '<?php echo Yii::app()->createUrl("main/Ajax/AddTimes"); ?>',
                    data: { type : "share_time", itemId:item_id },
                    success: function(msg){
                        console.log(msg);
                        var numberSpan = jQuery("#shareNumber_"+item_id).find(".number").eq(0);
                        numberSpan.html(parseInt(numberSpan.html()) + 1);
                    }
                });
            },
            favBox: function(event) {
                var obj = $(this);
                var xid = obj.attr("xid");
                tools.addFav(xid);
                /*
                fusion2.dialog.sendStory
                        ({
                            title :"天天试用",
                            img:"http://app24341.qzoneapp.com/app24341/feed_clown.png",
                            summary :"天天试用是.....",
                            msg:"这个是msg",
                            //button :"获取能量",
                            context:"send-story-12345",
                            onSuccess : function (opt)
                            {
                                tools.addFav(xid);
                            }
                        });
                        */
            },
            attention_box:function(){
                $(".qzone").hide();
                $("#cur_iframe").removeAttr("id");
                var obj = $(this).find(".qzone").eq(0);obj.show();
                obj.find("iframe").attr("id","cur_iframe");
                iframeBind();
            },
            shareBox : function(event){
                var obj = $(this);
                var xid = obj.attr("xid");
                tools.addShare(xid);

                /*
                fusion2.dialog.sendStory
                    ({
                        title :"天天试用",
                        img:"http://app24341.qzoneapp.com/app24341/feed_clown.png",
                        summary :"天天试用是.....",
                        msg:"这个是msg",
                        //button :"获取能量",
                        context:"send-story-12345",
                        onSuccess : function (opt)
                        {
                            tools.addShare(xid);
                        }
                    });
                    */
            },
            updateState: function(){
                jQuery.ajax({
                    url: '<?php echo Yii::app()->createUrl("main/Ajax/UpdateIsFans"); ?>',
                    success: function(msg){
                        if(parseInt(msg) == 0){
                            tools.bindHover();
                        }
                    }
                });
            },
            bindHover : function(){
                $(".prolist .item").hover(tools.attention_box);
            }
        };
        jQuery(function(){
            //设置自动高度
            fusion2.canvas.setHeight
            ({
                height : 0

            });

            //收藏
            jQuery(".favorite").click( tools.favBox );
            jQuery(".handsel").click( tools.shareBox );

            tools.updateState();
            //关注
            if(!_isFans)
                tools.bindHover();
        });
    </script>

    <script type="text/javascript">
        var IframeOnClick = {
            resolution: 2000,
            iframes: [],
            interval: null,
            Iframe: function() {
                this.element = arguments[0];
                this.cb = arguments[1];
                this.hasTracked = false;
            },
            track: function(element, cb) {
                this.iframes.push(new this.Iframe(element, cb));
                if (!this.interval) {
                    var _this = this;
                    this.interval = setInterval(function() { _this.checkClick(); }, this.resolution);
                }
            },

            checkClick: function() {

                if (document.activeElement) {
                    var activeElement = document.activeElement;
                    for (var i in this.iframes) {
                        if (activeElement === this.iframes[i].element) { // user is in this Iframe
                            if (this.iframes[i].hasTracked == false) {
                                this.iframes[i].cb.apply(window, []);
                                this.iframes[i].hasTracked = true;
                            }
                        } else {
                            this.iframes[i].hasTracked = false;
                        }
                    }
                }
            }
        };

        function iframeBind(){
            IframeOnClick.track(document.getElementById("cur_iframe"), function() {
                $(".prolist .item").unbind();
                $(".qzone").hide();

                if(_update == 0){
                    tools.updateState();
                    _update = 1;
                }
                /*
                $.post(U('home/User/doQzoneFans'),function(res){
                    res = eval('('+res+')');
                    if(res.flag==1){
                        $('.qqadd').hide();
                        ui.box.load(U('home/User/loadLotteryBox'),{title:'抢礼包'});
                    }
                });
                */
            });
        }

    </script>
</head>
<body>

<div class="wrap">
    <div class="logo-meun">
        <div class="logo"><a href="<?php echo Yii::app()->createUrl("/");?>" title="天天试用"></a></div>
        <?php
            $actionId = Yii::app()->controller->action->id;
        ?>
        <ul class="meun">
            <li class="try"><a href="<?php echo Yii::app()->createUrl("/main/index/TryPageOne/");?>" title="今日试用" class="<?php echo $actionId=="TryPageOne" ? "current" : "" ?>">今日试用</a></li>
            <li class="grab"><a href="<?php echo Yii::app()->createUrl("/main/index/TryPageTwo/");?>" title="先到先抢" class="<?php echo $actionId=="TryPageTwo" ? "current" : "" ?>">先到先抢</a></li>
            <!--<li class="wishing"><a href="#" title="许愿池">许愿池</a></li>-->
        </ul>
    </div>
    <div class="notice">
        <p>每天精挑了各类5样试用宝贝，都是免费的~~~ 记得每天要来哦</p>
    </div>
    <?php echo $content; ?>
    <div class="footer"> <span class="qq">客服QQ： 800078845</span> <span class="email">商务合作邮箱：bd@lady8844.com</span> <span class="company">&copy;爱美网 版权所有 粤ICP证号:粤B2-20080029 粤ICP备09011552号</span> </div>
</div>
</body>
</html>
<?php header('P3P: CP=CAO PSA OUR'); ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/style/base.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl;?>/style/master.css">
    <script src="http://www.lady8844.com/images/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->baseUrl;?>/js/tools.js" type="text/javascript"></script>
    <script type="text/javascript">
        var tools = {
            addFav : function(item_id){
                jQuery.ajax({
                    type: "POST",
                    url: '<?php echo Yii::app()->createUrl("main/Ajax/AddTimes"); ?>',
                    data: { type : "fav_time", itemId:item_id },
                    success: function(msg){
                        console.log(msg);
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
                    }
                });
            }
        };
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
            IframeOnClick.track(document.getElementById("qzone_guanzhu"), function() {
                alert('关注成功。');
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
    <base href="http://www.myapp.com/appone/" />
</head>
<body>

<div class="wrap">
    <div class="logo-meun">
        <div class="logo"><a href="#" target="_blank" title="天天试用"></a></div>
        <ul class="meun">
            <li class="try"><a href="#" target="_blank" title="今日试用" class="current">今日试用</a></li>
            <li class="grab"><a href="#" target="_blank" title="先到先抢">先到先抢</a></li>
            <li class="wishing"><a href="#" target="_blank" title="许愿池">许愿池</a></li>
        </ul>
    </div>
    <div class="notice">
        <p>每天精挑了各类5样试用宝贝，都是免费的~~~ 记得每天要来哦</p>
    </div>
    <?php echo $content; ?>
    <div class="footer"> <span class="qq">客服QQ： 800078845</span> <span class="email">商务合作邮箱：bd@lady8844.com</span> <span class="company">&copy;爱美网 版权所有 粤ICP证号:粤B2-20080029 粤ICP备09011552号</span> </div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    var qzone='<div class="qzone"><iframe id="qzone_guanzhu" src="http://open.qzone.qq.com/like?url=http%3A%2F%2Fuser.qzone.qq.com%2F1020994989&amp;type=button&amp;width=65&amp;height=30&amp;style=3" allowtransparency="true" scrolling="no" border="0" frameborder="0" style="width:65px;height:30px;border:none;overflow:hidden; margin:17px 0 5px 15px;"></iframe><p>关注我，每天有新试用哦</p></div>';
    $(".prolist .item").hover(function(){$(this).append(qzone);},function(){ $(this).find(".qzone").remove()})
    iframeBind();
</script>
</body>
</html>
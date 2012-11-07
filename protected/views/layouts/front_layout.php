<?php header('P3P: CP=CAO PSA OUR'); ?>
<html>
<head>
    <meta charset="Utf-8"/>
    <title></title>
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
</head>
<body>
    <?php echo $content; ?>
</body>
</html>
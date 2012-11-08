$(function(){
    var dateTime = new Date();
    var difference = dateTime.getTime() - serverTime; //客户端与服务器时间偏移量

    setInterval(function(){
      $(".time").each(function(){
        var obj = $(this);
        var endTime = new Date(parseInt(obj.attr('timevalue')) * 1000);
        var nowTime = new Date();
        var nMS=endTime.getTime() - nowTime.getTime() + difference;
        var myD=Math.floor(nMS/(1000 * 60 * 60 * 24)); //天
        var myH=Math.floor(nMS/(1000*60*60)) % 24 + (myD * 24); //小时
        var myM=Math.floor(nMS/(1000*60)) % 60; //分钟
        var myS=Math.floor(nMS/1000) % 60; //秒
        //var myMS=Math.floor(nMS/100) % 10; //拆分秒
        if(myD>= 0){
            //var str = myD+"天"+myH+"小时"+myM+"分"+myS+"."+myMS+"秒";
            obj.find(".shi").eq(0).html(myH);
            obj.find(".fen").eq(0).html(myM);
            obj.find(".miao").eq(0).html(myS);
        }else{
            obj.find(".shi").eq(0).html(0);
            obj.find(".fen").eq(0).html(0);
            obj.find(".miao").eq(0).html(0);
        }
      });
    }, 200); //每个0.1秒执行一次
});

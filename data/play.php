<?php
error_reporting(0);
require 'vendor/autoload.php';
use QL\QueryList;
$player='http://www.360kan.com'.$_GET['play'];
$html = file_get_contents($player);
$rules = array(
    //采集class为two下面的第二张图片的链接
    'href' => array('.num-tab-main:not(".num-tab-main:eq(0)") a','href'),
    'dataNum' => array('.num-tab-main:not(".num-tab-main:eq(0)") a','data-num'),
);
$data = QueryList::html($html)
    ->rules($rules)
    ->query()
    ->getData();
$rules1 = array(
    //采集class为two下面的第二张图片的链接
   'tem' => array('.item-desc','html'),
);
$data1 = QueryList::html($html)
    ->rules($rules1)
    ->query()
    ->getData();
$rulesx = array(
    //采集class为two下面的第二张图片的链接
    'href' => array('.s-cover a','href'),
    'img' => array('.s-cover img','src'),
    'h1' => array('h1','html'),
    'tag' => array('.tag','html'),
);
$datax = QueryList::html($html)
    ->rules($rulesx)
    ->query()
    ->getData();
$dy_is_null = $data[1];
//如果$dy_is_null这个值为空
if(empty($dy_is_null)) {
    $rules = array(
    //采集class为two下面的第二张图片的链接
    'href' => array('#js-site-wrap a','href'),
);
    $data = QueryList::html($html)
        ->rules($rules)
        ->query()
        ->getData();
}
$arr = [$data,$datax];
//
$str = json_encode($arr);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <title>Title</title>
    <style type="text/css">
    *{
        margin: 0;
        padding: 0;
        list-style: none;
    }
    a{
        text-decoration: none;
    }
        .img-div{
            float: left;
        }
        .clear{
            clear: both;
        }
        #xx{
            float: left;
            width: 80%;
            max-width: 800px;
            margin-left: 15px;
        }
        .Watch{
            display: block;
            padding: 20px;
            text-align: center;
            border: none;
            outline: none;
            width: 120px;
            margin-left: 20px;
            background-color: #e4393c;
            color: #fff;
            font-size: 16px;
        }
        .section{
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }
        #iframe-div{
            margin:0 auto; 
            max-width: 1200px;
        }
        #iframe{
            width: 100%;
            height: 600px;
        }
        .jishu{
            margin-top: 6px;
        }
        .jishu div{
            float: left;
            font-size: 16px;
            margin-right: 8px;
            margin-bottom: 5px;
            width: 60px;
            line-height: 40px;
            text-align: center;
            background-color: #ebebeb;
            color: #4c4c4c;
        }
        .jishu100{
            margin-top: 10px;
        }
        .jishu100 a{
                display: block;
    float: left;
    width: 86px;
    height: 20px;
    line-height: 20px;
    text-align: center;
    color: #222;
    font-size: 12px;
    border-radius: 2px;
    margin-right: 20px;
    margin-bottom: 10px;
        }
        @media screen and (max-width: 1200px){
                #iframe{
                    height: 320px !important;
                    overflow: hidden;
                }
    </style>
</head>
<body>
<input type="hidden" name="dianying" id="zhi" value="">
<div id="iframe-div">
    <iframe id="iframe" src="" frameborder="0">
    </iframe>
</div>   
<div class="section">
    <div class="img-div">
        <img src="">
    </div>
    <div id="xx">
        <div class="dh-div">
            <h1>dadsadsad</h1>
        </div>
        <div>
            <?php
            $a = explode('<a href="#" class="js-open btn">展开&gt;&gt;</a>',$data1[0]['tem']);
            echo $a[0];?> 
        </div>
        <div class="button"></div>
        <div class="jishu100">
        </div>
        <div class="clear"></div>
        <div class="jishu">
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

<div style="position: fixed;bottom: 20px;right: 20px;background-color: #000;width: 50px;height: 50px;z-index: 999">
    <div style="text-align: center;line-height: 50px"><a style="color: #fff;" href="http://www.wenshao168.cn/">首页</a></div>
</div>
<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
<script>
    
    var data='<?php echo $str;?>';
    var x=JSON.parse(data);
    console.log(x);
    var Ahref=x[1][0].href;
    var dataJ=x[0];
    var lpx=[];
    for(var lp=0;lp<dataJ.length;lp++){
        if(dataJ[lp].href=='#'){

        }else{
            lpx.push(dataJ[lp]);
        }
    }
    $("#iframe").attr('src','http://api.baiyug.cn/vip/?url='+Ahref);
    $(".img-div img").attr('src',x[1][0].img);
    $(".dh-div h1").html(x[1][0].h1);
        $(".img-div a").attr('href',Ahref);
        $('#zhi').attr('value',Ahref);
        var html='<a data="'+Ahref+'" class="Watch">立即观看</a>';
        var shul=parseInt(lpx.length/100);
        var Remainder=lpx.length%100;
        //选集数 段100-200 200-300
        if(shul>=1){
            var lohtml='';
            for(var lo=1;lo<shul+1;lo++){
                if(lo==1){
                    lohtml+='<a><span class="span1">'+lo+'</span>--<span class="span2">'+Number(lo)+'00</span>集</a>';
                }else{
                     lohtml+='<a><span class="span1">'+(Number(lo)-1)+'01</span>--<span class="span2">'+lo+'00</span>集</a>';
                }
            }
            lohtml+='<a><span class="span1">'+(Number(lo)-1)+'01</span>--<span class="span2">'+(Number(lo)-1)+Remainder+'</span>集</a>';
            $(".jishu100").html(lohtml);
        };
    //选集数 段100-200 200-300

        //一开始展示集数
    if(lpx.length==2){
        $(".button").html(html);
    }else{
        var xhtml='';
        //判断是否小
        if(lpx.length<101){
            for(var xw1=0;xw1<lpx.length;xw1++){
                xhtml+='<div data="'+lpx[xw1].href+'">'+Number(xw1+1)+'</div>';
                                                }
                            }else{
                                for(var xw=0;xw<100;xw++){
                                    xhtml+='<div data="'+lpx[xw].href+'">'+lpx[xw].dataNum+'</div>';
                                                            }
                                    }
        
        $('.jishu').html(xhtml);
        }
    //一开始展示集数

    //点击集数
    $(".jishu").on('click','div',function(){
        console.log($(this).attr('data'));
        $("#iframe").attr('src','http://api.baiyug.cn/vip/?url='+$(this).attr('data'));
    });
    //点击集数

    //点击集数段
    $(".jishu100").on('click','a',function(){
            var span1=Number($(this).find('.span1').html());
            var span2=Number($(this).find('.span2').html())
            xhtml='';
            for(var jix=span1-1;jix<span2;jix++){
                  xhtml+='<div data="'+lpx[jix].href+'">'+lpx[jix].dataNum+'</div>';
            }
            $('.jishu').html(xhtml);
        });
</script>
</body>
</html>

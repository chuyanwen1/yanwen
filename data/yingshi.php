<?php
$value = $_POST['value'];
$Type = $_POST['typex'];
$Website = $_POST['Website'];
require 'vendor/autoload.php';
use QL\QueryList;

if($Type!==NULL){
    $html = file_get_contents($Type);
}else{
    $html = file_get_contents($Website.$value);
}
//抓取影片的
$rules = array(
    //采集class为two下面的第二张图片的链接
    'href' => array('.js-tongjic','href'),

    'img' => array('.js-tongjic img','src'),
    //片名
    'title' => array('.s1','html'),
    //评分
    'score' => array('.s2','html'),
    //主演
    'ToStar' => array('.star','html'),
);
$ruless = array(
    //a的href
    'Thref' => array('.js-s-filter:nth-child(2) .js-tongjip','href'),
    //a的内容
    'Thtml' => array('.js-s-filter:nth-child(2) .js-tongjip','html'),
);
$ruless3 = array(

    'Thref' => array('.js-s-filter:nth-child(3) .js-tongjip','href'),
    //a的内容
    'Thtml' => array('.js-s-filter:nth-child(3) .js-tongjip','html'),

);
$ruless4 = array(

    'Thref' => array('.js-s-filter:nth-child(4) .js-tongjip','href'),
    //a的内容
    'Thtml' => array('.js-s-filter:nth-child(4) .js-tongjip','html'),
);
$data = QueryList::html($html)
    ->rules($rules)
    ->query()
    ->getData();

$datas = QueryList::html($html)
    ->rules($ruless)
    ->query()
    ->getData();
$datas3 = QueryList::html($html)
    ->rules($ruless3)
    ->query()
    ->getData();
$data4 = QueryList::html($html)
    ->rules($ruless4)
    ->query()
    ->getData();
$ars=[$datas,$datas3,$data4];
$arr = [$data,$ars];


echo json_encode($arr);
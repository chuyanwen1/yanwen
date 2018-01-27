<?php
require 'vendor/autoload.php';
use QL\QueryList;

$html = file_get_contents('https://so.360kan.com/index.php?kw=海贼王&from=');
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
$data = QueryList::html($html)
    ->rules($rules)
    ->query()
    ->getData();
var_dump($data);die;
header("Location:play.php?play=".$data[0]['href']);

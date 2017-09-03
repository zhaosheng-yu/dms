<?php
/*
 * 图片验证码
 */

require_once dirname(dirname(dirname(__FILE__))) . '/include/init.php';

//获取随机字符
list($usec, $sec) = explode(' ', microtime());
mt_srand( (float) $sec + ((float) $usec * 100000) );
$rndstring = "";
for($i=0;$i<5;$i++){
    $rndstring .= chr(mt_rand(48,57));
}

$width = 97;
$height = 37;

//如果支持GD，则绘图
if(function_exists("imagecreate"))
{
    $_SESSION['validate'] = strtolower($rndstring);

    $rndcodelen = strlen($rndstring);
    //图片大小
    $im = imagecreate($width,$height);
    //字体
    $font_type = SYSDIR_STATICS."/font/ant3.ttf";
    //$font_type = SYSDIR_INCLUDE."/data/ant".mt_rand(1,2).".ttf";
    //背景颜色
    $bgcolor = ImageColorAllocate($im, mt_rand(210,240),mt_rand(210,240),mt_rand(210,220));
    //边框色
    //$iborder = ImageColorAllocate($im, 0,0,0);
    //字体色
    //$fontColor = ImageColorAllocate($im, mt_rand(240,245),mt_rand(0,255),mt_rand(0,255));
    $fontColor = ImageColorAllocate($im, mt_rand(100,150),mt_rand(100,150),mt_rand(0,50));
    $fontColor1 = ImageColorAllocate($im, mt_rand(100,150),mt_rand(100,150),mt_rand(0,50));
    $fontColor2 = ImageColorAllocate($im, mt_rand(180,209),mt_rand(180,209),246);
    //杂点背景线
    $lineColor[] = ImageColorAllocate($im, 130,220,245);
    $lineColor[] = ImageColorAllocate($im, 225,245,255);
    $lineColor[] = ImageColorAllocate($im, 125,150,255);
    $lineColor[] = ImageColorAllocate($im, 225,150,255);

    //背景线
    for($j=1;$j<=20;$j++) imageline($im,rand(0,90),rand(0,30),rand(0,90),rand(0,30),$lineColor[rand(0,3)]);
    for($j=3;$j<=16;$j=$j+5) imageline($im,2,$j,88,$j,$lineColor1);
    for($j=2;$j<52;$j=$j+(mt_rand(3,6))) imageline($im,$j,2,$j-6,18,$lineColor2);


    //模糊点颜色
    $pix=imagecolorallocate($im,mt_rand(0,255),111,111);
    //绘模糊作用的点
    mt_srand();
    for($i=0;$i<300;$i++)
    {
        imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$pix);
    }  

    //边框
    //imagerectangle($im, 0, 0, $width -1, $height -1, $iborder);

    $strposs = array();
    //文字
    for($i=0;$i<$rndcodelen;$i++){
        if(function_exists("imagettftext")){
            $strposs[$i][0] = $i*18+6;
            $strposs[$i][1] = mt_rand(20,25);
            imagettftext($im, 16, 5, $strposs[$i][0]+1, $strposs[$i][1]+1, $fontColor1, $font_type, $rndstring[$i]);
        }
        else{
            imagestring($im, 5, $i*10+6, mt_rand(2,4), $rndstring[$i], $fontColor);
        }
    }

    header("Pragma:no-cache\r\n");
    header("Cache-Control:no-cache\r\n");
    header("Expires:0\r\n");
    //输出特定类型的图片格式，优先级为 gif -> jpg ->png
    if(function_exists("imagejpeg")){
        header("content-type:image/jpeg\r\n");
        imagejpeg($im);
    }else{
        header("content-type:image/png\r\n");
        imagepng($im);
    }
    ImageDestroy($im);

}else{ //不支持GD，只输出字母 ABCD  
    $_SESSION['validate'] =  "abcd";

    header("content-type:image/jpeg\r\n");
    header("Pragma:no-cache\r\n");
    header("Cache-Control:no-cache\r\n");
    header("Expires:0\r\n");
}

?>

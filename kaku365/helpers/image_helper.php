<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author: chenjia404
 * @Date: 2015/3/19
 * @Time: 20:42
 */
/**
 * 生成缩略图（保持比例）
 *
 * @access global
 * @param mixed $originalImage
 * @param mixed $out_file
 * @param mixed $new_height
 * @return void
 */
function resizeImage($originalImage,$out_file ,$new_height)
{
    // Get the original geometry and calculate scales
    list($width, $height) = getimagesize($originalImage);
    $new_width = round(($width * $new_height) / $height);
    // Resize the original image
    $imageResized = imagecreatetruecolor($new_width, $new_height);
    $imageTmp = imagecreatefromjpeg ($originalImage);
    imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    // Output
    imagejpeg($imageResized, $out_file, 50);
    imageDestroy($imageResized);
    return;
}

/**
 * 获取生产验证码的配置.
 * 
 * @param string $type 验证码文字类型.
 * 
 * @return array
 */
function getCodeImgConfig($type)
{
    if (empty($type) || !in_array($type, array('number', 'letter', 'mixed'))) {
        $type = 'number';
    }
    $typeAllowRange = array(
        'number' => '023456789',
        'letter' => 'abcdefghijklmnpqrstuvwxyz',
        'mixed'  => '345678345678ABCDEFHJKMNPRSTUVWXY',
    );
    //默认参数
    $option = array(
        'length'     => 4, //验证码位数.
        'width'      => 90, // 验证码宽度.
        'height'     => 42, // 验证码高的.
        'type'       => 'number', // 新的扭曲模式对 letter 可能还需要优化下
        'background' => array(242,219,227) ,
        'font'       => __DIR__ . '/vc_f1.ttf',
        'text'       => $typeAllowRange[$type],
    );
    return $option;
}

/**
 * 生成验证妈.
 * 
 * @return array
 */
function generateVerifyCodeImg()
{
    $option = getCodeImgConfig();
    ob_start();
    $im_x = $option['width'];
    $im_y = $option['height'];
    $tlen = $option['length']; //验证码位数
    list($r, $g, $b) = $option['background']; //图片背景色
    $fontsize = $im_y * mt_rand(35, 45)/100;
    $im = imagecreatetruecolor($im_x, $im_y);
    $bottom_c = imagecolorallocate($im, 242, 219, 227);
    imagefill($im, 0, 0, $bottom_c);

    $code = '';
    $rawCode = '';
    $tco = imagecolorallocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
    for ($i = 0; $i < $tlen; $i++) {
        $t = mb_substr($option['text'], mt_rand(0, mb_strlen($option['text'], 'utf-8')-1), 1, 'utf-8');
        $tan = mt_rand(-20, 20);
        $tx = $i > 0 ? $tx + $fontsize + mt_rand($fontsize/10*-1, $fontsize/10) : mt_rand($fontsize/3, $fontsize/2);
        $ty = $fontsize + $im_y / mt_rand(2, 6);
        $rawCode .= $t;
        $t= mb_convert_encoding($t, "html-entities","utf-8" );
        imagettftext($im, $fontsize, $tan, (int)$tx, (int)$ty, $tco, $option['font'], $t);
        $code .= $t;
    }

    // 干扰线
    $crx_r = mt_rand($im_y / 5, $im_y);
    $crx_wave = mt_rand(10, 25);
    $crx_thinkness = $crx_r + mt_rand(1, 2);
    for ($crx_y = $crx_r; $crx_y <= $crx_thinkness; $crx_y++) {
        for ($crx_max = $tlen * $fontsize, $crx_x = $im_x * -1; $crx_x <= $im_x; $crx_x++) {
            $x = $crx_x / $crx_wave;
            $y = $x != 0 ? cos($x) * $crx_wave : 0;
            imagesetpixel($im, $crx_x + $im_x, $y + $crx_y, $tco);
        }
    }

    // 扭曲
    $distortion_im = imagecreatetruecolor($im_x, $im_y);
    imagefill($distortion_im, 0, 0, $bottom_c);
    for ($x = 0; $x < $im_x; $x++) {
        for ($y = 0; $y < $im_y; $y++) {
            $rgb = imagecolorat($im, $x, $y);
            imagesetpixel($distortion_im, (int)($x-1+sin($y/$im_y*2*M_PI-0.1*M_PI)*($im_y/10)), $y, $rgb);
        }
    }

    imagedestroy($im);

    // 噪点
    $dot_r = $im_y * mt_rand(3, 6);
    for ($i = 0; $i < $dot_r; $i++) {
        imagesetpixel($distortion_im, mt_rand() % $im_x, mt_rand() % $im_y, $tco);
    }

    imagegif($distortion_im);
    imagedestroy($distortion_im);
    $img = ob_get_flush();
    ob_end_clean();
    return array('img' => $img, 'code' => $rawCode);
}

function test()
{
    return 'dddd';
}
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
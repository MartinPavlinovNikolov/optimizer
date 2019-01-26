<?php

namespace Optimizer\Models;

/**
 * Description: Image-manipulations for all tasks with images
 *
 * @author Martin Nikolov
 */
class Artist {

    public function __construct() {
        
    }

    /**
     * Description: take all orders-images from incoming orders.
     * @depends class EPSON-Printer;
     * @param array by reference $arr
     * @return array $arrImg
     */
    public function colectImages(&$arr) {

        $len = count($arr);
        $arrImg = [];

        for ($i = 0; $i < $len; $i++) {

            if ($arr[$i]['note'] !== false && $arr[$i]['note'] !== 'false' && $arr[$i]['note'] !== null) {
                $arrImg[] = $arr[$i];
                unset($arr[$i]);
            }
        }
        if (count($arrImg) > 0) {
            return $arrImg;
        }
        return null;
    }

    /**
     * 
     * @Description: resize image width and height
     * 
     * @param string $file patch to the file resource
     * @param int $w width
     * @param int $h height
     */
    public function resize_image($file, $w, $h) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($w / $h > $r) {
            $newwidth = $h * $r;
            $newheight = $h;
        } else {
            $newheight = $w / $r;
            $newwidth = $w;
        }
        $src = imagecreatefrompng($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        imagealphablending($src, false);
        imagesavealpha($src, true);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagepng($dst, $file);
        imagedestroy($dst);
    }

    /**
     * 
     * @param string $string (JSON-RPC)
     * @param string $filename new location for the new image
     */
    public function saveImageFromString($string, $filename) {
        $data = imagecreatefromstring(base64_decode($string));
        imagealphablending($data, false);
        imagesavealpha($data, true);
        imagepng($data, $filename);
        imagedestroy($data);
    }

    /**
     * 
     * @param type $id user_id
     * @return false on failed and string image new name on success 
     */
    public function uploadImage($id) {
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        /* take file extention */
        $file_ext = \strtolower(end(explode('.', $file_name)));
        /* allowed extentions */
        $allowed = ['jpg', 'jpeg', 'png', 'svg'];
        if (\in_array($file_ext, $allowed) && $file_error === 0 && $file_size <= 2097152) {
            $file_new_name = $id . '.' . $file_ext;
            $file_destination = 'images/uploads/' . $file_new_name;
            foreach ($allowed as $ext) {
                if (\file_exists('images/uploads/' . $id . '.' . $ext)) {
                    unlink('images/uploads/' . $id . '.' . $ext);
                }
            }
            if (\move_uploaded_file($file_tmp, $file_destination)) {
                return $file_new_name;
            }
            return false;
        }
        return false;
    }

    public function deleteUserImage($id) {
        $allowed = ['jpg', 'jpeg', 'png', 'svg'];
        foreach ($allowed as $ext) {
            if (\file_exists('images/uploads/' . $id . '.' . $ext)) {
                unlink('images/uploads/' . $id . '.' . $ext);
            }
        }
    }

}

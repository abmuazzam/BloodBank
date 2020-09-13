<?php
namespace Core\Library;
class ThumbnailGenerator{
    const IMAGE_HANDLERS = [
        IMAGETYPE_JPEG => [
            'load'    =>  'imagecreatefromjpeg',
            'save'    =>  'imagejpeg',
            'quality' =>  100
        ],
        IMAGETYPE_PNG =>  [
            'load'    =>  'imagecreatefrompng',
            'save'    =>  'imagepng',
            'quality' =>  0
        ],
        IMAGETYPE_GIF => [
            'load'    =>  'imagecreatefromgif',
            'save'    =>  'imagegif'
        ]
    ];
    public static function createThumbnail($src,$dest,$targetWidth,$targetHeight = null){
        $type = exif_imagetype($src);
        if(!$type || !self::IMAGE_HANDLERS[$type]){
            return null;
        }
        $image = call_user_func(self::IMAGE_HANDLERS[$type]['load'],$src);
        if(!$image){
            return null;
        }
        $width = imagesx($image);
        $height = imagesy($image);
        if($targetHeight == null){
            $ratio = $width/$height;
            if($width>$height){
                $targetHeight = floor($targetWidth/$ratio);
            }else{
                $targetHeight = $targetWidth;
                $targetWidth = floor($targetWidth*$ratio);
            }
        }
        $thumbnail = imagecreatetruecolor($targetWidth,$targetHeight);

        if($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG){
            imagecolortransparent($thumbnail,imagecolorallocate($thumbnail,0,0,0));
        }
        if($type==IMAGETYPE_PNG){
            imagealphablending($thumbnail,false);
            imagesavealpha($thumbnail,true);
        }
        imagecopyresampled(
            $thumbnail,
            $image,
            0,0,0,0,
            $targetWidth,$targetHeight,
            $width,$height
        );
        return call_user_func(
            self::IMAGE_HANDLERS[$type]['save'],
            $thumbnail,
            $dest,
            self::IMAGE_HANDLERS[$type]['quality']
        );
    }
}
?>
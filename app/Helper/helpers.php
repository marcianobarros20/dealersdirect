<?php
namespace App\Helper;
use Session;
use DB;

ini_set('memory_limit', '-1');

class helpers {

	

	function createThumbnail($imageName,$newWidth,$newHeight,$uploadDir,$moveToDir)
    {
        $path = $uploadDir . '/' . $imageName;

        $mime = getimagesize($path);

        if($mime['mime']=='image/png'){ $src_img = imagecreatefrompng($path); }
        if($mime['mime']=='image/jpg'){ $src_img = imagecreatefromjpeg($path); }
        if($mime['mime']=='image/jpeg'){ $src_img = imagecreatefromjpeg($path); }
        if($mime['mime']=='image/pjpeg'){ $src_img = imagecreatefromjpeg($path); }
        if($mime['mime']=='image/gif'){ $src_img = imagecreatefromgif($path); }
    

        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);

        if($old_x > $old_y)
        {
            $thumb_w    =   $newWidth;
            $thumb_h    =   $old_y/$old_x*$newWidth;
        }

        if($old_x < $old_y)
        {
            $thumb_w    =   $old_x/$old_y*$newHeight;
            $thumb_h    =   $newHeight;
        }

        if($old_x == $old_y)
        {
            $thumb_w    =   $newWidth;
            $thumb_h    =   $newHeight;
        }

        $dst_img        =   ImageCreateTrueColor($thumb_w,$thumb_h);

        /* for png black background error Start */
        imagealphablending($dst_img, false);
        imagesavealpha($dst_img,true);
        $transparent = imagecolorallocatealpha($dst_img, 255, 255, 255, 127);
        imagefilledrectangle($dst_img, 0, 0, $thumb_w, $thumb_h, $transparent);
        /* for png black background error end */

        imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);


        // New save location
        $new_thumb_loc = $moveToDir . $imageName;

        if($mime['mime']=='image/png'){ $result = imagepng($dst_img,$new_thumb_loc,9); }
        if($mime['mime']=='image/jpg'){ $result = imagejpeg($dst_img,$new_thumb_loc,100); }
        if($mime['mime']=='image/jpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,100); }
        if($mime['mime']=='image/pjpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,100); }
        if($mime['mime']=='image/gif'){ $result = imagegif($dst_img,$new_thumb_loc,100); }


        imagedestroy($dst_img);
        imagedestroy($src_img);
        return $result;
    }

    function checkDealerLogin(){
        if( Session::has('dealer_userid')){
            return true;
        }
        return false;
    }
    function checkClientLogin(){
        if( Session::has('client_userid')){
            return true;
        }
        return false;
    }

    



    
    
    
    
    

    
    
    
    
    
    
    

    
    
    
    
	
	
	
	
	
	









    
    



}
?>
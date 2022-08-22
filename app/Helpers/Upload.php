<?php

namespace App\Helpers; 

class Upload{

      // Function for File upload
    public static function fileUpload($file, $directory){
      $validextensions = array("pdf", "doc", "docx", "xls", "xlsx", "txt", "csv", "zip", "rar", "png", "jpg", "jpeg", "gif");  
      $ext = explode('.', basename($file['name']));
      $file_extension = end($ext); 
      $file_name = md5(uniqid())."." . $ext[count($ext) -1];  
      if (($file["size"] < 5000000) && in_array($file_extension, $validextensions)) {
        $directory = $directory.'/'.date('Y').'/'.date('F').'/'.date('d');
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        if (move_uploaded_file($file['tmp_name'], $directory.'/'.$file_name)) {
          return $directory.'/'.$file_name;
        } 
      } 
      return false;
    }

      // Function for Image upload
    public static function imageUpload($file, $directory, $width=640, $height=480, $proportional=false){
      $validextensions = array("png", "jpg", "jpeg");  
      $ext = explode('.', basename($file['name']));
      $file_extension = end($ext); 
      $file_name = md5(uniqid())."." . $ext[count($ext) -1];  
      if (($file["size"] < 5000000) && in_array($file_extension, $validextensions)) {
        $directory = $directory.'/'.date('Y').'/'.date('F').'/'.date('d');
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        if (move_uploaded_file($file['tmp_name'], $directory.'/'.$file_name)) {
          self::resizeImage($directory.'/'.$file_name, null, $width, $height, $proportional);
          return $directory.'/'.$file_name;
        } 
      } 
      return false;
    }

      // Function for Image upload with thumbnails
    public static function imageUploadWithThumb($file, $directory, $thumb_ext='_thumb', $thumb_width=320, $thumb_height=240, $proportional=false){
      $validextensions = array("png", "jpg", "jpeg");  
      $ext = explode('.', basename($file['name']));
      $file_extension = end($ext); 
      $file_id = md5(uniqid());
      $file_name = $file_id.".".$ext[count($ext) -1];  
      $thumb_name = $file_id.$thumb_ext.".".$ext[count($ext) -1];  
      if (($file["size"] < 5000000) && in_array($file_extension, $validextensions)) {
        $directory = $directory.'/'.date('Y').'/'.date('F').'/'.date('d');
        if (!file_exists($directory)) {
          mkdir($directory, 0777, true);
        }
        if (move_uploaded_file($file['tmp_name'], $directory.'/'.$file_name) && copy($directory.'/'.$file_name, $directory.'/'.$thumb_name)) {
          self::resizeImage($directory.'/'.$thumb_name, null, $thumb_width, $thumb_width, $proportional);
          return $directory.'/'.$file_name;
        } 
      } 
      return false;
    }

      // Function for resizing uploaded image
    public static function resizeImage($file, $string = null, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false, $quality = 100){
      if ( $height <= 0 && $width <= 0 ) return false;
      if ( $file === null && $string === null ) return false;
   
        // Setting defaults and meta
      $info = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
      $image = '';
      $final_width = 0;
      $final_height = 0;
      list($width_old, $height_old) = $info;
      $cropHeight = $cropWidth = 0;
   
        //  Calculating proportionality
      if ($proportional) {
        if      ($width  == 0)  $factor = $height/$height_old;
        elseif  ($height == 0)  $factor = $width/$width_old;
        else                    $factor = min( $width / $width_old, $height / $height_old );
   
        $final_width  = round( $width_old * $factor );
        $final_height = round( $height_old * $factor );
      }
      else {
        $final_width = ( $width <= 0 ) ? $width_old : $width;
        $final_height = ( $height <= 0 ) ? $height_old : $height;
      $widthX = $width_old / $width;
      $heightX = $height_old / $height;
      
      $x = min($widthX, $heightX);
      $cropWidth = ($width_old - $width * $x) / 2;
      $cropHeight = ($height_old - $height * $x) / 2;
      }
   
        // Loading image to memory according to type
      switch ( $info[2] ) {
        case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
        case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
        case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
        default: return false;
      }
      
      
        // This is the resizing/resampling/transparency-preserving magic
      $image_resized = imagecreatetruecolor( $final_width, $final_height );
      if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
        $transparency = imagecolortransparent($image);
        $palletsize = imagecolorstotal($image);
   
        if ($transparency >= 0 && $transparency < $palletsize) {
          $transparent_color  = imagecolorsforindex($image, $transparency);
          $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
          imagefill($image_resized, 0, 0, $transparency);
          imagecolortransparent($image_resized, $transparency);
        }
        elseif ($info[2] == IMAGETYPE_PNG) {
          imagealphablending($image_resized, false);
          $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
          imagefill($image_resized, 0, 0, $color);
          imagesavealpha($image_resized, true);
        }
      }
      imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
    
    
        // Taking care of original, if needed
      if ( $delete_original ) {
        if ( $use_linux_commands ) exec('rm '.$file);
        else @unlink($file);
      }
   
        // Preparing a method of providing result
      switch ( strtolower($output) ) {
        case 'browser':
          $mime = image_type_to_mime_type($info[2]);
          header("Content-type: $mime");
          $output = NULL;
        break;
        case 'file':
          $output = $file;
        break;
        case 'return':
          return $image_resized;
        break;
        default:
        break;
      }
      
        // Writing image according to type to the output destination and image quality
      switch ( $info[2] ) {
        case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
        case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
        case IMAGETYPE_PNG:
          $quality = 9 - (int)((0.9*$quality)/10.0);
          imagepng($image_resized, $output, $quality);
          break;
        default: return false;
      }

    return true;
  }



}

?>

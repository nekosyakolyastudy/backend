<?php
    function createThumbnail($filename) 
    {
        $final_width_of_image = 300;
        $path_to_image_directory = 'images/tmp/';
        $path_to_thumbs_directory = 'images/thumbs/';
        if(preg_match('/[.](jpg)$/', $filename)) 
        {
            $im = imagecreatefromjpeg($path_to_image_directory . $filename);
        }
        elseif (preg_match('/[.](gif)$/', $filename))
        {
            $im = imagecreatefromgif($path_to_image_directory . $filename);
        }
        elseif (preg_match('/[.](png)$/', $filename))
        {
            $im = imagecreatefrompng($path_to_image_directory . $filename);
        }
        
        $ox = (imagesx($im)/ 2) - ($final_width_of_image /2);
        $oy = (imagesy($im)/ 2) - ($final_width_of_image /2);
        
        $nx = $final_width_of_image;
        $ny = $final_width_of_image;
        
        $nm = imagecreatetruecolor($nx, $ny);
        
        imagecopyresized($nm, $im, 0, 0, $ox, $oy, $nx, $nx, $nx, $nx);

        imagejpeg($nm, $path_to_thumbs_directory . $filename);
    };

    function createFullnail($filename) 
    {
        $final_width_of_image = 600;
        $path_to_image_directory = 'images/tmp/';
        $path_to_thumbs_directory = 'images/full/';
        if(preg_match('/[.](jpg)$/', $filename)) {
          $im = imagecreatefromjpeg($path_to_image_directory . $filename);
        } else if (preg_match('/[.](gif)$/', $filename)) {
          $im = imagecreatefromgif($path_to_image_directory . $filename);
        } else if (preg_match('/[.](png)$/', $filename)) {
          $im = imagecreatefrompng($path_to_image_directory . $filename);
        } 

        $ox = imagesx($im);
        $oy = imagesy($im);
        
        $nx = $final_width_of_image;
        $ny = floor($oy * ($final_width_of_image / $ox));
        
        $nm = imagecreatetruecolor($nx, $ny);
        
        imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
        
        if(!file_exists($path_to_thumbs_directory)) {
          if(!mkdir($path_to_thumbs_directory)) {
                 die("�������� ��������! ���������� �����!");
          } 
             }

        imagejpeg($nm, $path_to_thumbs_directory . $filename);
    };

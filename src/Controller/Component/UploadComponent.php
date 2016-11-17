<?php
/**
 * Component upload
 * Modified : 8/11/16
 * Creator: Mofla
 * Github: https://github.com/Mofla
 *
 */
namespace App\Controller\Component;
use Cake\Controller\Component;

class UploadComponent extends Component
{
    public function uploadImg($upload,$options = [])
    {
        $extensions = ['jpg','jpeg','png','gif'];
        // define type
        $file_extension = explode('/',$upload['type'])[1];
        if(!in_array($file_extension,$extensions))
        {
            return $file_newName = 'default.jpg';
        }
        // define new file name
        if(isset($options['rename']))
        {
            $file_newName = $options['rename']['id'].$this->renameByTimestamp().'.'.$file_extension;
        }
        else{
            $file_newName = $upload['name'].'.'.$file_extension;
        }
        // directory
        if(isset($options['directory']))
        {
            $directory = $options['directory'];
        }
        else {
            $directory = 'avatars';
        }
        // resize
        if(isset($options['resize']['small']))
        {
            $small = $options['resize']['small'];
        }
        else{
            $small = 40;
            $smallDir = $small.'x'.$small;
        }
        if(isset($options['resize']['medium']))
        {
            $medium = $options['resize']['medium'];
            $mediumDir = $medium.'x'.$medium;
        }
        else{
            $medium = 200;
        }
        // sub directories
        $smallDir = $small.'x'.$small;
        $mediumDir = $medium.'x'.$medium;
        // upload
        $path = WWW_ROOT . '/img/'.$directory.'/original/' . $file_newName;
        $first_copy = $upload;
        if(move_uploaded_file($upload['tmp_name'],$path))
        {
            $path = WWW_ROOT . '/img/'.$directory.'/original/' . $file_newName;
            // resize as 200x200
            $new_path = WWW_ROOT . '/img/'.$directory.'/'.$mediumDir.'/' . $file_newName;
            $this->resize($path,$file_extension,$new_path,$medium);
            //resize as 40x40
            $new_path = WWW_ROOT . '/img/'.$directory.'/'.$smallDir.'/' . $file_newName;
            $this->resize($path,$file_extension,$new_path,$small);
            return $file_newName;
        }
        else {
            return 'default.jpg';
        }
    }
    public function deleteImg($image,$options)
    {
        if(isset($options['sizes']))
        {
            foreach($options['sizes'] as $size)
            {
                $files[] = $size.'x'.$size;
            }
            $files[] = 'original';
        }
        else {
            $files = ['40x40','200x200','original'];
        }

        // directory
        if(isset($options['directory']))
        {
            $directory = $options['directory'];
        }
        else {
            $directory = 'avatars';
        }

        foreach($files as $file)
        {
            $path = WWW_ROOT . '/img/'.$directory.'/'.$file.'/' . $image;
            @unlink($path);
        }
    }

    function renameByTimestamp()
    {
        $time = microtime();
        $time = str_replace(' ','',str_replace('.','',$time));
        return $time;
    }

    function resize($file,$extension,$path, $newSize) {

        // define type of image
        switch ($extension)
        {
            case('jpg'):
                $source = imagecreatefromjpeg($file);
                break;
            case('jpeg'):
                $source = imagecreatefromjpeg($file);
                break;
            case('png'):
                $source = imagecreatefrompng($file);
                break;
            case('gif'):
                $source = imagecreatefromgif($file);
                break;
        }
        $width = imagesx($source);
        $height = imagesy($source);

        // calculate ratio
        $new_height = floor($height * ($newSize / $width));

        // it create a new virtual image
        $new_image = imagecreatetruecolor($newSize, $new_height);
        // keep transparency
        imagealphablending( $new_image, false );
        imagesavealpha( $new_image, true );

        // make a copy with new sizes from the virtual image
        imagecopyresampled($new_image, $source, 0, 0, 0, 0, $newSize, $new_height, $width, $height);

        // create image according to its extension
        switch ($extension)
        {
            case('jpg'):
                imagejpeg($new_image, $path);
                break;
            case('jpeg'):
                imagejpeg($new_image, $path);
                break;
            case('png'):
                imagepng($new_image,$path);
                break;
            case('gif'):
                imagegif($new_image,$path);
                break;
        }

    }

    function rename()
    {

    }
}
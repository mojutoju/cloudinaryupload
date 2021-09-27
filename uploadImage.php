<?php
    require('vendor/autoload.php');
    use Cloudinary\Api\Upload\UploadApi;
    use Cloudinary\Configuration\Configuration;
    Configuration::instance([
        'cloud' => [
        'cloud_name' => 'skittube', 
        'api_key' => '746839751365628', 
        'api_secret' => 'Q3EKX99ChZXVRulQ_kFnhA8r1FA'],
        'url' => [
        'secure' => true]]);
?>

<?php

function uploadImage($file, $resource_type)
{
    $tmp_name = $file['tmp_name'];
  
    if ($resource_type !== null) {
        $video =  (new UploadApi())->upload($tmp_name, [
            "resource_type" => "video"
        ]); 
        var_dump($video);

        $arr = [];
        $arr['secure_url'] = $video['secure_url'];
        $arr['original_filename'] = $video['original_filename'];
        $arr['bytes'] = $video['bytes'];
        $arr['resource_type'] = $video['resource_type'];

        return $arr;
    } else {

        
        $fileimage =  (new UploadApi())->upload($tmp_name); 
        $arr = [];
        $arr['secure_url'] = $fileimage['secure_url'];
        $arr['original_filename'] = $fileimage['original_filename'];
        $arr['bytes'] = $fileimage['bytes'];
        $arr['resource_type'] = $fileimage['resource_type'];
        
        return $arr;
    }
}
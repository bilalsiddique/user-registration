<?php

function make_user_experience_data($user_id ,  $experiences){
    $data = [];
    foreach ($experiences as $key => $experience){
        $data[] = array(
            'user_id' => $user_id,
            'company_name' => $experience['company_name'],
            'description' => $experience['description'],
            'date_added' => date("Y-m-d" , time()),
        );
    }
    return $data;
}

function printr($data)
{
    echo '<pr>';
    print_r($data);
    echo '</pre>';
}


function handle_image_upload($path , $file ,$unlinkFileName = null)
{
    printr($file);exit();
    if (isset($file['name']) && $file['name'] != '') {

        if (!file_exists($path)) {
            mkdir($path , 0777, true);
        }
        // Get the temp file path
        $tmpFilePath = $file['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts         = pathinfo($file["name"]);
            $extension          = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = array(
                'jpg',
                'jpeg',
                'png'
            );
            if (!in_array($extension, $allowed_extensions)) {
                return false;
            }
            $filename    = unique_filename($file["name"]);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
//                Old File removed
                if ($unlinkFileName && file_exists($path.$unlinkFileName))
                {
                    unlink($path.$unlinkFileName);
                }
                return $filename;
            }
        }
    }
    return false;
}

function unique_filename($name)
{
    return time().$name;
}


function get_image_upload_path(){
    return UPLOADS_PATH;
}
?>
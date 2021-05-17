<?php

class ImageService
{
    public function __construct()
    {
    }

    public function save_image($image_file): ?string // returns path to stored images
    {
        $imageExtension = $this->get_file_extension($image_file);
        $image_name = bin2hex(random_bytes(16)).".$imageExtension";
        $image_path = "images/" . $image_name; 

        $is_success = move_uploaded_file(from: $image_file, to: $image_path); 
        
        if(!$is_success)
        {
            return null;
        }
        
        return  $image_path;
    }

    public function get_file_extension($image_file)
    {
        $image_type = mime_content_type($image_file); // image/png
        $extension = strrchr( $image_type , '/');
        $extension = ltrim($extension, '/'); // png, jpg...
        return $extension;
    }

    public function is_valid_extension($extension)
    {
        $valid_extensions = ['png', 'jpg', 'jpeg', 'gif', 'zip', 'pdf'];
        $is_valid_extension = in_array($extension, $valid_extensions);
        
        return $is_valid_extension;
    }
}
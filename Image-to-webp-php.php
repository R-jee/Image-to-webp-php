/**
     * compress Image
     *
     * @param $source
     * @param $destination
     * @param $quality
     * @return void
     */
    function compressImage($source, $destination, $quality) {
        // Get image info
        if(file_exists($source)){
            $info = getimagesize($source) ?? false;
            if ($info){
                // Check the MIME type and create a new image from file
                if ($info['mime'] == 'image/jpeg') {
                    $image = imagecreatefromjpeg($source);
                } elseif ($info['mime'] == 'image/gif') {
                    $image = imagecreatefromgif($source);
                } elseif ($info['mime'] == 'image/png') {
                    $image = imagecreatefrompng($source);
                    // Adjust PNG quality (0-9 scale, lower is better quality)
                    $quality = round(($quality / 100) * 9);
                } else {
                    die('Unsupported image format!');
                }

                // Save the image with the desired quality
                if ($info['mime'] == 'image/jpeg') {
                    imagejpeg($image, $destination, $quality);
                } elseif ($info['mime'] == 'image/gif') {
                    imagegif($image, $destination);
                } elseif ($info['mime'] == 'image/png') {
                    imagepng($image, $destination, $quality);
                }

                // Clean up memory
                imagedestroy($image);
            }
        }
    }

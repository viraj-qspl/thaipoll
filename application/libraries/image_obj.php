<?php


class Image_obj {

    /**
      * Create a thumbnail image from $inputFileName no taller or wider than
      * $maxSize. Returns the new image resource or false on error.
      */
	
    function getThumbnail($inputFileName, $thumbFileName, $maxSize = 100)
    {
		$info = getimagesize($inputFileName);
		 
		$type = isset($info['type']) ? $info['type'] : $info[2];
		 
		// Check support of file type
		if ( !(imagetypes() & $type) )
		{
		// Server does not support file type
		return false;
		}
		 
		$width = isset($info['width']) ? $info['width'] : $info[0];
		$height = isset($info['height']) ? $info['height'] : $info[1];
		 
		// Calculate aspect ratio
		$wRatio = $maxSize / $width;
		$hRatio = $maxSize / $height;
		 
		// Using imagecreatefromstring will automatically detect the file type
		$sourceImage = imagecreatefromstring(file_get_contents($inputFileName));
		 
		// Calculate a proportional width and height no larger than the max size.
		if ( ($width <= $maxSize) && ($height <= $maxSize) )
		{
		// Input is smaller than thumbnail, do nothing
		return $sourceImage;
		}
		elseif ( ($wRatio * $height) < $maxSize )
		{
		// Image is horizontal
		$tHeight = ceil($wRatio * $height);
		$tWidth = $maxSize;
		}
		else
		{
		// Image is vertical
		$tWidth = ceil($hRatio * $width);
		$tHeight = $maxSize;
		}
		 
		$thumb = imagecreatetruecolor($tWidth, $tHeight);
		 
		if ( $sourceImage === false )
		{
		// Could not load image
		return false;
		}
     
		// Copy resampled makes a smooth thumbnail
		imagecopyresampled($thumb, $sourceImage, 0, 0, 0, 0, $tWidth, $tHeight, $width, $height);
		imagedestroy($sourceImage);
		 
		//return $thumb; // commented by Sandeep to make call to convertImageToFile in this function only
		
		return 	$this->convertImageToFile($thumb, $thumbFileName); // after thumb creation, this function will convert the raw image to respective file
		
    }
     
    /**
      * Save the image to a file. Type is determined from the extension.
      * $quality is only used for jpegs.
      */
    function convertImageToFile($im, $fileName, $quality = 80)
    {
		if ( !$im || file_exists($fileName) )
		{
		return false;
		}
		 
		$ext = strtolower(substr($fileName, strrpos($fileName, '.')));
		 
		switch ( $ext )
		{
			case '.gif':
				imagegif($im, $fileName);
				break;
			case '.jpg':
			case '.jpeg':
				imagejpeg($im, $fileName, $quality);
				break;
			case '.png':
				imagepng($im, $fileName);
				break;
			case '.bmp':
				imagewbmp($im, $fileName);
				break;
			default:
				return false;
		}
		 
		return true;
    }	
	
	
}
/*end of file*/
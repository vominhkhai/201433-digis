<?php
namespace MK\CommonBundle\Utilities;

use Symfony\Component\HttpFoundation\Response;
use MK\CommonBundle\MKCommonBundle;
/**
 * Utilities
 */
class Utilities
{

    /**
     * Rename for file
     *
     * @param type $originalName
     *
     * @return string $newName the new file name
     */
    public static function renameForFile($originalName = '')
    {
        $newName = '';
        if (!empty($originalName)) {
            $arr = explode(".", $originalName);
            if (!empty($arr[1])) {
                $newName = uniqid() . '.' . $arr[1];
            }
        }

        return $newName;
    }
    /**
     * generate thumb for picture
     *
     * @param string $path     is path of picutre except file name
     * @param string $filename is name of file with extension
     *
     * @return null
     */
    public static function generateThumb($path, $filename)
    {
        $linkAvatar = $path.$filename;
        $size=getimagesize($linkAvatar);
        // check $filename is image file
        $currentAvatar = null;
        switch($size["mime"]){
            case "image/jpeg":
                $currentAvatar = imagecreatefromjpeg($linkAvatar); //jpeg file
                break;
            case "image/gif":
                $currentAvatar = imagecreatefromgif($linkAvatar); //gif file
                break;
            case "image/png":
                $currentAvatar = imagecreatefrompng($linkAvatar); //png file
                break;
            default:
                return;
                break;
        }

        // get size of avatar
            $size = getimagesize($linkAvatar);
            $width = $size[0];
            $height = $size[1];
        // change to new size
            $newwidth = 150;
            $newheight = $newwidth * $height / $width;
        // create blank thumb
            $thumb = imagecreatetruecolor($newwidth, $newheight);
        // copy and resize from $currentAvatar to thum with new size
            imagecopyresized($thumb, $currentAvatar, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        // write file
             $linkThumb = $path."thumb_".$filename;
            imagejpeg($thumb, $linkThumb, 100);
    }


    /**
     * Check image file
     * @param string $filename filename
     *
     * @return boolean
     */
    public static function checkImageFile($filename)
    {
        $extension =explode('.', $filename);

        $myLastElement = end($extension);
        $mimeTypes = array(
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
        );

         if (array_key_exists(strtolower($myLastElement), $mimeTypes)) {

             return true;
         } else {

             return false;
         }
    }

    /**
     * Check valid size image
     * @param string $fileImagePath width  was accepted
     * @param int    $validWidth    width  was accepted
     * @param int    $validHeight   height was accepted
     *
     * @return boolean
     */

    public static function checkImageValidSize($fileImagePath, $validWidth, $validHeight)
    {

         list($width, $height) = getimagesize($fileImagePath);
         if ($validWidth == null) {
             if ($height<=$validHeight) {

                 return true;
             } else {

                 return false;
             }
         }

         if ($validHeight == null) {
             if ($width<=$validWidth) {

                 return true;
             } else {

                 return false;
             }

         }

         if (($width<=$validWidth) && ($height<=$validHeight)) {

             return true;
         } else {

             return false;
         }

    }


    /**
     * getSimpleTypeFile
     *
     * @param string $filename filename
     *
     * @return null|string
     */
    public static function getSimpleTypeFile($filename)
    {
        if ($filename=="") {
            return null;
        }

        $extension =explode('.', $filename);
        $myLastElement = strtolower(end($extension));
        $documentTypes = array('pdf','doc','docx','xls','xlsx','ppt','pptx');
        $imageTypes = array('jpg','gif','png','jpeg');
        $videoTypes = array('mp4','flv','wmv','webm');

        if (in_array($myLastElement, $documentTypes)) {

            return 'document';
        }

        if (in_array($myLastElement, $imageTypes)) {

            return 'image';
        }

        if (in_array($myLastElement, $videoTypes)) {

            return 'video';
        }
    }




    /**
     * Get type file
     * @param type $originalName
     *
     * @return string
     */
    public static function getTypeFile($originalName = '')
    {

        if (!empty($originalName)) {
            $arr = explode(".", $originalName);
            if (!empty($arr[1])) {

                return $arr[1];
            }
        }

        return '';
    }
    /**
     * @param type $string    string
     * @param type $strSymbol strSymbol
     * @param type $length    length
     *
     * @return type
     */
    public static function cleanString($string, $strSymbol = '-', $length = 255)
    {
        $arrCharFrom = array(
            "ạ", "á", "à", "ả", "ã", "Ạ", "Á", "À", "Ả", "Ã",
            "â", "ậ", "ấ", "ầ", "ẩ", "ẫ", "Â", "Ậ", "Ấ", "Ầ", "Ẩ", "Ẫ",
            "ă", "ặ", "ắ", "ằ", "ẳ", "ẫ", "Ă", "Ắ", "Ằ", "Ẳ", "Ẵ", "Ặ",
            "ê", "ẹ", "é", "è", "ẻ", "ẽ", "Ê", "Ẹ", "É", "È", "Ẻ", "Ẽ",
            "ế", "ề", "ể", "ễ", "ệ", "Ế", "Ề", "Ể", "Ễ", "Ệ",
            "ọ", "ộ", "ổ", "ỗ", "ố", "ồ", "Ọ", "Ộ", "Ổ", "Ỗ", "Ố", "Ồ", "Ô", "ô",
            "ó", "ò", "ỏ", "õ", "Ó", "Ò", "Ỏ", "Õ",
            "ơ", "ợ", "ớ", "ờ", "ở", "ỡ",
            "Ơ", "Ợ", "Ớ", "Ờ", "Ở", "Ỡ",
            "ụ", "ư", "ứ", "ừ", "ử", "ữ", "ự", "Ụ", "Ư", "Ứ", "Ừ", "Ử", "Ữ", "Ự",
            "ú", "ù", "ủ", "ũ", "Ú", "Ù", "Ủ", "Ũ",
            "ị", "í", "ì", "ỉ", "ĩ", "Ị", "Í", "Ì", "Ỉ", "Ĩ",
            "ỵ", "ý", "ỳ", "ỷ", "ỹ", "Ỵ", "Ý", "Ỳ", "Ỷ", "Ỹ",
            "đ", "Đ",
            "›"
        );
        $arrCharEnd = array(
            "a", "a", "a", "a", "a", "A", "A", "A", "A", "A",
            "a", "a", "a", "a", "a", "a", "A", "A", "A", "A", "A", "A",
            "a", "a", "a", "a", "a", "a", "A", "A", "A", "A", "A", "A",
            "e", "e", "e", "e", "e", "e", "E", "E", "E", "E", "E", "E",
            "e", "e", "e", "e", "e", "E", "E", "E", "E", "E",
            "o", "o", "o", "o", "o", "o", "O", "O", "O", "O", "O", "O", "O", "o",
            "o", "o", "o", "o", "O", "O", "O", "O",
            "o", "o", "o", "o", "o", "o",
            "O", "O", "O", "O", "O", "O",
            "u", "u", "u", "u", "u", "u", "u", "U", "U", "U", "U", "U", "U", "U",
            "u", "u", "u", "u", "U", "U", "U", "U",
            "i", "i", "i", "i", "i", "I", "I", "I", "I", "I",
            "y", "y", "y", "y", "y", "Y", "Y", "Y", "Y", "Y",
            "d", "D",
            ""
        );

        $arrCharFilter = str_replace($arrCharFrom, $arrCharEnd, trim($string));

        if (mb_strlen($arrCharFilter, "UTF-8") > $length) {
            $arrCharFilter = mb_substr($arrCharFilter, 0, $length, "UTF-8");
        }

        $arrCharFilter = preg_replace('/[\W|_]+/', $strSymbol, $arrCharFilter);
        $arrCharFilter = trim($arrCharFilter, '-');

        return strtolower($arrCharFilter);
    }

    /**
     * getCurrentLangKey
     * get current languange key
     *
     * @global type $kernel
     *
     * @return string
     */
    public static function getCurrentLangKey()
    {
        $request = SMAdminBundle::getContainer()->get('request');
        $langKey =  $request->getLocale();

        return $langKey;
    }
    
    /**
     * get container
     *
     * @return Object
     */
    public static function getContainer()
    {
        return MKCommonBundle::getContainer();
    }
    
    /**
     * get Entity Manager
     *
     * @return Object
     */
    public static function getEntityManager()
    {
        return MKCommonBundle::getContainer()->get('doctrine')->getManager();
    }

    /**
     * getParameter
     * get parameter from parameter file
     *
     * @param String $param name of parameter
     *
     * @return String
     */
    public static function getParameter($param)
    {
        $container = MKCommonBundle::getContainer();
        $result = $container->getParameter($param);

        return $result;
    }
    
    /**
     * upload image
     * @param FileUpload &$file
     * @param string     &$image
     * @param string     $directory
     *
     * @return void
     */
    public static function uploadImage(&$file, &$image, $directory)
    {
        // There no file so doesn't neeed to upload.
        if ($file == null) {

            return;
        }

        $newName = Utilities::renameForFile($file->getClientOriginalName());
        /**
         * check type image
         * If file input is not image type then do not update that file.
         */
        if (!Utilities::checkImageFile($newName)) {

            return;
        }
        // upload image
        $file->move($directory, $newName);
        //generate thumb for this image
        Utilities::generateThumb($directory, $newName);
         // check if we have an old image and delete it
        Utilities::removeImage($image, $directory);
        $image = $newName;
        $file = null;
    }
    /**
     * remove image with name image and directory of image
     * @param string $image
     * @param string $directory
     *
     * @return void
     */
    public static function removeImage($image, $directory)
    {
        if (isset($image) && ($image != null)) {
            // delete the old image
            $link = $directory.'/'.$image;
            if (file_exists($link) && is_file($link)) {
              unlink($link);
            }

            // delete the old image thumb
            $link = $directory.'/thumb_'.$image;
            if (file_exists($link) && is_file($link)) {
              unlink($link);
            }
        }
    }
    /**
     * upload file
     * @param FileUpload &$file
     * @param string     &$image
     * @param string     $directory
     *
     * @return void
     */
    public static function uploadFile(&$file, &$image, $directory)
    {
        if ($file == null) {

            return;
        }

        $newName = Utilities::renameForFile($file->getClientOriginalName());
        // upload image
        $file->move($directory, $newName);
         // check if we have an old image and delete it
        Utilities::removeFile($image, $directory);
        $image = $newName;
        $file = null;
    }
    /**
     * remove file
     * @param string $file
     * @param string $directory
     *
     * @return void
     */
    public static function removeFile($file, $directory)
    {
        if (isset($file) && ($file != null)) {
            // delete the old image
            $link = $directory.'/'.$file;
            if (file_exists($link) && is_file($link)) {
              unlink($link);
            }
        }
    }
    /**
     * download file
     * @param type $file
     * @param type $directory
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public static function downloadFile($file, $directory)
    {

        if (isset($file) && ($file != null)) {

            $link = $directory.'/'.$file;
            if (file_exists($link) && is_file($link)) {
                $response = new Response();

                // Set headers
                $response->headers->set('Cache-Control', 'private');
                $response->headers->set('Content-type', mime_content_type($link));
                $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($file) . '"');
                $response->headers->set('Content-length', filesize($link));

                // Send headers before outputting anything
                $response->sendHeaders();

                $response->setContent(readfile($link));
            }
        }

        return new Response('', 404, array('Content-Type', 'text/html'));
    }
    
    /**
     * generate url base on $router
     * @param String $router string router
     * @param Array  $slug   array slug
     *
     * @return string
     */

    public static function generateUrl($router, $slug = array())
    {
        $container = MKCommonBundle::getContainer();
        $result = $container->get('router')->generate($router, $slug, true);

        return $result;
    }
    /**
     * Translate message
     * @param String $string string to translate
     * @param Array  $domain domain
     *
     * @return string
     */

    public static function translate($string, $domain)
    {
        $container = MKCommonBundle::getContainer();
        $result = $container->get('translator')->trans($string, array(), $domain);

        return $result;
    }
    /**
     * remove all null value in a array
     * @param Array $array
     */
    public static function removeNullValue($array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            if ($value !== null) {
                $result[$key] = $value;
            }
        }
        
        return $result;
    }
    
    /**
     * remove all null value in a array
     * @param Array $array
     */
    public static function removeUnProperty($object, &$listProperty)
    {

        foreach ($listProperty as $key => $value) {
            if (!property_exists($object, $key)) {
                unset($listProperty[$key]);
            }
        }
    }
    
    /**
     * 
     */
    public static function getImage($image, $directoryAbsolute, $directory)
    {
        $link = $directoryAbsolute.'/'.$image;
        if (file_exists($link) && is_file($link)) {
            return $directory.'/'.$image;
        } else {
            return Utilities::getParameter('not.found.image');
        }
    }
}

<?php
namespace Proshore\EmailTemplates;

use Config;
use Exception;
use File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class EmailTemplates
 * @package Proshore\EmailTemplates
 */
class EmailTemplates
{

    public function upload(UploadedFile $file)
    {
        $isValidImage = $this->isValidImage($file);
        if (!$isValidImage) {
            return [
                "status"    =>  false,
                "message"   =>  'Not a valid image'
            ];
        }

        $uploadPath = Config::get('proshore-email-templates.upload_directory');
        $this->prepareUploadDirectory($uploadPath);

        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        $newFileName = md5($fileName . strtotime('now')) . '.' . $extension;

        $isUploaded = $file->move($uploadPath, $newFileName);

        if (!$isUploaded) {
            return [
                "status" => false,
                "message"   =>  'Could not upload image'
            ];
        }

        $originalUploadDir = $this->getRelativePath($uploadPath);
        return [
            "status"    =>  true,
            "message"   =>   '/' . $originalUploadDir . '/' . $newFileName
        ];
    }

    /**
     * Check if image is valid
     * Checks for existence of 'image' string in mime type
     *
     * @param UploadedFile $file
     * @return bool
     */
    private function isValidImage(UploadedFile $file)
    {
        if (substr($file->getMimeType(), 0, 5) == 'image') {
            return true;
        }
        return false;
    }

    /**
     * Prepare the upload directory
     * Creates file upload directory if not already exists
     *
     * @param null $absolutePath
     * @return bool
     * @throws Exception
     */
    private function prepareUploadDirectory($absolutePath = null)
    {
        if (File::isDirectory($absolutePath) && File::isWritable($absolutePath)) {
            return true;
        }

        try {
            @File::makeDirectory($absolutePath, 0777, true);
            return true;
        }
        catch (Exception $e) {
            throw new Exception("Could not make directory.");
        }
    }

    /**
     * Returns relative path of upload directory
     *
     * @param $absolutePath
     * @return string
     */
    private function getRelativePath($absolutePath)
    {
        return trim(str_replace(public_path(), '', $absolutePath), '/');
    }

}
<?php
namespace BackendBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    
    public function upload(UploadedFile $file,$pathType='')
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->targetDir.$pathType, $fileName);

        return $fileName;
    }
}
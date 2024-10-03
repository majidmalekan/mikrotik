<?php

namespace App\Traits;

use App\Enums\FileManagerStatusEnum;
use Illuminate\Contracts\Container\BindingResolutionException;
use Modules\FileManager\Repositories\FileManagerRepositoryInterface;

trait UploadFileBase64InFileManagerTrait
{
    /**
     * @param array $files
     * @param string $name
     * @param string $folder
     * @return array
     * @throws BindingResolutionException
     */
    public function uploadManyFilesBase64(array $files,string $name='',string $folder=''):array
    {
        $fileManagerIds=array();
        $fileManager=app()->make(FileManagerRepositoryInterface::class);
            foreach ($files as $key=>$file)
            {
                $fileManagerIds[]= $this->uploadFileBase64($file,$name,$folder);
            }

        return $fileManagerIds;
    }


    /**
     * @param string $file
     * @param string $name
     * @param string $folder
     * @return int
     * @throws BindingResolutionException
     */
    public function uploadFileBase64(string $file,string $name='',string $folder=''): int
    {
        $fileManager=app()->make(FileManagerRepositoryInterface::class);
        $uploaded=uploadFilesBase64Array($file,$name,$folder);
        $attributes['type']=$uploaded['file_type'];
        $attributes['status']=FileManagerStatusEnum::Active()->value;
        $media["path"]=$uploaded['path'];
        $fileUploaded=$fileManager->createWithMedia($attributes,$media);
        return $fileUploaded->id;
    }
}

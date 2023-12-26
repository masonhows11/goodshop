<?php


namespace App\Services\file;


class FileToolsService
{
    protected $file;

    protected $mainDirectory;
    protected $fileDirectory;
    protected $fileName;
    protected $fileFormat;

    protected $finalFileDirectory;
    protected $finalFileName;

    protected $fileSize;




    public function setFile($file)
    {
        $this->file = $file;
    }

    //// fileSize
    public function getFileSize()
    {
        return $this->fileSize;
    }
    public function setFileSize($file)
    {
        $this->fileSize = $file->getSize();
    }

    //// mainDirectory
    public function getMainDirectory()
    {
        return $this->mainDirectory;
    }

    public function setMainDirectory($mainDirectory)
    {
        $this->mainDirectory =  trim($mainDirectory, '/\\');
    }

    //// fileDirectory
    public function getFileDirectory()
    {
        return $this->fileDirectory;
    }

    public function setFileDirectory($fileDirectory)
    {
        $this->fileDirectory = trim($fileDirectory, '/\\');
    }

    //// fileName
    public function getFileName()
    {
        return $this->fileName;
    }
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }



    //// fileFormat
    public function getFileFormat()
    {
        return $this->fileFormat;
    }
    public function setFileFormat($fileFormat)
    {
        $this->fileFormat = $fileFormat;
    }



    ////  FinalFileDirectory
    public function getFinalFileDirectory()
    {
        return $this->finalFileDirectory;
    }
    public function setFinalFileDirectory($finalFileDirectory)
    {
        $this->finalFileDirectory = $finalFileDirectory;
    }

    //// FinalFileName
    public function getFinalFileName()
    {
        return $this->finalFileName;
    }
    public function setFinalFileName($finalFileName)
    {
        $this->finalFileName = $finalFileName;
    }


    protected function checkDirectory($fileDirectory)
    {
        if (!file_exists($fileDirectory)) {
            mkdir($fileDirectory,666,true);
        }
    }

    public function getFileAddress()
    {
        return $this->finalFileDirectory . DIRECTORY_SEPARATOR . $this->finalFileName;
    }

    protected function provider(){

        //// set properties
        $this->getFileDirectory() ?? $this->setFileDirectory(date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR .date('d'));
        $this->getFileName() ?? $this->setFileName(time());
        $this->setFileFormat(pathinfo($this->file->getClientOriginalName(),PATHINFO_EXTENSION));


        //// set final file directory
        $finalFileDirectory = empty($this->getMainDirectory())
            ? $this->getFileDirectory()
            : $this->getMainDirectory() . DIRECTORY_SEPARATOR . $this->getFileDirectory();
        $this->setFinalFileDirectory($finalFileDirectory);

        //// set final file name
        $this->setFinalFileName($this->getFileName() . '.' . $this->getFileFormat());

        //// check and create final fileDirectory
        $this->checkDirectory($this->getFinalFileDirectory());

    }


    public function setCurrentFileName()
    {
        return !empty($this->file) ?
            $this->setFileName(pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME)) :
            false;
    }
}

<?php


namespace App\Services\image;


use Doctrine\Inflector\Rules\French\Inflectible;
use function Nette\Utils\data;

class ImageServiceTools
{

    protected $image;

    protected $mainDirectory;
    protected $imageDirectory;
    protected $imageName;
    protected $imageFormat;

    protected $finalImgDirectory;
    protected $finalImgName;


    public function setImage($image)
    {
        $this->image = $image;
    }

    // mainDirectory
    public function getMainDirectory()
    {
        return $this->mainDirectory;
    }

    public function setMainDirectory($mainDirectory)
    {
        $this->mainDirectory = trim($mainDirectory, '/\\');
    }

    // imageDirectory
    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    public function setImageDirectory($imageDirectory)
    {
        $this->imageDirectory = trim($imageDirectory, '/\\');
    }

    // imageName
    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    // imageFormat
    public function getImageFormat()
    {
        return $this->imageFormat;
    }

    public function setImageFormat($imageFormat)
    {
        $this->imageFormat = $imageFormat;
    }

    //  FinalImgDirectory
    public function getFinalImgDirectory()
    {
        return $this->finalImgDirectory;
    }

    public function setFinalImgDirectory($finalImgDirectory)
    {
        $this->finalImgDirectory = $finalImgDirectory;
    }

    // FinalImgName
    public function getFinalImgName()
    {
        return $this->finalImgName;
    }

    public function setFinalImgName($finalImgName)
    {
        $this->finalImgName = $finalImgName;
    }


    protected function checkDirectory($imageDirectory)
    {

        if (!file_exists($imageDirectory)) {
            mkdir($imageDirectory,666,true);
        }
    }

    public function getImageAddress()
    {
        return $this->finalImgDirectory . DIRECTORY_SEPARATOR . $this->finalImgName;
    }

    protected function provider(){

        // set properties
        $this->getImageDirectory() ??
        $this->setImageDirectory(data('Y') . DIRECTORY_SEPARATOR . data('m') . DIRECTORY_SEPARATOR .data('d'));

        $this->getImageName() ?? $this->setImageName(time());
        $this->getImageFormat() ?? $this->setImageFormat($this->image->extention());


        // set final image directory
        $finalImageDirectory = empty($this->getMainDirectory())
            ? $this->getImageDirectory()
            : $this->getMainDirectory() . DIRECTORY_SEPARATOR . $this->getImageDirectory();
        $this->setFinalImgDirectory($finalImageDirectory);

        // set final image name
        $this->setFinalImgName($this->getImageName() . '.' . $this->getImageFormat());

        // check and create final imageDirectory
        $this->checkDirectory($this->getFinalImgDirectory());

    }


    public function setCurrentImageName()
    {
        return !empty($this->image) ?
            $this->setImageName(pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME)) :
            false;
    }


}

<?php

//created this fild handler so it way too easier than implementing each time just have
//set the approved file type file size file name and the folder name that you want to save the files
class FileHandler
{   private $status =false;
    public $thecommonfile;
    public $thefile;
    public $unique_name_generated;
    public function filedetails($thefile, $foldername, $size, $type)
    {

        $file = $thefile;
        $filename = $file["name"];
        $filetype = $file["type"];
        $filesize = $file["size"];
        $filetemp = $file["tmp_name"];

        $this->unique_name_generated = "{$foldername}/" . uniqid() . $filename;
        $filefullname = explode(".", $filename);
        $format = strtolower(end($filefullname));

        $acceptedtype = array("{$type}");
        $acceptedsize = "{$size}";

        if (in_array($format, $acceptedtype) === false) {
            $errors[] = "not the expected file format it should be a {$type} file .";
        }

        if ($filesize > $acceptedsize) {
            $errors[] = "File size must be excately {$size} MB";
        }

        if (empty($errors) == true) {
            move_uploaded_file($filetemp, $this->unique_name_generated);
            $this->status =true;
           
        } else {
            print_r($errors);
        }
        return $this->status;
    }
    public function getFilename()
    {   //this will return the created file name uniquely generated file name
        return $this->unique_name_generated;
    }

    public function validateFile($file,$type,$size){

    }
}



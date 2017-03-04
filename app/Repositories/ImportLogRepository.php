<?php


namespace App\Repositories;


class ImportLogRepository
{

    public function guid()
    {
        if (function_exists('existGuid')){
            return existGuid();
        }else{
            mt_srand((double)microtime()*10000);
            $str = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); //"-"
            $storName = substr($str,0,8).$hyphen.
                substr($str,8,4).$hyphen.
                substr($str,12,4).$hyphen.
                substr($str,16,4).$hyphen.
                substr($str,20,12).$hyphen;

            return $storName;
        }
    }

}
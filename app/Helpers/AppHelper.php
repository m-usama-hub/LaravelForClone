<?php

namespace App\Helpers;

use Auth;
use Str;

class AppHelper
{
    public static function SaveFileAndGetPath($Attachment, $AttachmentPath){
        $ErrorMsg = "";
        try
        {
            // return $Attachment->getClientOriginalExtension();
            if ($Attachment == null) {
                return null;
            }

            if ($ErrorMsg == "")
            {
                $AttachmentPath = $AttachmentPath.date("Y").'/'.date("F");
                $extension = $Attachment->getClientOriginalExtension();
                $move_file_path = public_path() . $AttachmentPath;
                $move_file_name = Str::random() . date("Ymdhisu") . '.' . $extension;
                $SavingFilePath = $AttachmentPath."/".$move_file_name;
                $FileMoved = $Attachment->move($move_file_path, $move_file_name);
            }
        }
        catch (\Throwable $e)
        {
            $ErrorMsg = "Error Occured while uploading file. Exception Msg: " . $e->getMessage();
            return array("reply"=> 0 ,"status"=> false ,"msg" => $ErrorMsg);
        }
        if ($ErrorMsg == "")
        {
            return array("reply"=> 1 ,"status"=> true ,"msg" => "File Uploaded Successfully.", "path" => $SavingFilePath);
        }
        else
        {
            return array("reply"=> 0 ,"status"=> false ,"msg" => $ErrorMsg);
        }

    }


    public static function getCMSData($key){
        $config =  CMSData::where('key',$key)->first();

        if($config != null){

            return $config->value;
        }

        return null;
    }

    public static function getSystemConfig($key){
        $config =  SystemConfig::where('config_key',$key)->first();

        if($config != null){

            return $config->config_value;
        }

        return null;
    }

    
}

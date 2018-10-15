<?php
/**
 * Created by PhpStorm.
 * User: vahid
 * Date: 10/15/2018
 * Time: 5:34 PM
 */

namespace App\Repositories;


class FileRepository
{
    public static function getUrl($url){
        return config('filesystems.disks.ftp.access_url').$url;
    }

}
<?php

namespace App\Providers;


use App\Models\PrimaryInfo;
use Illuminate\Support\ServiceProvider;
use Image,Auth;
use App\User;
use Yajra\Acl\Models\Role;

class MyHelperProvider extends ServiceProvider
{
    static public function userRole($id=null){

        $user = Role::join('role_user','role_user.role_id','roles.id')
            ->select('roles.slug as role','roles.id as role_id');

        if ($id){
            $user=$user->where('role_user.user_id',$id);
        }else{
            $user=$user->where('role_user.user_id',Auth::user()->id);
        }
        return $user->first();
    }
    static public function bkash()
    {
        $config = [
            "tokenURL" => "https://checkout.pay.bka.sh/v1.2.0-beta/checkout/token/grant",
            "createURL" => "https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/create",
            "executeURL" => "https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/execute/",
            "queryURL" => "https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/query/",
            "searchURL" => "https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/search/",
            "script" => "https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js",
            "app_key" => "7g9nt7rrbpqd4kjq3tebfhnta4",
            "app_secret" => "14ejrl7qbf2ohhv7hgkoo7adgvppf5cpl0q2vn9jfm6lo57eaj5d",
            "username" => "ACHIEVEMENTCARE",
            "password" => "aC@1iE9vmEnT012",
        ];

        return (object)$config;
    }


    static public function slugify($text){
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    /* Convert in word taka */
    static public function taka($number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . ' Taka Only ' : '');
    }

    static public function photoUpload($photoData,$folderName,$width=null,$height=null){

        $photoOrgName=self::slugify($photoData->getClientOriginalName());
        $photoType=$photoData->getClientOriginalExtension();

        //$fileType = $photoData->getClientOriginalName();
        $fileName =substr($photoOrgName,0,-4).date('d-m-YH-i-s').'.'.$photoType;
        $path2 = $folderName. date('Y/m/d');
        //return $path2;
        if (!is_dir($path2)) {
            mkdir("$path2", 0777, true);
        }
        if ($width!=null && $height!=null){ // width & height mention-------------------
            $img = \Image::make($photoData);
            $img->resize($width, $height);
            $img->save($folderName. date('Y/m/d/') . $fileName);
            return $photoUploadedPath=$folderName . date('Y/m/d/') . $fileName;
        }elseif ($width!=null){ // only width mention-------------------
            $img = \Image::make($photoData);
            $img->resize($width,null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($folderName. date('Y/m/d/') . $fileName);
            return $photoUploadedPath=$folderName . date('Y/m/d/') . $fileName;
        }else{
            $img = \Image::make($photoData);
            $img->save($folderName. date('Y/m/d/') . $fileName);
            return $photoUploadedPath=$folderName . date('Y/m/d/') . $fileName;
        }


    }

        static public function fileUpload($filedata,$folderName){

        $fileType = $filedata->getClientOriginalExtension();
        $fileName = rand(1, 1000) . date('dmyhis') . "." . $fileType;
        $path2 = $folderName. date('Y/m/d');
        //return $path2;
        if (!is_dir($path2)) {
            mkdir("$path2", 0777, true);
        }
        $img =move(public_path($filedata) . $folderName);
        //$img->resize(400, 330);
        $img->save($folderName. date('Y/m/d/') . $fileName);
        return $photoUploadedPath=$folderName . date('Y/m/d/') . $fileName;

    }

    static public function hrmConfig(){
        $data = [
            'in_time'=>'09:00 AM',
            'out_time'=>'06:00 PM',
            'off_days'=>'Friday,Saturday',
        ];
        return $config = (object) $data;
    }

    static public function info(){
        return PrimaryInfo::first();
    }
}

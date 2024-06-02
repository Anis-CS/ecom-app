<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Brick\Math\shiftedLeft;

class Courier extends Model
{
    use HasFactory;

    private static $courier;

    public static function saveInfo($request, $id = null)
    {
        if ($id !== null) {
            self::$courier = Courier::find($id);
        } else {
            self::$courier = new Courier();
        }
        if ($request->logo)
        {
            if (file_exists(self::$courier->logo)) {
                unlink(self::$courier->logo);
            }
            $logoUrl = getImageUrl($request->logo, 'upload/courier-images/');
        }
        else
        {
            $logoUrl = self::$courier->logo;
        }
        self::$courier->name = $request->name;
        self::$courier->email = $request->email;
        self::$courier->mobile = $request->mobile;
        self::$courier->cost = $request->cost;
        self::$courier->logo = $logoUrl;
        self::$courier->save();
    }

    public static function checkStatus($id)
    {
        self::$courier = Courier::find($id);
        if (self::$courier->status == 1){
            self::$courier->status = 0;
        }else{
            self::$courier->status = 1;

        }
        self::$courier->save();
    }
    public static function deletedInfo($id)
    {
        self::$courier = Courier::find($id);
        if (self::$courier->logo)
        {
            if (file_exists(self::$courier->logo))
            {
                unlink(self::$courier->logo);
            }
        }
        self::$courier->delete();
    }
}

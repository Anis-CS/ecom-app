<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Brick\Math\shiftedLeft;

class Offer extends Model
{
    use HasFactory;
    private static $offer, $offerDetail, $offerDetails;

    public static function saveInfo($request,$id=null)
    {
        if ($id !=null)
        {
            self::$offer = Offer::find($id);
        }
        else
        {
            self::$offer = new Offer();
        }
        if ($request->image)
        {
            if (file_exists(self::$offer->image)) {
                unlink(self::$offer->image);
            }
            $imageUrl = getImageUrl($request->image, 'upload/offer-images/');
        }
        else
        {
            $imageUrl = self::$offer->image;
        }

        return self::saveBasicInfo(self::$offer, $request, $imageUrl);

    }

    private static function saveBasicInfo($offer, $request, $imageUrl)
    {
        $startDateTimeArray  = explode('T',$request->start_date);
        $endDateTimeArray  = explode('T',$request->start_date);

        $offer->name                        = $request->name;
        $offer->description                 = $request->description;
        $offer->offer_type                  = $request->offer_type;
        $offer->start_date                  = $startDateTimeArray[0];
        $offer->start_date_timestamp        = ($startDateTimeArray[0]);
        $offer->start_datetime              = $request->start_date;
        $offer->start_datetime_timestamp    = strtotime($request->start_date);
        $offer->end_date                    = $endDateTimeArray[0];
        $offer->end_date_timestamp          = strtotime($endDateTimeArray[0]);
        $offer->end_datetime                = $request->end_date;
        $offer->end_datetime_timestamp      = strtotime($request->end_date);
        $offer->percentage                  = $request->percentage;
        $offer->image                       = $imageUrl;
        $offer->save();
        return $offer;
    }

    public static function OfferDelete($id)
    {
      self::$offer = Offer::find($id);
      if(file_exists(self::$offer->image))
      {
          unlink(self::$offer->image);
      }
      self::$offerDetails = OfferDetail::where('offer_id',self::$offer->id)->get();
        foreach (self::$offerDetails as self::$offerDetail)
        {
            self::$offerDetail->delete();
        }
      self::$offer->delete();
    }

    public static function statusCheck($id)
    {
        self::$offer = Offer::find($id);
        if (self::$offer->status== 1){
            self::$offer->status =0;
        }else{
            self::$offer->status = 1;
        }
        self::$offer->save();
    }


    public function offerDetails()
    {
        return $this->hasMany(OfferDetail::class);
    }

}

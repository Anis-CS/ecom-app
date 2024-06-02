<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferDetail extends Model
{
    use HasFactory;
    private static $productOffer, $productOffers;

    public static function newOfferDetail($products, $offerId)
    {
       foreach($products as $product)
       {
           self::$productOffer = new OfferDetail();
           self::$productOffer->offer_id = $offerId;
           self::$productOffer->product_id = $product;
           self::$productOffer->save();
       }
    }
    public static function updateOfferDetail($products,$offerId){
        self::$productOffers  = OfferDetail::where('product_id',$offerId)->get();
        foreach( self::$productOffers as self::$productOffer)
        {
            self::$productOffer->delete();
        }
        OfferDetail::newOfferDetail($products, $offerId);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

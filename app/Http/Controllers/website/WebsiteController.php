<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Offer;
use App\Models\OfferDetail;
use App\Models\PrivacyPolicy;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\ShippingArea;
use App\Models\SubCategory;
use App\Models\Wishlist;
use Cart;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use function Symfony\Component\String\length;

class WebsiteController extends Controller
{


    private $product, $wishlist;
    public function index()
    {
        $offers  = Offer::where('status' ,1)->get();
        $data=[];
        $index=1;
        foreach($offers as $offer)
        {
            foreach ($offer->offerDetails as $offerDetail){
                $product  = Product::find($offerDetail->product_id);

                $data[$index]['id'] = $product->id;
                $data[$index]['name'] = $product->name;
                $data[$index]['percentage'] = $offer->percentage;
                $data[$index]['image'] = $product->image;
                $data[$index]['sales_count'] = $product->sales_count;
                $index++;
            }
        }

        $key_value = array_column($data, 'sales_count');
        array_multisort($key_value,SORT_DESC, $data);
        $newArrayOne = array_slice($data,0, 2, true);
        $newArrayTwo = array_slice($data,3, 3, true);

        return view('website.home.index',[
            'products'=>Product::where('status',1)->latest()->take(6)->get(),
            'subcategories' =>SubCategory::where('status',1)->get(),
            'offers'=>Offer::where('status',1)->get(),
            'offer_one_products' => $newArrayOne,
            'offer_two_products' => $newArrayTwo,
            'combo_offors'=>Offer::where(['status'=>1,'offer_type'=>2])->latest()->take(3)->get(),
            'today_offers'=>Offer::where(['status'=>1,'offer_type'=>3])->latest()->get(),
            'hotoffers'=>Offer::where(['status'=>1,'offer_type'=>4])->latest()->take(1)->get(),

        ]);
    }

    public function product()
    {
        return view('website.product.index',[
            'products'=>Product::where('status',1)->latest()->get(),
            'cartsProduct'=>Cart::content(),
            'categories'=>Category::where('status',1)->get(),
        ]);
    }


    public function productDetails($id)
    {

        $this->product = Product::find($id);
        return view('website.product.product-details',[
            'product'        => $this->product,
            'productColors'  => ProductColor::where('product_id',$this->product->id)->get(),
            'productSizes'   => ProductSize::where('product_id',$this->product->id)->get(),
            'productImages'  => ProductImage::where('product_id',$this->product->id)->get(),
            'ShippingAreas'  =>ShippingArea::all(),
            'cartsProduct'   =>Cart::content(),
            'categories'     =>Category::where('status',1)->get(),
            'reviews'        =>ProductReview::where(['product_id' => $id, 'status' =>1 ])->latest()->get(),
        ]);

//        return view('website.product.product-details');
    }


    public function review(Request $request,$id){
        ProductReview::newReview($request,$id);
        return back()->with('message','Review Post successfully. It will published after Approved this.');
    }

    public function offer($id)
    {
        return view('website.product.offer.index',
            [
                'offer'=>Offer::find($id),
            ]);
    }
    public function cart()
    {
        return view('website.cart.index');
    }

    public function shippingPolicy(){
        return view('website.pages.shipping-policy',['shipping_policy' =>PrivacyPolicy::latest()->first()->shipping_policy]);
    }
    public function returnPolicy(){
        return view('website.pages.return-policy',['return_policy' =>PrivacyPolicy::latest()->first()]);
    }
    public function termsAndCondition(){
        return view('website.pages.terms-and-condition',['term_policy' =>PrivacyPolicy::latest()->first()->terms_policy]);
    }

}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\OfferDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.offer.index',
            [
                'offers'=>Offer::all(),
                'offerDeatails'=>OfferDetail::all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.offer.add',
        [
            'products'=>Product::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    private $offer;

    public function store(Request $request)
    {
        $this->offer = Offer::saveInfo($request);
        OfferDetail::newOfferDetail($request->product, $this->offer->id);

        foreach ($request->product as $id)
        {
            $product                    = Product::find($id);
            $sellingPrice               = $product->regular_price - round( (($product->regular_price * $request->percentage)/100));
            $product->selling_price     = $sellingPrice;
            $product->discount_type     = 'percent';
            $product->discount_amount   = $request->percentage;
            $product->save();
        }

        return redirect('offers')->with('message','Product Offer Create info successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Offer::statusCheck($id);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        return view('admin.product.offer.edit',
            [
                'products'      =>    Product::all(),
                'offer'         =>    $offer,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->offer = Offer::saveInfo($request,$id);
        OfferDetail::updateOfferDetail($request->product, $this->offer->id);
        return redirect('offers')->with('message','Product Offer Create info successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Offer::OfferDelete($id);
        return back();
    }
}

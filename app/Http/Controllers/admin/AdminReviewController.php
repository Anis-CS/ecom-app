<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index()
    {
        return view('admin.product.review.index',[
            'reviews'       => ProductReview::latest()->get(),
        ]);
    }
    public function updateStatus($id)
    {
        ProductReview::updateReviewStatus($id);
        return back()->with('message','Review status update successfully.');
    }
    public function deleteStatus($id)
    {
        ProductReview::deleteReview($id);
        return back()->with('message','Are you sure delete This.');
    }
}

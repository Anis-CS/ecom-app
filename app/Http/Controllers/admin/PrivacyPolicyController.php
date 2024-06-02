<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.privacy-policy.index',['privacy'=>PrivacyPolicy::latest()->first()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.privacy-policy.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PrivacyPolicy::newPrivacyPolicy($request);
        return back()->with('message','Privacy Policy update Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.privacy-policy.update');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        PrivacyPolicy::updatePrivacyPolicy($request,$id);
        return back()->with('message','Privacy Update Success.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

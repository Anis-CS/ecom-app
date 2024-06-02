<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courier;

class CourierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.courier.index',['couriers'=>Courier::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.courier.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Courier::saveInfo($request);
        return redirect('couriers')->with('message','Create a New Courier Information');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Courier::checkStatus($id);
        return back()->with('message','Change Courier Status.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.courier.edit',['courier'=>Courier::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Courier::saveInfo($request,$id);
        return redirect('couriers')->with('message','Updating Courier Information.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Courier::deletedInfo($id);
        return back();
    }
}

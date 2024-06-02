@extends('admin.master')

@section('title')
    Offer-update
@endsection

@section('body')

    <!--app-content open-->
    <div class="app-content main-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">


                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title"> Product Offer </h1>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Layouts</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- row -->
                <div class="row row-deck">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <span><h3 class="card-title">Edit Offer Form</h3></span>
                                <a href="{{ route('offers.index') }}" class="btn btn-primary ms-auto d-block">Manage offers</a>
                            </div>
                            <div class="card-body">
                                <p class="text-center text-success">{{session('message')}}</p>
                                <form class="form-horizontal" action="{{ route('offers.update',$offer->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-4">
                                        <label for="Offername" class="col-md-4 form-label">Offer Name</label>
                                        <div class="col-md-8">
                                            <input class="form-control" name="name" value="{{ $offer->name }}" type="text">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="" class="col-md-4 form-label">Product Code</label>
                                        <div class="col-md-8 form-group">
                                            <select multiple name="product[]" data-placeholder="Select Product" class="form-control select2 " id="">
                                                <option>Select Product code</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" @foreach( $offer->offerDetails as $offerDetail) @selected($offerDetail->product_id == $product->id) @endforeach>{{ $product->code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="str_date" class="col-md-4 form-label">Offer Type</label>
                                        <div class="col-md-8">
                                            <label><input type="radio" name="offer_type" value="1" {{ $offer->offer_type == '1' ? 'checked' : ' ' }}>Mega Offer</label>
                                            <label><input type="radio" name="offer_type" value="2" {{ $offer->offer_type == '2' ? 'checked' : ' ' }}>Combo Offer</label>
                                            <label><input type="radio" name="offer_type" value="3" {{ $offer->offer_type == '3' ? 'checked' : ' ' }}>Today Offer</label>
                                            <label><input type="radio" name="offer_type" value="4" {{ $offer->offer_type == '4' ? 'checked' : ' ' }}>Hot Offer</label>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="str_date" class="col-md-4 form-label">Offer Description</label>
                                        <div class="col-md-8">
                                            <textarea type="text" id="summernote" class="form-control"  name="description" cols="30" rows="10" >{!! $offer->name !!} </textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="" class="col-md-4 form-label">Start Date</label>
                                        <div class="col-md-8">
                                            <input type="datetime-local" class="form-control"  value="{{ $offer->start_datetime }}" name="start_date" cols="30" rows="10" >
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="end_date" class="col-md-4 form-label">Start Date</label>
                                        <div class="col-md-8">
                                            <input type="datetime-local" class="form-control"  name="end_date"  value="{{ $offer->end_datetime }}" cols="30" rows="10">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="Offer_percent" class="col-md-4 form-label">Discount Percentage</label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control"  name="percentage"  value="{{ $offer->percentage }}" cols="30" rows="10">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="image" class="col-md-4 form-label">Image</label>
                                        <div class="col-md-8">
                                            <input type="file" class="dropify" id="image" name="image">
                                            <img src="{{ asset($offer->image) }}" width="100px">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Create New Offer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /row -->

            </div>
        </div>
    </div>
    <!-- CONTAINER CLOSED -->

@endsection

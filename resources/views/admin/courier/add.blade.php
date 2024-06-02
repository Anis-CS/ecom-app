@extends('admin.master')

@section('title')
    Add-Courier
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
                        <h1 class="page-title">Form Layouts</h1>
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
                                <span><h3 class="card-title">Add Courier Form</h3></span>
                                <a href="{{ route('couriers.index') }}" class="btn btn-primary ms-auto d-block">Manage Courier</a>
                            </div>
                            <div class="card-body">
                                <p class="text-center text-success">{{session('message')}}</p>
                                <form class="form-horizontal" action="{{ route('couriers.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-4">
                                        <label for="CourierName" class="col-md-3 form-label">Courier Name</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="name" placeholder="Enter Courier name" type="text">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="description" class="col-md-3 form-label">Email</label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" name="email" cols="30" rows="10" placeholder="Enter Your Email">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="description" class="col-md-3 form-label">Mobile</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="mobile" cols="30" rows="10" placeholder="Enter Your Mobile">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="description" class="col-md-3 form-label">Cost</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="cost" cols="30" rows="10" placeholder="Enter Courier Cost">
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="image" class="col-md-3 form-label">Logo</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="logo" type="file" accept="image/*">
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Add New Courier</button>
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

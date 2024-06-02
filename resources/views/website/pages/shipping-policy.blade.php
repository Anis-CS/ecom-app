@extends('website.master')

@section('title')
    Return Policy
@endsection


@section('body')
    <style>
        /* Basic styling */
        p {
            margin-bottom: 20px;
        }
        /* Style for the return policy */
        .return-policy {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .return-policy li{
            font-size: 20px;
            font-family: "Times New Roman";
        }
        .return-policy .nb{
            text-align: center;
            border-top: 1px solid #D6D6D6;
            color: #01132d;
            margin-top: 48px;
        }
    </style>

    <div class="container-fluid col-md-12 m-2 p-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="return-policy">
                    <h2>Return &amp; Refund Policy of Bigdeal</h2>
                    <hr>
                    <div>{!! $shipping_policy !!}</div>
                    <div class="nb">
                        <h3 class="mt-3 ">Call the number below for details</h3>
                        <a href="tel:16793">16793</a> Or <a href="tel:09678002003">09678002003</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


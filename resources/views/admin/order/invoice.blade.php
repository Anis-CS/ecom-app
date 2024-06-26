@extends('admin.master')

@section('title')
    Manage Order
@endsection

@section('body')
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>

    <!--app-content open-->
    <div class="app-content main-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">


                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Order</h1>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Order</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- Row -->
                <!-- End Row -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-bottom">
                                <span><h3 class="card-title"> Order Invoice</h3></span>
                            </div>
                            <div class="card-body">
                                <div class="invoice-box">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr class="top">
                                            <td colspan="2">
                                                <table>
                                                    <tr>
                                                        <td class="title">
                                                            <img
                                                                src="https://sparksuite.github.io/simple-html-invoice-template/images/logo.png"
                                                                style="width: 100%; max-width: 300px"
                                                            />
                                                        </td>

                                                        <td>
                                                            Invoice #:000{{ $order->id }}<br />
                                                            Created: {{ date('F j Y',strtotime($order->order_date)) }}<br />
                                                            Delivery Date: {{ date('F j Y',strtotime($order->delivery_date)) }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr class="information">
                                            <td colspan="2">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Sparksuite, Inc.<br />
                                                            12345 Sunny Road<br />
                                                            Sunnyville, CA 12345
                                                        </td>

                                                        <td>
                                                            {{ $order->customer->name }}.<br/>
                                                            {{ $order->customer->phone }}<br/>
                                                            {{ $order->customer->email }}<br/>
                                                            {{ $order->delivery_address }}<br/>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="3">
                                                <table>
                                                    <tr class="heading">
                                                        <td>Item</td>
                                                        <td>Code</td>
                                                        <td>Color</td>
                                                        <td>Size</td>
                                                        <td>Qty</td>
                                                        <td>Price</td>
                                                    </tr>
                                                    @foreach($orderDetails as $item)
                                                    <tr>
                                                        <td>{{ $item->product_name }}</td>
                                                        <td>{{ $item->product_code }}</td>
                                                        <td>{{ $item->product_color }}</td>
                                                        <td>{{ $item->product_size }}</td>
                                                        <td>{{ $item->product_qty }}</td>
                                                        <td>{{ $item->product_price }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>

                                        <tr class="total">
                                            <td></td>

                                            <td>Tax Amount : {{ $order->tax_total }}<br>
                                                Delivery : {{ $order->shipping_total }}<br>
                                                Total : {{ $order->shipping_total+ $order->order_total }}<br>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->



            </div>
        </div>
    </div>

    <!-- CONTAINER CLOSED -->
@endsection


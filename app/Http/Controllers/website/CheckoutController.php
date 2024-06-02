<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Mail\CheckoutMail;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ShippingArea;
use Illuminate\Http\Request;
use Cart;
use Session;
use Mail;
use function Livewire\Features\SupportTesting\get;
use App\Http\Controllers\SslCommerzPaymentController;

class CheckoutController extends Controller
{
    private $price, $customer, $order, $orderDetail;

    public function index(){

        if(Session::get('customer_id')){
            $this->customer = Customer::find(Session::get("customer_id"));
        }
        else{
            $this->customer = '';
        }

        return view('website.checkout.index',[
            'products' => Cart::content(),
            'areas'    =>ShippingArea::where('status',1)->get(),
            'customer' => $this->customer,
            'categories' => Category::all(),
            'cartsProduct' => Cart::content(),
        ]);
    }

    public function getPriceByArea(){
        $this->price = ShippingArea::where('id',$_GET['id'])->first();
        return response()->json($this->price);
    }

    public function newOrder(Request $request){

        if (Session::get('customer_id')){
            $this->customer = Customer::find(Session::get('customer_id'));
        }
        else{

            $this->customer = Customer::where('phone', $request->phone)->orWhere('email', $request->email)->first();
            if (!$this->customer){
                $this->customer = Customer::saveInfo(($request));
            }
            Session::put('customer_id', $this->customer->id);
            Session::put('customer_name', $this->customer->name);
        }
        if($request->payment_method == 'Online')
        {
            $sslCommerzPayment = new SslCommerzPaymentController();
            $sslCommerzPayment->index($request, $this->customer);
        }
        else
        {
            $this->order = Order::newOrder($request, $this->customer);
            OrderDetail::newOrderDetail($this->order);
            //Valid Email Check
            $title  ="Your Order Place Successfully.";
            $body   ="Thanks For Order";
            Mail::to($request->email)->send(new CheckoutMail($title,$body));
        }

        return redirect('/complete-order')->with('message', 'Congratulations your order info post succesfully. Please Wait Until We Contact With you');
    }

    public function completeOrder(){
        return view('website.checkout.complete-order',[
            'categories' => Category::where('status', 1)->get(),
            'cartsProduct' => Cart::content(),
        ]);
    }
}

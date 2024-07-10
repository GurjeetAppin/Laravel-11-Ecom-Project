<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

/* Start Add To cart Functionality */
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
/* End Add To cart Functionality */

/* Stripe Payment Method */
use Session;
use Stripe;

class HomeController extends Controller
{
    //
    public function index(){
        $user = User::where('usertype','user')->get()->count();
        $products = Product::all()->count();
        $orders = Order::all()->count();
        $delivered = Order::where('status','Delivered')->count();
        return view('admin.index',['user' => $user, 'products' => $products, 'orders' => $orders, 'delivered' => $delivered]);
    }

    public function home(){
        $products = Product::all();
        
        if(Auth::id()){ // Auth::id() :- It will check the login user id.
            $user = Auth::user();
            $userId = $user->id;
            //$countUserID = Cart::count('user_id',$userId); // this is working also
            $countUserID = Cart::where('user_id',$userId)->count();
        }else{
            $countUserID = '';
        }
        return view('home.index', ['products' => $products, 'countUserId' => $countUserID]);
    }

    public function login_home(){
        $products = Product::all();
        $user = Auth::user();
        $userId = $user->id;
        //$countUserID = Cart::count('user_id',$userId); // this is working also
        $countUserID = Cart::where('user_id',$userId)->count();
        return view('home.index', ['products' => $products, 'countUserId' => $countUserID]); 
    }

    public function product_details($id){
        $product = Product::find($id); 
        $category = Category::find($product->category);
        if(Auth::id()){ // Auth::id() :- It will check the login user id.
            $user = Auth::user();
            $userId = $user->id;
            //$countUserID = Cart::count('user_id',$userId); // this is working also
            $countUserID = Cart::where('user_id',$userId)->count();
        }else{
            $countUserID = '';
        }
        return view('home.product_detail', ['product' => $product, 'categoryName' => $category, 'countUserId' => $countUserID]);
    }

    /* Start Add To cart Functionality */
    public function add_cart($id){
        $productId = $id;
        $user = Auth::user();
        $userId = $user->id;
        $data = new Cart;
        $data->user_id = $userId;
        $data->product_id = $productId;
        $data->save(); 
        toastr()->timeOut(5000)->closeButton()->addSuccess('Product Add to cart Successfully') ;
        return redirect()->back();
    }

    public function mycart(){
        if(Auth::id()){
            $user = Auth::user();
            $userId = $user->id;
            $countUserId = Cart::where('user_id', $userId)->count();
            $cartData = Cart::where('user_id', $userId)->get();
        }

        return view('home.mycart',['countUserId' => $countUserId, 'cart' => $cartData]);
    }

    public function confirm_order(Request $request){
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
       
        $userId = Auth::user()->id; // Get the logined in user id.
        $cart = Cart::where('user_id',$userId)->get(); // Get the data form cart of logined user.
        foreach($cart as $carts){
            $order = new Order;
            $order->name =  $name;
            $order->rec_address =  $address;
            $order->phone =  $phone;
            $order->user_id = $userId;
            $order->product_id = $carts->product_id;
            $order->save();
        }
        $cart_remove = Cart::where('user_id', $userId)->get();
        foreach($cart_remove as $remove){
            $data = Cart::find($remove->id);
            $data->delete();
        }
        toastr()->timeOut(5000)->closeButton()->addSuccess('Order Confirmed') ;
        return redirect()->back(); 
    }

    public function myOrders(){
        $user = Auth::user();
        $userId = $user->id;
        $countUserId = Cart::where('user_id', $userId)->get()->count();
        $order = Order::where('user_id', $userId)->get();
        return view('home.orders',['countUserId' => $countUserId,'order' => $order]);
    }


    /* Stripe Payment method */
    public function stripe($value)
    {
        return view('home.stripe',['value' => $value]);
    }
    public function stripePost(Request $request, $value)
    {
       
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment" 
        ]);
    
        $name = Auth::user()->name;
        $phone = Auth::user()->phone;
        $address = Auth::user()->address;
        $userId = Auth::user()->id; // Get the logined in user id.
        $cart = Cart::where('user_id',$userId)->get(); // Get the data form cart of logined user.
        foreach($cart as $carts){
            $order = new Order;
            $order->name =  $name;
            $order->rec_address =  $address;
            $order->phone =  $phone;
            $order->user_id = $userId;
            $order->product_id = $carts->product_id;
            $order->payment_status = "paid";
            $order->save();
        }
        $cart_remove = Cart::where('user_id', $userId)->get();
        foreach($cart_remove as $remove){
            $data = Cart::find($remove->id);
            $data->delete();
        }
        toastr()->timeOut(5000)->closeButton()->addSuccess('Order Confirmed') ;
        return redirect('mycart'); 
    }

    public function shop(){
        $products = Product::all();
        if(Auth::id()){
            $user = Auth::user();
            $userId = $user->id;
            $countUserId = Cart::where('user_id',$userId)->count();
        }else{
            $countUserId = '';
        }
        return view('home.shop',['products' => $products, 'countUserId' => $countUserId]);
    }

    public function why(){
        if(Auth::id()){
            $user = Auth::user();
            $userId = $user->id;
            $countUserId = Cart::where('user_id',$userId)->count();
        }else{
            $countUserId = '';
        }
        return view('home.why',['countUserId' => $countUserId]);
    }

    public function testimonial(){
        if(Auth::id()){
            $user = Auth::user();
            $userId = $user->id;
            $countUserId = Cart::where('user_id',$userId)->count();
        }else{
            $countUserId = '';
        }
        return view('home.testimonial',['countUserId' => $countUserId]);
    }

    public function contact(){
        if(Auth::id()){
            $user = Auth::user();
            $userId = $user->id;
            $countUserID = Cart::where('user_id', $userId)->count();
        }else{
            $countUserID = '';
        }
        return view('home.contact',['countUserId' => $countUserID]);
    }



}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Order as NotificationsOrder;
use App\Notifications\OrderNotify;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class StripeController extends Controller
{

    public function credit_card()
    {
        $total = 0;
        $cart = Cart::all()->where("user_id", Auth::user()->id);
        foreach ($cart as $item) {
            $total += $item->price * $item->qtn;
        }
        return view("credit_card", ["total" => $total, "products" => $cart]);
    }

    public function CompletePayment(Request $request)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $proccess = Stripe\Charge::create([
            "amount" => $request->total * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment Proccess from Zahra Store"
        ]);


        $cart = Cart::all()->where("user_id", Auth::user()->id);
        $order = Order::create([
            "user_id" => Auth::user()->id,
            "total" => $request->total,
            "payment" => true,
            "phone" => $request->phone,
            "address" => $request->address
        ]);
        foreach ($cart as $item) {
            OrderItem::create([
                "order_id" => $order->id,
                "product_id" => $item->product_id,
                "quantity" => $item->qtn,
            ]);
            $item->delete();
        }
        // $admins = User::all()->where("user_type", 1);
        // Notification::send($admins, new OrderNotify($order->id, $order->created_at, Auth::user()->name));

        Session::flash('success', "Order Created! We Will Call You Soon.Thank You!");

        return redirect()->route("cart");
    }
}

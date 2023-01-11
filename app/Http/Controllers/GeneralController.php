<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Wish;
use App\Notifications\Order as NotificationsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Session;

class GeneralController extends Controller
{
    // Wish List
    public function add_to_wishs($id)
    {
        if (Auth::user()) {
            $user = Wish::all()->where("user_id", Auth::user()->id);
            if (count($user->where("product_id", $id)) > 0) {
                return redirect()->route("wishes");
            } else {
                Wish::create([
                    "user_id" => Auth::user()->id,
                    "product_id" => $id
                ]);
                return redirect()->route("wishes");
            }
        } else {
            return redirect()->route("login");
        }
    }
    public function delete_wish($id)
    {
        $user = Wish::where("user_id", Auth::user()->id)->where("product_id", $id)->get();
        if (count($user) > 0) {
            $user[0]->delete();
            return redirect()->route("wishes");
        }
        return redirect()->route("wishes");
    }
    public function wishes()
    {
        $products = [];
        $prods = Wish::all()->where("user_id", Auth::user()->id);
        foreach ($prods as $item) {
            $products[] = Product::find($item->product_id);
        }
        return view("wishes", ["products" => $products]);
    }
    // Shopping Cart
    public function cart()
    {
        if (Auth::user()) {
            return view("cart", ["carts" => Cart::all()->where("user_id", Auth::user()->id)]);
        } else {
            return redirect()->route("login");
        }
    }
    public function add_cart($id)
    {
        if (Auth::user()) {
            $all = Cart::where("user_id", Auth::user()->id)->where("product_id", $id)->get();
            if (!count($all) > 0) {
                $products = Product::find($id);
                $price = $products->price - ($products->price * $products->discount / 100);
                if ($products) {
                    Cart::create([
                        "product_id" => $id,
                        "user_id" => Auth::user()->id,
                        "title" => $products->title,
                        "image" => $products->image,
                        "price" => $price
                    ]);
                    return redirect()->route("cart");
                } else {
                    abort(404);
                }
            } else {
                return redirect()->route("cart");
            }
        } else {
            return redirect()->route("login");
        }
    }
    public function update_qtn(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update($request->all());
        return redirect()->back();
    }
    public function delete_cart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return redirect()->back();
    }
    public function delivary()
    {
        $total = 0;
        $cart = Cart::all()->where("user_id", Auth::user()->id);
        foreach ($cart as $item) {
            $total += $item->price * $item->qtn;
        }
        return view("delivary", ["total" => $total, "products" => $cart]);
    }
    public function on_delivary(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:10',
            'address' => 'required|string',
        ]);
        $cart = Cart::all()->where("user_id", Auth::user()->id);
        $order = Order::create([
            "user_id" => Auth::user()->id,
            "total" => $request->total,
            "payment" => false,
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
        Session::flash('success', "Order Created! We Will Call You Soon.Thank You!");

        $admins = User::all()->where("user_type", "admin");
        Notification::send($admins, new NotificationsOrder($order->id, $order->created_at, Auth::user()->name));

        return redirect()->route("cart");
    }
    public function search_admin(Request $request)
    {
        $result = Product::where('title', $request->search)
            ->orWhere('title', 'like', '%' . $request->search . '%')->get();

        return view("admin.search", ["products" => $result]);
    }
}

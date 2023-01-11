<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders($type)
    {
        function getData($status)
        {
            $data = [];
            $order = Order::all()->where("status", "$status");
            foreach ($order as $key) {
                $item = $key->items;
                foreach ($item as $i) {
                    $i->product;
                };
                $user = User::find($key->user_id);
                $data[] = ["user" => $user, "orders" => $key];
            }
            return $data;
        }

        if ($type == "new") {
            return view("admin.orders", ["orders" => getData("Pending")]);
        } else if ($type == "review") {
            return view("admin.orders", ["orders" => getData("Proccess")]);
        } else if ($type == "complete") {
            return view("admin.orders", ["orders" => getData("Completed")]);
        } else {
            abort(404);
        }
    }
    public function update_order(Request $request)
    {
        Order::find($request->order_id)->update([
            "status" => $request->order_status
        ]);
        return redirect()->back()->with('message', 'Order Updated Successfully');
    }
    public function  delete_order($id)
    {
        Order::find($id)->delete();
        return redirect()->back()->with('message', 'Order Deleted Successfully');
    }
}

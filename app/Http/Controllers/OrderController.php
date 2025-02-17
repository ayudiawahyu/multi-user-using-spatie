<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Menu;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'note' => $request->note
            ]);
            
            $total = 0;
            foreach ($data['repeater-group'] as $group) {
                $menu_id = $group['menu_id'];
                $menu = Menu::findOrFail($menu_id);
                
                OrderDetail::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $group['quantity'],
                ]);
                
                $total += $menu->price * $group['quantity'];
            }

            $order->update(['total' => $total]);
            DB::commit();
            return redirect()->route('pending.show', $order->id)->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Pesanan gagal dibuat! '.$th->getMessage());
        }
    }

    public function show(Order $order)
    {
        $orderDetails = OrderDetail::where('order_id', $order->id)->get();
        return view('customer.order.detail', compact('orderDetails', 'order'));
    }

    public function pay(PaymentRequest $request, Order $order)
    {
        DB::beginTransaction();
        try {
            if ($request->payment < $order->total) {
                return redirect()->back()->with('error', 'Nominal pembayaran tidak cukup!');
            } else {
                $change = $request->payment - $order->total;
                $order->update([
                    'payment' => $request->payment,
                    'change' => $change,
                    'status' => 'done'
                ]);
                DB::commit();
                return redirect()->back()->with('success', 'Pesanan berhasil dibayar!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Pesanan gagal dibayar! '.$th->getMessage());
        }
    }
}

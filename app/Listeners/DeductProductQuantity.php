<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeductProductQuantity
{
    protected $cart;
    /**
     * Create the event listener.
     */
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        $order = $event->order ;
//        foreach ($order->products as $product)
//        {
//            $product->decrement('quantity',$product->paviot->quantity);
//        }

        foreach ($this->cart->get() as $item)
        {
           Product::where('id',$item->product_id)
                ->update([
                   'quantity' => DB::raw("quantity - {$item->quantity}" )
                ]);
        }
    }
}

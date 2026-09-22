<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        if (! auth()->check()) {
            return redirect()->route('login')->with('message', 'connectez-vous');
        }

        $data = $request->validate([
            'product_id' => 'required|string',
        ]);

        $itemId = $data['product_id'];
        $item = str_starts_with($itemId, 'article-')
            ? Article::findOrFail((int) str_replace('article-', '', $itemId))
            : Product::findOrFail((int) $itemId);

        $itemData = [
            'id' => $itemId,
            'name' => $item instanceof Article ? $item->titre : $item->name,
            'price' => $item->price,
        ];

        $cart = session('cart', []);
        $found = false;

        foreach ($cart as &$item) {
            if ($item['id'] === $itemData['id']) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }
        unset($item);

        if (! $found) {
            $cart[] = [
                ...$itemData,
                'quantity' => 1,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->back();
    }

    public function reset()
    {
        session()->forget('cart');

        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ItemsController extends Controller
{
    /**
     * @return View
     * yousite.com/first
     */
    public function first(): View
    {
        $start = microtime(true);
        $result = [];

        $items = DB::table('items')
            ->join('currencies', function($query) {
                $query->on('items.currency', '=', 'currencies.currency')
                    ->whereRaw('currencies.date = (select max(date) from currencies where currency = items.currency)');
            })
            ->select(
                'items.name',
                'items.category',
                'items.price',
                'items.currency',
                DB::raw('items.price * currencies.value as priceRUB'),
                'currencies.date as dateCurrency'
            )
            ->where('category', '=', 3)
            ->limit(10)
            ->get();

        $time = microtime(true) - $start;
        $result['time'] = $time;
        $result['result'] = $items;


        return view('items.index', ['result' => $result]);

    }

    /**
     * @return View
     * yousite.com/second
     */
    public function second(): View
    {
        $start = microtime(true);
        $result = [];
        //что б занять местечко
        $result['time'] = 0;

        $items = DB::table('items')
            ->select('id', 'name', 'category', 'price', 'currency')
            ->where('category', '=', 3)
            ->limit(10)
            ->get();

        $getCurrency = DB::table('currencies')
            ->select('currency', 'value', 'date')
            ->whereIn('date', function ($query) {
                $query->selectRaw('MAX(date)')
                    ->from('currencies')
                    ->groupBy('currency');
            })
            ->get();

        foreach ($items as $item) {

            $currency = $getCurrency->where('currency', $item->currency)->first();

            $item->priceRUB = $item->price * $currency->value;
            $item->dateCurrency = $currency->date;

            $result['result'][] = $item;
        }

        $time = microtime(true) - $start;
        $result['time'] = $time;

        return view('items.index', ['result' => $result]);

    }
}

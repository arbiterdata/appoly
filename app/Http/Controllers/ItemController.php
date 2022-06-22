<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Redirect;

use App\Models\Item;
use App\Models\Child;
use Illuminate\Http\Request;


class ItemController extends Controller
{
    
    public function index()
    {
        $items = Item::orderby('name','asc')->get();

        foreach ($items as $item) {
            $item['children'] = Child::where('item_id',$item->id)->orderby('name', 'asc')->get(['name', 'id']);
        }

        return view('welcome', ['items' => $items ]);
    }

    public function store(Request $request)
    {
        $item = Item::firstOrCreate([
            'name' => $request->input('name')
        ]);
        $item->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        $item = Item::where('id', $id)->firstorfail()->delete();
        
        return redirect('/');
    }
}

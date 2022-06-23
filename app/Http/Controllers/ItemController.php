<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Redirect;

use App\Models\Item;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


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

    public function update()
    {
        // request data from source and manipulate response into usable array
        $items_api = Http::get('https://dev.shepherd.appoly.io/fruit.json')->json()['menu_items'];
        
        // iterate through items to check if in the database and insert item if item doesn't exist
        foreach ($items_api as $item_api) {

            $item = Item::firstOrCreate([
                'name' => $item_api['label'],
            ]);

            $item->save();
        
            // check if there are any children to an item
            if ($item_api['children'] <> null ) {

                // iterate through children to check if nthe database and insert if child doesn't exist
                foreach ($item_api['children'] as $child_api) {
                
                    $child = Child::firstOrCreate([
                        'name' => $child_api['label'],
                        'item_id' => Item::where('name', $item_api['label'])->first(['id'])->id
                    ]);
        
                    $item->save();
                }
            }
        };
        
        return redirect('/');
    }

}

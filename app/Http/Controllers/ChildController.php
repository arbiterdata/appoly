<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{

    public function store(Request $request)
    {
        $child = Child::firstOrCreate([
            'name' => $request->input('name'),
            'item_id' => $request->input('item_id')
        ]);
        $child->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        $item = Child::where('id', $id)->firstorfail()->delete();
        
        return redirect('/');
    }
}

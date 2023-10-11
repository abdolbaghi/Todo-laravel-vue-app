<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDailyItemReq;
use App\Models\DailyItem;
use Illuminate\Http\Request;

class DailyItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dailyItems = DailyItem::all()->map(function ($item, $key){
            #add category ralation
            $item->category = config('categories')[$item->cat_id-1];
            return $item;
        });

        return $dailyItems;
    }


    public function store(CreateDailyItemReq $request)
    {

        $item= DailyItem::create([
            'name' => $request->input('name'),
            'point' => $request->input('point'),
            'cat_id' => $request->input('category'),
        ]);

        return $item;
    }

    public function update(Request $request, DailyItem $dailyItem)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'point' => 'required|integer',
            'cat_id' => 'required|integer|exists:cats,id',
        ];

        $this->validate($request, $rules);

        $dailyItem->update([
            'name' => $request->input('name'),
            'point' => $request->input('point'),
            'cat_id' => $request->input('cat_id'),
        ]);

        return $dailyItem;
    }

    public function destroy($id)
    {
        //
        $item = DailyItem::find($id);
        if ($item) {
            $item->delete();

            return "Item deleted successfully";
        }

        return "Item Not Found";
    }
}

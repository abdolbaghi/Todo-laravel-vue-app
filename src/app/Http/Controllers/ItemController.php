<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemReq;
use App\Services\JalaliDate\GregorianJalali;
use App\Models\Item;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ItemController extends Controller
{
    private GregorianJalali $gregorianJalali;
    public function __construct(GregorianJalali $gregorian_jalali)
    {
        $this->gregorianJalali = $gregorian_jalali;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Item::orderBy('created_at', 'Desc')->get()->map(function ($item, $key){
            #change date type 
            $date_arr = explode("-",$item->due_date);
            $item->due_date = $this->gregorianJalali->gregorian_to_jalali($date_arr[0],$date_arr[1],$date_arr[2],true);
            #add category ralation
            $item->category = config('categories')[$item->cat_id-1];
            return $item;
        });
    }
    public function dailyGrouped()
    {
        //
        return Item::orderBy('created_at', 'Desc')->get()->map(function ($item, $key){
            #change date type 
            $date_arr = explode("-",$item->due_date);
            $item->due_date = $this->gregorianJalali->gregorian_to_jalali($date_arr[0],$date_arr[1],$date_arr[2],true);
            #add category ralation
            $item->category = config('categories')[$item->cat_id-1];
            return $item;
        })->groupBy('due_date');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateItemReq $request)
    {
        //
        $newItem = new Item;

        $newItem->name = $request->item['name'];
        $newItem->point = $request->item['point'];
        $newItem->cat_id = $request->item['category'];
        $date_arr = explode("/",$request->item['date']);
        $newItem->due_date = $this->gregorianJalali->jalali_to_gregorian($date_arr[0],$date_arr[1],$date_arr[2],true);
        $newItem->save();

        return $newItem;
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $exitingItem = Item::find($id);
        if ($exitingItem) {
            $exitingItem->completed = $request->item['completed'];
            $exitingItem->completed_at = $request->item['completed'] ? Carbon::now() : null;
            $exitingItem->save();
            return $exitingItem;
        }

        return "Item Not Found";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = Item::find($id);
        if ($item) {
            $item->delete();

            return "Item deleted successfully";
        }

        return "Item Not Found";
    }
}

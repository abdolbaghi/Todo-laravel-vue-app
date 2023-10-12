<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemReq;
use App\Services\JalaliDate\GregorianJalali;
use App\Models\Item;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;


class ItemController extends Controller
{
    private GregorianJalali $gregorianJalali;
    public function __construct(GregorianJalali $gregorian_jalali)
    {
        $this->gregorianJalali = $gregorian_jalali;
    }
    private function jdate_to_gdate($date)
    {
        $date_arr = explode("/",$date);
        if (count($date_arr)> 3){
            foreach ($date_arr as $num)
                if(!is_numeric($num)){
                    return null;
            }
            return $this->gregorianJalali->jalali_to_gregorian($date_arr[0],$date_arr[1],$date_arr[2],true);
        }
        return null;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Item::where(DB::raw("CAST(due_date AS DATE)"),Carbon::now()->toDateString())->orWhere('due_date',null)->orderBy('due_date', 'asc')->get()->map(function ($item, $key){
            if($item->due_date != null)
            {
                #change date type 
                $date_time = explode(" ",$item->due_date);
                $date_arr = explode("-",$date_time[0]);
                $item->due_date = $this->gregorianJalali->gregorian_to_jalali($date_arr[0],$date_arr[1],$date_arr[2],true). " " . $date_time[1];     
            
            }
            #add category ralation
            $item->category = config('categories')[$item->cat_id-1];
            return $item;
        });
    }
    public function dailyGrouped(Request  $request)
    {
        $query = Item::orderBy('due_date', 'Desc');
        if($request->has("from"))
        {
            $gdate = $this->jdate_to_gdate($request->from);
            if ($gdate != null)
                $query->where(DB::raw("CAST(due_date AS DATE)"),">=",$gdate);
           

        }
        if($request->has("to"))
        {
            $gdate = $this->jdate_to_gdate($request->to);
            if ($gdate != null)
                $query->where(DB::raw("CAST(due_date AS DATE)"),"<=",$gdate);
          

        }
        return $query->get()->map(function ($item, $key){
            if($item->due_date != null)
            {
                #change date type 
                $date_time = explode(" ",$item->due_date);
                $date_arr = explode("-",$date_time[0]);
                $item->due_date = $this->gregorianJalali->gregorian_to_jalali($date_arr[0],$date_arr[1],$date_arr[2],true). " " . $date_time[1];     
            }
            #add category ralation
            $item->category = config('categories')[$item->cat_id-1];
            return $item;
        })->groupBy(function ($item) {
            return explode(" ",$item->due_date)[0];
         });
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

        $newItem->name = $request->name;
        $newItem->point = $request->point;
        $newItem->cat_id = $request->category;
        if(isset($request->date) and strlen($request->date) > 0)
        {
            $date_time = explode(" ",$request->date);
            $date_arr = explode("/",$date_time[0]);
            $newItem->due_date = $this->gregorianJalali->jalali_to_gregorian($date_arr[0],$date_arr[1],$date_arr[2],true)." ".$date_time[1] ;
        }
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
            if ($exitingItem->due_date == null)
            {
                $exitingItem->due_date = $request->item['completed'] ? Carbon::now()->toDateString() : null;
            }
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

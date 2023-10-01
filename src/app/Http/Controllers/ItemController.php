<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemReq;
use App\Models\Item;
use Illuminate\Http\Request;
use Carbon\Carbon;

function div($a,$b) { 
    return (int) ($a / $b); 
} 

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Item::orderBy('created_at', 'Desc')->get();
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
        $newItem->due_date = $this->jalali_to_gregorian($date_arr[0],$date_arr[1],$date_arr[2],true);
        $newItem->save();

        return $newItem;
    }

    function jalali_to_gregorian($j_y, $j_m, $j_d,$str) 
    { 
        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31); 
        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29); 
     
     
       $jy = (int)($j_y)-979; 
       $jm = (int)($j_m)-1; 
       $jd = (int)($j_d)-1; 
     
       $j_day_no = 365*$jy + div($jy, 33)*8 + div($jy%33+3, 4); 
       
       for ($i=0; $i < $jm; ++$i) 
          $j_day_no += $j_days_in_month[$i]; 
     
       $j_day_no += $jd; 
     
       $g_day_no = $j_day_no+79; 
     
       $gy = 1600 + 400*div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */ 
       $g_day_no = $g_day_no % 146097; 
     
       $leap = true; 
       if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ 
       { 
          $g_day_no--; 
          $gy += 100*div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */ 
          $g_day_no = $g_day_no % 36524; 
     
          if ($g_day_no >= 365) 
             $g_day_no++; 
          else 
             $leap = false; 
       } 
     
       $gy += 4*div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */ 
       $g_day_no %= 1461; 
     
       if ($g_day_no >= 366) { 
          $leap = false; 
     
          $g_day_no--; 
          $gy += div($g_day_no, 365); 
          $g_day_no = $g_day_no % 365; 
       } 
     
       for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++) 
          $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap); 
       $gm = $i+1; 
       $gd = $g_day_no+1; 
        if($str) return $gy.'/'.$gm.'/'.$gd ;
        return array($gy, $gm, $gd); 
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

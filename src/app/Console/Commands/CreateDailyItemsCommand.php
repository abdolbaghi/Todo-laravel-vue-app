<?php

namespace App\Console\Commands;

use App\Models\DailyItem;
use App\Models\Item;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CreateDailyItemsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create_daily_items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add daily rutines to items';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $list=[];
        foreach(DailyItem::all() as $item){
            $list[] = [
                'name' => $item->name,
                'point' => $item->point,
                'cat_id' => $item->cat_id,
                'user_id' => $item->user_id,
                'due_date' => Carbon::now()->toDateString(),
            ];

        }
        Item::insert($list);
        return Command::SUCCESS;
    }
}

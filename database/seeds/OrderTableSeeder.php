<?php

use CodeDelivery\Models\Order;
use CodeDelivery\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create()->each(function ($o) {
            foreach (range(1, 3) as $i) {
                $o->items()->save(factory(OrderItem::class)->make());
            }
        });
    }
}

<?php

use CodeDelivery\Models\Coupon;
use CodeDelivery\Models\OrderItem;
use Illuminate\Database\Seeder;

class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Coupon::class, 10)->create();
    }
}

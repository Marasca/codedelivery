<?php

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;

class OrderService
{
    private $statuses;

    public function __construct()
    {
        $this->statuses = config('orders.statuses');
    }

    public function getStatuses()
    {
        return $this->statuses;
    }
}
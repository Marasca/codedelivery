<?php

namespace CodeDelivery\Services;


use CodeDelivery\Models\Order;
use CodeDelivery\Repositories\CouponRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;

class OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var CouponRepository
     */
    private $couponRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(OrderRepository $orderRepository, CouponRepository $couponRepository, ProductRepository $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->couponRepository = $couponRepository;
        $this->productRepository = $productRepository;
    }

    public function create(array $data)
    {
        \DB::beginTransaction();

        try {
            $data['status'] = 0;

            if (isset($data['coupon_code']) && !empty($data['coupon_code'])) {
                $coupon = $this->couponRepository->findByField('code', $data['coupon_code'])->first();
                $data['coupon_id'] = $coupon->id;

                $coupon->used = 1;
                $coupon->save();

                unset($data['coupon_code']);
            }

            $items = $data['items'];
            unset($data['items']);

            $order = $this->orderRepository->create($data);
            $total = 0;

            foreach ($items as $item) {
                $item['price'] = $this->productRepository->find($item['product_id'])->price;
                $order->items()->create($item);

                $total += $item['price'] * $item['qtd'];
            }

            $order->total = $total;

            if (isset($coupon)) {
                $order->total = $total - $coupon->value;
            }

            $order->save();

            \DB::commit();

            return $order;
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }

    public function updateStatus($id, $deliverymanId, $status)
    {
        $order = $this->orderRepository->getByIdAndDeliveryman($id, $deliverymanId);

        if ($order instanceof Order) {
            $order->status = $status;
            $order->save();

            return $order;
        }

        return false;
    }
}
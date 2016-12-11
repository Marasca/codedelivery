<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminOrdersRequest;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;

class OrdersController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(OrderRepository $repository, UserRepository $userRepository, OrderService $orderService)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->repository->paginate();
        $statuses = $this->orderService->getStatuses();

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function edit($id)
    {
        $order = $this->repository->find($id);

        $deliverymen = $this->userRepository->getDeliverymen();
        $deliverymen->prepend('Selecione um entregador', '');

        $statuses = $this->orderService->getStatuses();

        return view('admin.orders.edit', compact('order', 'deliverymen', 'statuses'));
    }

    public function update(AdminOrdersRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.orders.index');
    }
}

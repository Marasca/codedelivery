<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminOrdersRequest;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;

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

    public function __construct(OrderRepository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $orders = $this->repository->paginate();

        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id)
    {
        $order = $this->repository->find($id);

        $deliverymen = $this->userRepository->getDeliverymen();
        $deliverymen->prepend('Selecione um entregador', '');

        $statuses = config('orders.statuses');

        return view('admin.orders.edit', compact('order', 'deliverymen', 'statuses'));
    }

    public function update(AdminOrdersRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.orders.index');
    }
}

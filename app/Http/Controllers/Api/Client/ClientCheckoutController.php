<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
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
        $userId = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($userId)->client->id;

        $orders = $this->repository->with(['items', 'items.product'])->scopeQuery(function ($query) use ($clientId) {
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return $orders;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $userId = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->find($userId)->client->id;
        $data['client_id'] = $clientId;
        $order = $this->orderService->create($data);
        $order = $this->repository->with(['items', 'items.product'])->find($order->id);

        return $order;
    }

    public function show($id)
    {
        $order = $this->repository->with(['items', 'items.product', 'coupon'])->find($id);

        return $order;
    }

}

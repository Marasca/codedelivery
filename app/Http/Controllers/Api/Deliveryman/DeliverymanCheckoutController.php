<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $repository;
    /**
     * @var OrderService
     */
    private $orderService;

    private $withRelations = [
        'items',
        'items.product',
    ];

    public function __construct(OrderRepository $repository, OrderService $orderService)
    {
        $this->repository = $repository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $userId = Authorizer::getResourceOwnerId();

        $orders = $this->repository->skipPresenter(false)->with($this->withRelations)->scopeQuery(function ($query) use ($userId) {
            return $query->where('user_deliveryman_id', '=', $userId);
        })->paginate();

        return $orders;
    }

    public function show($id)
    {
        $userId = Authorizer::getResourceOwnerId();
        $order = $this->repository->skipPresenter(false)->getByIdAndDeliveryman($id, $userId);

        return $order;
    }

    public function updateStatus(Request $request, $id)
    {
        $userId = Authorizer::getResourceOwnerId();
        $order = $this->orderService->updateStatus($id, $userId, $request->get('status'));

        if ($order) {
            return $this->repository->skipPresenter(false)->find($order->id);
        }

        abort(400, 'Order Not Found');
    }

}

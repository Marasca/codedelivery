<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminCouponsRequest;
use CodeDelivery\Repositories\CouponRepository;

class CouponsController extends Controller
{
    private $repository;

    public function __construct(CouponRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $coupons = $this->repository->paginate();

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(AdminCouponsRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);

        return redirect()->route('admin.coupons.index');
    }

    public function edit($id)
    {
        $coupon = $this->repository->find($id);

        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(AdminCouponsRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.coupons.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.coupons.index');
    }
}

<?php

namespace Application\Core\Http\Controllers;

use Application\Core\Services\Customer\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    public $CustomerAppService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerAppService = $customerService;
    }

    public function create(Request $request)
    {
        $post = $request->all();
        $response = $this->customerAppService->createCustomer($post);

        return JsonResponse::create($response,$response['status']);
    }

    public function getByPage($page,$limit)
    {
        $response = $this->customerAppService->getByPage($page,$limit);
        return JsonResponse::create($response,$response['status']);
    }

    public function getByFilter(Request $request)
    {
        $criteria = $request->only(['filter']);
        $response = $this->customerAppService->getByFilter($criteria['filter']);
        return JsonResponse::create($response,$response['status']);
    }

}

<?php

namespace Application\Core\Http\Controllers;

use Application\Core\Services\Manager\ManagerService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ManagerController extends Controller
{
    public $ManagerAppService;

    public function __construct(ManagerService $managerService)
    {
        $this->managerAppService = $managerService;
    }

    public function create(Request $request)
    {
        $post = $request->all();
        $response = $this->managerAppService->createManager($post);

        return JsonResponse::create($response,$response['status']);
    }

    public function getByPage($page,$limit)
    {
        $response = $this->managerAppService->getByPage($page,$limit);
        return JsonResponse::create($response,$response['status']);
    }

    public function getByFilter(Request $request)
    {
        $criteria = $request->only(['filter']);
        $response = $this->managerAppService->getByFilter($criteria['filter']);
        return JsonResponse::create($response,$response['status']);
    }

}

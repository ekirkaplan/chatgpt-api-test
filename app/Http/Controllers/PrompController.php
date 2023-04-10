<?php

namespace App\Http\Controllers;

use App\Facades\JsonOutputFaced;
use App\Http\Requests\PrompRequest;
use App\Repositories\PrompRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class PrompController extends Controller
{
    public function __construct(private PrompRepository $prompRepository)
    {
    }

    public function getAll(): JsonResponse
    {
        return JsonOutputFaced::setData($this->prompRepository->getAll())->response();
    }

    public function getPromp(PrompRequest $request): JsonResponse
    {
       $promp = $this->getPromp($request->get('promp'));

       return JsonOutputFaced::setData($promp)->response();
    }
}

<?php

namespace App\Services;


use App\Http\Resources\PropmResource;
use App\Models\Promp;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class PrompService
{
    /**
     * @param Promp $promp
     * @return PropmResource
     */
    public function setSingle(Promp $promp): PropmResource
    {
        return new PropmResource($promp);
    }

    /**
     * @param Collection $promps
     * @return JsonResource
     */
    public function setPlural(Collection $promps): JsonResource
    {
        return PropmResource::collection($promps);
    }
}

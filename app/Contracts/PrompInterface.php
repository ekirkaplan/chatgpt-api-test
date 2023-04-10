<?php

namespace App\Contracts;

use App\Models\Promp;
use Illuminate\Database\Eloquent\Collection;

interface PrompInterface
{
    /**
     * @param string $promp
     * @return Promp|array
     */
    public function getPromp(string $promp): Promp|array;

    /**
     * @return Collection
     */
    public function getAll(): Collection;

}

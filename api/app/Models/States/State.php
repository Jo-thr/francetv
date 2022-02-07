<?php

namespace App\Models\States;

class State
{
    public function label(string $lang): ?string
    {
        return isset($this->label[$lang])
            ?$this->label[$lang]
            : null;
    }
}

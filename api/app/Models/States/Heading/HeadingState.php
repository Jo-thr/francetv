<?php

namespace App\Models\States\Heading;

class HeadingState
{
    public function slug(string $lang): ?string
    {
        return isset($this->slug[$lang])
            ?$this->slug[$lang]
            : null;
    }

    public function label(string $lang): ?string
    {
        return isset($this->label[$lang])
            ?$this->label[$lang]
            : null;
    }

    public function meta(): ?array
    {
        return $this->slug;
    }
}

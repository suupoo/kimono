<?php

namespace App\UseCases\Traits;

trait PrefixSettable
{
    protected ?string $prefix = null;

    /**
     * Routing名のプレフィックスを上書きしてセットする
     *
     * @return $this
     */
    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }
}

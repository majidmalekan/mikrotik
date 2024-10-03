<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait MultiLangTrait
{
    /**
     * @return bool
     */
    public function checkExitsMultiLangAble(): bool
    {
        return method_exists($this, 'MultiLangAble');
    }

    /**
     * @return bool
     */
    public function checkChangeLocale(): bool
    {
        return !(App::getLocale() == env('DEFAULT_LOCAL'));
    }
}

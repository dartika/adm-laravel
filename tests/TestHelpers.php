<?php

namespace Dartika\Adm\Tests;

use Dartika\Adm\Models\AdmUser;

trait TestHelpers
{
    protected $admUser;

    protected function defaultAdmUser($attributes = [])
    {
        if (!$this->admUser) {
            $this->admUser = factory(AdmUser::class)->create($attributes);
        }

        return $this->admUser;
    }
}

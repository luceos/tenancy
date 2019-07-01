<?php

/*
 * This file is part of the tenancy/tenancy package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see http://laravel-tenancy.com
 * @see https://github.com/tenancy
 */

namespace Tenancy\Affects;

use InvalidArgumentException;
use Tenancy\Affects\Contracts\ResolvesAffects;
use Tenancy\Contracts\TenantAffectsApp;
use Tenancy\Pipeline\Pipeline;

class AffectResolver extends Pipeline implements ResolvesAffects
{
    public function addAffect($affect)
    {
        if (! in_array(TenantAffectsApp::class, class_implements($affect))) {
            throw new InvalidArgumentException("$affect has to implement " . TenantAffectsApp::class);
        }

        $this->steps->add($affect);

        return $this;
    }

    public function getAffects(): array
    {
        return $this->getSteps()->toArray();
    }

    public function setAffects(array $affects)
    {
        $this->setSteps($affects);

        return $this;
    }
}
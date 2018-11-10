<?php

declare(strict_types=1);

/*
 * This file is part of my Symfony boilerplate,
 * following the Explicit Architecture principles.
 *
 * @link https://herbertograca.com/2017/11/16/explicit-architecture-01-ddd-hexagonal-onion-clean-cqrs-how-i-put-it-all-together
 * @link https://herbertograca.com/2018/07/07/more-than-concentric-layers/
 *
 * (c) Herberto Graça
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\App\Core\Port\Persistence\Exception;

use Acme\App\Core\SharedKernel\Exception\AppRuntimeException;

final class CanOnlyHydrateFromArrayException extends AppRuntimeException
{
    public function __construct($item)
    {
        parent::__construct('Can only hydrate to object from an array, \'' . $this->getType($item) . '\' given.');
    }

    private function getType($item): string
    {
        $type = \gettype($item);
        if ($type === 'object') {
            return \get_class($item);
        }

        return $type;
    }
}

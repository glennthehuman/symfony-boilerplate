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

namespace Acme\App\Test\TestCase\Presentation\Console\Component;

use Acme\App\Presentation\Console\Component\GreetUserCommand;
use Acme\App\Test\Framework\AbstractConsoleTest;

/**
 * @medium
 */
final class GreetUserCommandIntegrationTest extends AbstractConsoleTest
{
    private const ITERATIONS = 10;

    protected function setUp(): void
    {
        $this->skipIfSttyNotAvailable();
    }

    /**
     * @test
     */
    public function create_user_non_interactive(): void
    {
        $output = $this->execute(
            GreetUserCommand::getDefaultName(),
            [
                GreetUserCommand::ARG_FIRST_NAME => 'First',
                GreetUserCommand::ARG_SECOND_NAME => 'Second',
                GreetUserCommand::ARG_LAST_NAMES => ['Third', 'Fourth'],
                '--' . GreetUserCommand::OPT_ITERATIONS => self::ITERATIONS,
            ]
        );

        self::assertContains('First Second Third Fourth', $output);
        self::assertEquals(
            self::ITERATIONS,
            mb_substr_count($output, 'First Second Third Fourth'),
            "Output was: \n" . $output
        );
    }
}

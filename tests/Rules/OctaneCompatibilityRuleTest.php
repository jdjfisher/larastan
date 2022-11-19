<?php

declare(strict_types=1);

namespace Tests\Rules;

use NunoMaduro\Larastan\Rules\OctaneCompatibilityRule;
use PHPStan\Testing\RuleTestCase;
use PHPStan\Rules\Rule;

/** @extends RuleTestCase<OctaneCompatibilityRule> */
class OctaneCompatibilityRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new OctaneCompatibilityRule();
    }

    public function testNoContainerInjection(): void
    {
        $this->analyse([__DIR__.'/Data/ContainerInjection.php'], [
            [
                "Consider using bind method instead or pass a closure.\n    💡 See: https://laravel.com/docs/octane#dependency-injection-and-octane",
                12,
            ],
            [
                "Consider using bind method instead or pass a closure.\n    💡 See: https://laravel.com/docs/octane#dependency-injection-and-octane",
                16,
            ],
            [
                "Consider using bind method instead or pass a closure.\n    💡 See: https://laravel.com/docs/octane#dependency-injection-and-octane",
                25,
            ],
            [
                "Consider using bind method instead or pass a closure.\n    💡 See: https://laravel.com/docs/octane#dependency-injection-and-octane",
                29,
            ],
            [
                "Consider using bind method instead or pass a closure.\n    💡 See: https://laravel.com/docs/octane#dependency-injection-and-octane",
                33,
            ],
            [
                "Consider using bind method instead or pass a closure.\n    💡 See: https://laravel.com/docs/octane#dependency-injection-and-octane",
                46,
            ],
            [
                "Consider using bind method instead or pass a closure.\n    💡 See: https://laravel.com/docs/octane#dependency-injection-and-octane",
                51,
            ],
        ]);
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [
            __DIR__.'/Data/octane.neon',
        ];
    }
}

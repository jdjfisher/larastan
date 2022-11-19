<?php

declare(strict_types=1);

namespace Tests\Rules;

use NunoMaduro\Larastan\Rules\ModelRuleHelper;
use NunoMaduro\Larastan\Rules\ModelProperties\ModelPropertyRule;
use NunoMaduro\Larastan\Rules\ModelProperties\ModelPropertiesRuleHelper;
use PHPStan\Testing\RuleTestCase;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleLevelHelper;

/** @extends RuleTestCase<ModelPropertyRule> */
class ModelPropertyRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        $ruleLevelHelper = self::getContainer()->getByType(RuleLevelHelper::class);

        return new ModelPropertyRule(new ModelPropertiesRuleHelper(), $ruleLevelHelper, new ModelRuleHelper());
    }

    public function testModelPropertyRuleOnBuilder(): void
    {
        $this->analyse([__DIR__.'/Data/model-property-builder.php'], [
            [
                'Property \'foo\' does not exist in App\\User model.',
                3,
            ],
            [
                'Property \'foo\' does not exist in App\\User model.',
                4,
            ],
            [
                'Property \'foo\' does not exist in App\\User model.',
                9,
            ],
            [
                'Property \'foo\' does not exist in App\\User model.',
                18,
            ],
            [
                'Property \'foo\' does not exist in App\\User model.',
                23,
            ],
            [
                'Property \'foo\' does not exist in App\\User model.',
                25,
            ],
            [
                'Property \'foo\' does not exist in App\\User model.',
                26,
            ],
            [
                'Property \'foo\' does not exist in App\\User model.',
                27,
            ],
            [
                'Property \'foo\' does not exist in App\\User model.',
                30,
            ],
        ]);
    }

    public function testModelPropertyRuleOnRelation(): void
    {
        $this->analyse([__DIR__.'/Data/model-property-relation.php'], [
            [
                'Property \'foo\' does not exist in App\\Account model.',
                4,
            ],
            [
                'Property \'foo\' does not exist in App\\Account model.',
                5,
            ],
            [
                'Property \'foo\' does not exist in App\\Account model.',
                6,
            ],
            [
                'Property \'foo\' does not exist in App\\Account model.',
                7,
            ],
            [
                'Property \'foo\' does not exist in App\\Account model.',
                8,
            ],
            [
                'Property \'foo\' does not exist in App\\Post model. If \'foo\' exists as a column on the pivot table, consider using \'wherePivot\' or prefix the column with table name instead.',
                10,
            ]
        ]);
    }

    public function testModelPropertyRuleOnModel(): void
    {
        $this->analyse([__DIR__.'/Data/model-property-model.php'], [
            [
                'Property \'foo\' does not exist in ModelPropertyModel\ModelPropertyOnModel model.',
                9,
            ],
            [
                'Property \'foo\' does not exist in App\Account|App\User model.',
                16,
            ],
            [
                'Property \'name\' does not exist in App\Account|App\User model.',
                23,
            ],
        ]);
    }

    public function testModelPropertyRuleOnModelFactory(): void
    {
        $this->analyse([__DIR__.'/Data/model-property-model-factory.php'], [
            [
                'Property \'foo\' does not exist in App\\User model.',
                5,
            ],
        ]);
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [
            __DIR__.DIRECTORY_SEPARATOR.'Data/modelPropertyConfig.neon'
        ];
    }
}

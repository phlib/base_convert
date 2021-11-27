<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $services = $containerConfigurator->services();

    $containerConfigurator->import(SetList::COMMON);
    // Remove sniff, from common/control-structures
    $services->remove(\PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer::class);
    // Remove sniff, from common/spaces
    $services->remove(\PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer::class);
    $services->remove(\PhpCsFixer\Fixer\CastNotation\CastSpacesFixer::class);

    // Save strict to later
    $services->remove(\PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer::class);
    $services->remove(\PhpCsFixer\Fixer\Strict\StrictParamFixer::class);
    $services->remove(\PhpCsFixer\Fixer\Strict\StrictComparisonFixer::class);
    $services->remove(\PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer::class);
    $services->remove(\PhpCsFixer\Fixer\PhpUnit\PhpUnitSetUpTearDownVisibilityFixer::class);

    $containerConfigurator->import(SetList::PSR_12);
};

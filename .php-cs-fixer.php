<?php

declare(strict_types=1);
return (new PhpCsFixer\Config())
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => true,
        '@PSR1' => true,
        '@PSR12' => true,
        '@PHP80Migration' => true,
        'no_unused_imports' => true,
        'ordered_imports' => true,
        'single_quote' => true,
        'concat_space' => ['spacing' => 'one'],
        'declare_equal_normalize' => ['space' => 'none'],
        'declare_strict_types' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                'attribute',
                'break',
                'case',
                'continue',
                'curly_brace_block',
                'default',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'switch',
                'throw',
                'use',
                'use_trait',
            ]
        ],
        'php_unit_internal_class' => [],
        'php_unit_test_class_requires_covers' => false,
        'trailing_comma_in_multiline' => [],
        'no_superfluous_phpdoc_tags' => true,
        'yoda_style' => ['always_move_variable' => true, 'equal' => true, 'identical' => true, 'less_and_greater' => null],
    ])->setFinder(
        PhpCsFixer\Finder::create()
            ->ignoreUnreadableDirs(true)
            ->notName(['_*.php'])
            ->exclude(['bootstrap', 'node_modules', 'public', 'storage', 'vendor'])
            ->notPath('*')
            ->in(__DIR__)
    );

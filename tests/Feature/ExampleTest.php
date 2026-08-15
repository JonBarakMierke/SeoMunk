<?php

declare(strict_types=1);

use Seomunk\Seomunk\Seomunk;

it('resolves the singleton', function () {
    expect(app(Seomunk::class))->toBeInstanceOf(Seomunk::class);
});

it('returns the same instance from the container', function () {
    expect(app(Seomunk::class))->toBe(app(Seomunk::class));
});

it('merges the package config', function () {
    expect(config('seomunk.placeholder'))->toBe('default');
});

it('loads the package translations', function () {
    expect(trans('seomunk::messages.placeholder'))->toBe('Seomunk placeholder translation.');
});

it('loads the package views', function () {
    expect(view()->exists('seomunk::placeholder'))->toBeTrue();
});

it('registers the artisan command', function () {
    $this->artisan('seomunk:placeholder')
        ->expectsOutputToContain('Seomunk placeholder command executed.')
        ->assertSuccessful();
});

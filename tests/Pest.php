<?php

declare(strict_types=1);

use Saloon\Http\Faking\MockClient;
use UseTheFork\Signal\Tests\TestCase;

uses(TestCase::class)
    ->beforeEach(fn () => MockClient::destroyGlobal())
    ->in(__DIR__);

<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

abstract class TestCase extends BaseTestCase {
    use RefreshDatabase;
    use CreatesApplication;

    protected function createFakeImg($name): UploadedFile {
        return UploadedFile::fake()->image($name);
    }
}

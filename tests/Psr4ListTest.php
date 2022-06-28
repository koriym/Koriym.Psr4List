<?php

declare(strict_types=1);

/**
 * This file is part of the Koriym.Psr4List
 */

namespace Koriym\Psr4List;

use PHPUnit\Framework\TestCase;

class Psr4ListTest extends TestCase
{
    /**
     * @return void
     */
    public function testGenerator()
    {
        $psr4List = new Psr4List();
        $prefix = 'FakeVendor\FakePackage';
        $path = __DIR__ . '/Fake/src';
        foreach ($psr4List($prefix, $path) as list($class, $file)) {
            $classes[] = $class;
            $files[] = $file;
        }

        $expect = [
            'FakeVendor\FakePackage\One',
            'FakeVendor\FakePackage\OneInterface',
            'FakeVendor\FakePackage\Two',
            'FakeVendor\FakePackage\Sub\Three',
            'FakeVendor\FakePackage\Sub\Sub\Four',
        ];
        $this->assertSame($expect, $classes);
        $expect = [
            $path . '/One.php',
            $path . '/OneInterface.php',
            $path . '/Two.php',
            $path . '/Sub/Three.php',
            $path . '/Sub/Sub/Four.php',
        ];
        $this->assertSame($expect, $files);
    }

    /**
     * @return void
     */
    public function testInvalidPrefix()
    {
        $psr4List = new Psr4List();
        $prefix = 'FakeVendor\Invalid-name';
        $path = __DIR__ . '/Fake/src';
        foreach ($psr4List($prefix, $path) as list($class, $file)) {
            $classes[] = $class;
        }

        $this->assertNotTrue(isset($classes));
    }
}

<?php
/**
 * This file is part of the Koriym.Psr4List
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Koriym\Psr4List;

class Psr4ListTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerator()
    {
        $psr4List = new Psr4List;
        $prefix = 'FakeVendor\FakePackage';
        $path = __DIR__ . '/Fake';
        foreach ($psr4List($prefix, $path) as list($class, $file)) {
            $classes[] = $class;
            $files[] = $file;
        }
        $expect = [
            'FakeVendor\FakePackage\One',
            'FakeVendor\FakePackage\Two',
            'FakeVendor\FakePackage\Sub\Three',
            'FakeVendor\FakePackage\Sub\Sub\Four',
        ];
        $this->assertSame($expect, $classes);
        $expect = [
            $path . '/FakeVendor/FakePackage/One.php',
            $path . '/FakeVendor/FakePackage/Two.php',
            $path . '/FakeVendor/FakePackage/Sub/Three.php',
            $path . '/FakeVendor/FakePackage/Sub/Sub/Four.php',
        ];
        $this->assertSame($expect, $files);
    }

    public function testInvalidPrefix()
    {
        $psr4List = new Psr4List;
        $prefix = 'FakeVendor\Invalid-name';
        $path = __DIR__ . '/Fake';
        foreach ($psr4List($prefix, $path) as list($class, $file)) {
            $classes[] = $class;
        }
        $this->assertNotTrue(isset($classes));
    }
}

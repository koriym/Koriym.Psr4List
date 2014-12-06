<?php
/**
 * This file is part of the Koriym.Psr4List
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Koriym\Psr4List;

class Psr4List
{
    /**
     * @return \Generator
     */
    public function __invoke($prefix, $path)
    {
        foreach ($this->files($path) as $item) {
            /** @var $item \SplFileInfo */
            $file = $item->getPathname();
            $namePath = str_replace('\\', '/', $prefix);
            $pos = strpos($file, $namePath);
            $class = substr(str_replace('/', '\\', substr($file, $pos)), 0, -4);
            if (! class_exists($class)) {
                continue;
            }

            yield [$class, $file];
        }
    }

    /**
     * @return \RegexIterator
     */
    private function files($dir)
    {
        return new SortingIterator(
            new \RegexIterator(
                new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator(
                        $dir,
                        \FilesystemIterator::CURRENT_AS_FILEINFO | \FilesystemIterator::KEY_AS_PATHNAME | \FilesystemIterator::SKIP_DOTS
                    ),
                    \RecursiveIteratorIterator::LEAVES_ONLY
                ),
                '/^.+\.php$/',
                \RecursiveRegexIterator::MATCH
            )
        );
    }
}
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
     * @param string $prefix
     * @param string $path
     *
     * @return \Generator<array{0: string, 1:string}>
     */
    public function __invoke($prefix, $path)
    {
        return $this->invoke($prefix, $path);
    }

    /**
     * @param string $prefix
     * @param string $path
     *
     * @return \Generator<array{0: string, 1:string}>
     */
    private function invoke($prefix, $path)
    {
        foreach ($this->files($path) as $item) {
            $file = $item->getPathname();
            $namePath = str_replace('/', '\\' , substr(substr($file, strlen($path) + 1), 0, -4));
            $class = $prefix . '\\' . $namePath;
            if (! class_exists($class)) {
                continue;
            }

            yield [$class, $file];
        }
    }

    /**
     * @param string $dir
     *
     * @return SortingIterator
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

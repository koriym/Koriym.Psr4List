<?php
/**
 * This file is part of the Koriym.Psr4List
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Koriym\Psr4List;

use ArrayIterator;
use IteratorAggregate;
use SplFileInfo;
use Traversable;

/**
 * @template-implements IteratorAggregate<SplFileInfo>
 */
class SortingIterator implements IteratorAggregate
{
    /**
     * @var ArrayIterator<int, SplFileInfo>
     */
    private $iterator;

    public function __construct(\RegexIterator $iterator)
    {
        /** @var array{0: SplFileInfo, 1: SplFileInfo} $array */
        $array = iterator_to_array($iterator);
        usort($array,
            /**
             * @return int
             */
            function (SplFileInfo $a, SplFileInfo $b) {
                $pathA = $a->getPathname();
                $pathB = $b->getPathname();
                $cntA = count(explode('/', $pathA));
                $cntB = count(explode('/', $pathB));
                if ($cntA !== $cntB) {
                    return ($cntA > $cntB) ? 1 : -1;
                }

                return ($a->getPathname() > $b->getPathname()) ? 1 : -1;
            });
        /** @var array<int, SplFileInfo> $array */
        $this->iterator = new ArrayIterator($array);
    }

    /**
     * @return ArrayIterator
     *
     * @psalm-return ArrayIterator<int, SplFileInfo>
     */
    public function getIterator(): ArrayIterator
    {
        return $this->iterator;
    }
}

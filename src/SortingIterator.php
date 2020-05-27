<?php
/**
 * This file is part of the Koriym.Psr4List
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Koriym\Psr4List;

use ArrayIterator;
use SplFileInfo;
use Traversable;

class SortingIterator implements \IteratorAggregate
{
    /**
     * @var ArrayIterator
     */
    private $iterator;

    /**
     * @param Traversable $iterator
     */
    public function __construct(Traversable $iterator)
    {
        $array = iterator_to_array($iterator);
        usort($array, /** @return int */function (SplFileInfo $a, SplFileInfo $b)
        {
            $pathA = $a->getPathname();
            $pathB = $b->getPathname();
            $cntA = count(explode('/', $pathA));
            $cntB = count(explode('/', $pathB));
            if ($cntA !== $cntB) {
                return ($cntA > $cntB) ? 1 : -1;
            }
            return ($a->getPathname() > $b->getPathname()) ? 1 : -1;
        });
        $this->iterator = new ArrayIterator($array);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return $this->iterator;
    }
}

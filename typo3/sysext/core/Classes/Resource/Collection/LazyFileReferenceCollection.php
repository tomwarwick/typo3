<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace TYPO3\CMS\Core\Resource\Collection;

use TYPO3\CMS\Core\Resource\FileReference;

/**
 * When first accessed, this class will initialize itself and find the file references
 * for this record field.
 *
 * This class acts as a "Value holder", as it only fetches the related file references
 * when needed.
 *
 * @internal not part of public API, as this needs to be streamlined and proven
 */
class LazyFileReferenceCollection implements \IteratorAggregate, \ArrayAccess, \Countable
{
    /**
     * @var FileReference[]|\Closure
     */
    private array|\Closure $items;

    public function __construct(
        private readonly mixed $fieldValue,
        \Closure $initialization
    ) {
        $this->items = $initialization;
    }

    public function count(): int
    {
        $this->initialize();
        return count($this->items);
    }

    private function initialize(): void
    {
        if ($this->items instanceof \Closure) {
            $this->items = ($this->items)();
        }
    }

    public function getIterator(): \Iterator
    {
        $this->initialize();
        return new \ArrayIterator($this->items);
    }

    public function __toString(): string
    {
        return (string)$this->fieldValue;
    }

    public function offsetExists(mixed $offset): bool
    {
        $this->initialize();
        return isset($this->items[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        $this->initialize();
        return $this->items[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($value instanceof FileReference === false) {
            throw new \InvalidArgumentException(
                'Modifying the file reference collection is only allowed by setting a value of type FileReference.',
                1723188317
            );
        }
        $this->items[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new \RuntimeException('Removing items from the file reference collection is not implemented.', 1723188318);
    }
}

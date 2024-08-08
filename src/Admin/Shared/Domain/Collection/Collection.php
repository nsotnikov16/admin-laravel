<?php
declare(strict_types=1);

namespace Admin\Shared\Domain\Collection;

use ArrayAccess;
use Countable;
use Iterator;
use JsonSerializable;
use Webmozart\Assert\Assert;
use function count;

/**
 * Базовый класс коллекции
 * @template T
 */
abstract class Collection implements Countable, ArrayAccess, Iterator, JsonSerializable
{
    /** @var array<array-key, T> */
    private array $items;

    /**
     * @param array<array-key, T> $items
     */
    public function __construct(array $items = [])
    {
        Assert::allIsInstanceOf($items, $this->type());
        $this->items = $items;
        $this->onAfterCreate();
    }

    /**
     * @return class-string<T>
     */
    abstract public function type(): string;

    protected function onAfterCreate(): void
    {
    }

    /**
     * @param array-key $offset
     *
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function rewind(): void
    {
        reset($this->items);
    }

    /**
     * @psalm-suppress MixedInferredReturnType
     * @return false|T
     */
    public function current(): mixed
    {
        return current($this->items);
    }

    /**
     * @return array-key
     */
    public function key(): int|string
    {
        return key($this->items);
    }

    public function next(): void
    {
        next($this->items);
    }

    public function valid(): bool
    {
        return current($this->items) !== false;
    }

    public function isNotEmpty(): bool
    {
        return $this->isEmpty() === false;
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function has(callable $callback): bool
    {
        return $this->search($callback) !== false;
    }

    /**
     * @param callable $callback
     *
     * @return array-key|false
     */
    public function search(callable $callback): bool|int|string
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item)) {
                return $key;
            }
        }

        return false;
    }

    public function isEqual(self $other): bool
    {
        return empty(array_diff($this->items, $other->items))
            && empty(array_diff($other->items, $this->items));
    }

    public function isNotEqual(self $other): bool
    {
        return !$this->isEqual($other);
    }

    public function remove(callable $callback): void
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item)) {
                $this->offsetUnset($key);
            }
        }
    }

    /**
     * @param array-key $offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    /**
     * @param T $value
     *
     * @return void
     */
    public function append(mixed $value): void
    {
        $this->offsetSet(null, $value);
    }

    /**
     * @param array-key|null $offset
     * @param T $value
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        Assert::isInstanceOf($value, $this->type());
        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /**
     * @param array-key $offset
     *
     * @return T|null
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset] ?? null;
    }

    /**
     * @return T|null
     */
    public function findFirst(callable $callback)
    {
        $key = $this->search($callback);

        return $key === false ? null : $this->offsetGet($key);
    }

    /**
     * @return T|null
     */
    public function pullFirst(callable $callback)
    {
        $key = $this->search($callback);
        if ($key === false) {
            return null;
        }

        $result = $this->offsetGet($key);
        $this->offsetUnset($key);

        return $result;
    }

    /**
     * @return array<array-key, T>
     */
    public function all(): array
    {
        return $this->items;
    }

    public function pull(callable $callback): static
    {
        $extractCollection = $this->filter($callback);
        /** @var array-key $key */
        foreach ($extractCollection->keys() as $key) {
            $this->offsetUnset($key);
        }

        return $extractCollection;
    }

    /**
     * @psalm-suppress MixedArgumentTypeCoercion
     */
    public function filter(callable $callback): static
    {
        $clone = clone $this;
        $clone->items = array_filter($this->items, $callback);

        return $clone;
    }

    public function unique(): static
    {
        $clone = clone $this;
        $clone->items = array_unique($this->items);

        return $clone;
    }

    public function keys(): array
    {
        return array_keys($this->items);
    }

    public function jsonSerialize(): array
    {
        return array_values($this->items);
    }
}

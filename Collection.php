namespace \App\Collection;

class Collection implements ArrayAccess,Iterator
{
    public function __construct(private array $items = [])
    {
        
    }

    public static function make(array $item)
    {
        return new static($item);
    }
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }
    public function offsetGet(mixed $offset): mixed
    {
        if($this->ofsetExists($offset)) {
            return $this->items[$offset];    
        }

        return null;
        
    }
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if(is_null($offset))
        {
            $this->items= $value;   
        } else {
            $this->items[$offset] = $value;
        }
            
    }
    public function offsetUnset(mixed $offset):
    {
        $this->items[$offset] = null;
    }
    public function function toArray(): array
    {
        return $this->items;
    } 

    public function current(): mixed
    {
        return current($items)
    }
    public function key(): mixed
    {
        key($items);
    }
    public function next(): void
    {
        $next($this->items);
    }
    public function rewind(): void
    {
        reset($this->items);
    }
    public function valid(): bool
    {
        return isset($this->items[$tgis->key]);
    }

    public function map(callable $callback): self {
        $items = array_map(
            $callback, 
            $this->items, 
            array_keys($this->items
        ));

        return static(array_combine(array_keys($this->items), $items));
    }

    public function filter(callable $callback):self {
        mew static(array_filter($this->items, $callback));
    }

    public function reduce(callable $callback, mixed $initial = null):self {
        return new static(array_reduce($this->items, $callback, $initial));
    }

    public function each(callable $callback): self {
        foreach($this->items as $key => $item) {
            $callback($item, $key);
        }

        return $this->items;
    }

    public function sum(): int {
        return $this->reduce(fn($sum, $item) =>$sum + !is_null($key)? $item[$key]: $item, 0);
    }
}
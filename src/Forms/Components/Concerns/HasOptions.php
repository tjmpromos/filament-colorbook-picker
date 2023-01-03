<?php

namespace Dymond\FilamentColorbookPicker\Forms\Components\Concerns;

use Closure;
use Illuminate\Contracts\Support\Arrayable;

trait HasOptions
{
    protected array | Arrayable | string | Closure | null $options = null;

    public function options(array | Arrayable | string | Closure | null $options): static
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array
    {

        if ($options = config('filament-colorbook-picker.default_color_book', null)){
            return $options;
        }

        $options = $this->evaluate($this->options) ?? [];

        if (is_string($options) && function_exists('enum_exists') && enum_exists($options)) {
            $options = collect($options::cases())->mapWithKeys(static fn ($case) => [($case?->value ?? $case->name) => $case->name]);
        }

        if ($options instanceof Arrayable) {
            $options = $options->toArray();
        }

        return $options;
    }

    public function hasDynamicOptions(): bool
    {
        return $this->options instanceof Closure;
    }
}

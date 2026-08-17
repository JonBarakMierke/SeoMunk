<?php

namespace SeoMunk\SeoMunk\Modules\JSON\Schema;

final class SchemaManager
{
    private array $schemas = [];

    public function schema(array $data): static
    {
        $this->schemas[] = $data;
        return $this;
    }

    public function add(array $schema): static
    {
        $this->schemas[] = $schema;

        return $this;
    }

    public function builder(): SchemaBuilder
    {
        return new SchemaBuilder($this);
    }

    public function toArray(): array
    {
        return $this->schemas;
    }

    public function clear(): static
    {
        $this->schemas = [];

        return $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->schemas);
    }

    public function render(): string
    {
        return collect($this->schemas)
            ->map(fn($schema) => sprintf(
                '<script type="application/ld+json">%s</script>',
                json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
            ))
            ->implode("\n");
    }
}
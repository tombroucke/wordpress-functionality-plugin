<?php

namespace FunctionalityPlugin\Concerns;

trait HasHooks
{
    public function addFilter($filter, $callback, ...$args)
    {
        $specialFilters = [
            '__return_null',
            '__return_false',
            '__return_true',
            '__return_empty_string',
            '__return_zero',
            '__return_empty_array',
        ];

        if (in_array($callback, $specialFilters)) {
            add_filter($filter, $callback, ...$args);
            return $this;
        }

        add_filter($filter, [$this, $callback], ...$args);
        return $this;
    }

    public function removeFilter($filter, $callback, ...$args)
    {
        remove_filter($filter, $callback, ...$args);
        return $this;
    }

    public function addAction($action, $callback, ...$args)
    {
        add_action($action, [$this, $callback], ...$args);
        return $this;
    }

    public function removeAction($action, $callback, ...$args)
    {
        remove_action($action, $callback, ...$args);
        return $this;
    }
}

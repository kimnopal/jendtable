<?php

namespace KimNopal\JendTable\Components;

use InvalidArgumentException;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public ?string $model = null;

    public array $columns = [];

    public string $search = '';

    public array $pagination = [];

    private const DEFAULT_PAGINATION = [
        'enabled' => true,
        'perPage' => 5,
        'perPageOptions' => [5, 10, 20],
    ];

    public function mount(string $model, array $columns, ?array $pagination = null)
    {
        $this->validateModel($model);
        $this->validateColumns($columns);
        $this->validatePagination($pagination);
        // dd($this->columns);
    }

    private function validateModel($model)
    {
        if (!$model) {
            throw new InvalidArgumentException('Model is required');
        }

        if (!class_exists($model)) {
            throw new InvalidArgumentException("Model class '{$model}' does not exist");
        }

        if (!is_subclass_of($model, 'Illuminate\Database\Eloquent\Model')) {
            throw new InvalidArgumentException("'{$model}' must extend Illuminate\Database\Eloquent\Model");
        }

        $this->model = $model;
    }

    private function validateColumns(array $columns)
    {
        if (empty($columns)) {
            throw new InvalidArgumentException('Columns array cannot be empty');
        }

        foreach ($columns as $column) {
            if (!isset($column['key']) || empty($column['key'])) {
                throw new InvalidArgumentException('Column key is required');
            }

            if (!isset($column['label']) || empty($column['label'])) {
                throw new InvalidArgumentException('Column label is required');
            }

            // konfigurasi opsional
            if (isset($column['searchable']) && !is_bool($column['searchable'])) {
                throw new InvalidArgumentException('Column searchable must be a boolean');
            }

            if (isset($column['sortable']) && !is_bool($column['sortable'])) {
                throw new InvalidArgumentException('Column sortable must be a boolean');
            }
        }

        $this->columns = $columns;
    }

    private function validatePagination(?array $pagination)
    {
        if (!isset($pagination)) {
            $this->pagination = self::DEFAULT_PAGINATION;
            return;
        }

        if (empty($pagination)) {
            throw new InvalidArgumentException('Pagination configuration cannot be empty');
        }

        if (isset($pagination['enabled']) && !is_bool($pagination['enabled'])) {
            throw new InvalidArgumentException('Pagination enabled must be a boolean');
        }

        if (isset($pagination['perPage'])) {
            if (!is_int($pagination['perPage']) || $pagination['perPage'] <= 0) {
                throw new InvalidArgumentException('Pagination perPage must be a positive integer');
            }
        }

        if (isset($pagination['perPageOptions']) && !is_array($pagination['perPageOptions'])) {
            throw new InvalidArgumentException('Pagination perPageOptions must be an array');
        }

        foreach ($pagination['perPageOptions'] ?? [] as $option) {
            if (!is_int($option) || $option <= 0) {
                throw new InvalidArgumentException('Pagination perPageOptions must contain positive integers');
            }
        }

        $this->pagination = array_merge(self::DEFAULT_PAGINATION, $pagination);
    }

    public function updatedSearch()
    {
        if (!$this->pagination['enabled']) {
            $this->loadModelData();
            return;
        }

        $this->resetPage();
    }

    public function updatedPaginationPerPage()
    {
        $this->resetPage();
    }

    public function loadModelData()
    {
        $data = $this->model::query()
            ->when(
                $this->search,
                function ($query) {
                    $query->where(function ($query) {
                        foreach ($this->columns as $column) {
                            if (isset($column['searchable']) && $column['searchable'] === true) {
                                // dump($column['key']);
                                $query->orWhere($column['key'], 'like', "%{$this->search}%");
                            }
                        }
                    });
                }
            );

        if (!$this->pagination['enabled']) {
            return $data->get();
        }

        return $data->paginate($this->pagination['perPage']);
    }

    public function render()
    {
        $rows = $this->loadModelData();

        return view('jendtable::table', compact('rows'));
    }
}

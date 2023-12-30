<?php

namespace App\Livewire\Datatables;

use App\Models\Box;
use Illuminate\Database\Eloquent\Model;
use Arm092\LivewireDatatables\Livewire\LivewireDatatable;
use Arm092\LivewireDatatables\Column;
use Illuminate\Database\Eloquent\Builder;

class BoxesTable extends LivewireDatatable
{
    public string|null|Model $model = Box::class;

    public function builder(): Builder
    {
        return Box::query()->leftJoin('shelves', 'shelves.id', 'boxes.shelf_id')
                    ->where('boxes.team_id', auth()->user()->current_team_id);
    }    

    public function getColumns(): array|Model
    {
        return [
            Column::name('name')
            ->defaultSort('asc')
            ->searchable()
            ->hideable()
            ->editable()
            ->filterable(),

            Column::name('description')
            ->defaultSort('asc')
            ->searchable()
            ->hideable()
            ->editable()
            ->filterable(),

            Column::name('shelf.name')
            ->searchable()
            ->hideable()
            ->label('Shelf'),

        ];
    }
}

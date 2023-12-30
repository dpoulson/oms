<?php

namespace App\Livewire\Datatables;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Arm092\LivewireDatatables\Livewire\LivewireDatatable;
use Arm092\LivewireDatatables\Column;
use Illuminate\Database\Eloquent\Builder;

class ItemsTable extends LivewireDatatable
{
    public string|null|Model $model = Item::class;

    public function builder(): Builder
    {
        return Item::query()->leftJoin('boxes', 'boxes.id', 'items.box_id')
                    ->where('items.team_id', auth()->user()->current_team_id);
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

            Column::name('box.name')
            ->searchable()
            ->hideable()
            ->label('Box'),

            Column::name('datasheet_url')
            ->defaultSort('asc')
            ->searchable()
            ->hideable()
            ->link('datasheet_url')
            ->filterable(),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()
        ];
    }
}

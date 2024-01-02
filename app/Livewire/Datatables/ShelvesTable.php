<?php

namespace App\Livewire\Datatables;

use App\Models\Shelf;
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Arm092\LivewireDatatables\Livewire\LivewireDatatable;
use Arm092\LivewireDatatables\Column;
use Illuminate\Database\Eloquent\Builder;

class ShelvesTable extends LivewireDatatable
{
    public string|null|Model $model = Shelf::class;

    public function builder(): Builder
    {
        return Shelf::query()->leftJoin('locations', 'locations.id', 'shelves.location_id')
                    ->where('shelves.team_id', auth()->user()->current_team_id);
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
            ->hide()
            ->editable()
            ->filterable(),

            Column::name('location.name')
            ->searchable()
            ->hideable()
            ->filterable($this->locations)
            ->label('Location'),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()
        ];
    }

    public function getBoxesProperty()
    {
        return Box::where('team_id', auth()->user()->current_team_id)->pluck('name');
    }

    public function getShelvesProperty()
    {
        return Shelf::where('team_id', auth()->user()->current_team_id)->pluck('name');
    }

    public function getLocationsProperty()
    {
        return Location::where('team_id', auth()->user()->current_team_id)->pluck('name');
    }
}


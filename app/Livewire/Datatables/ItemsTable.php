<?php

namespace App\Livewire\Datatables;

use App\Models\Item;
use App\Models\Box;
use App\Models\Shelf;
use App\Models\Category;
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
                    ->leftJoin('categories', 'categories.id', 'items.category_id')
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
            ->hide()
            ->editable()
            ->filterable(),

            Column::name('category.name')
            ->searchable()
            ->hideable()
            ->filterable($this->categories)
            ->label('Category'),

            Column::name('box.shelf.name')
            ->searchable()
            ->hideable()
            ->filterable($this->shelves)
            ->label('Shelf'),   

            Column::name('box.name')
            ->searchable()
            ->hideable()
            ->filterable($this->boxes)
            ->label('Box'),        

            Column::callback(['id', 'quantity', 'use_quantity', 'low_quantity', 'quantity_threshold'], function($id, $quantity, $use_quantity, $low_quantity, $quantity_threshold) {
                if ($use_quantity) {
                    if ($quantity > $quantity_threshold)
                        return $quantity;
                    else 
                        return $quantity. " (Low)";
                } else {
                    if ($low_quantity) {
                        return "Low Stock";
                    } else {
                        return "In Stock";
                    }
                }
            })
            ->label('Quantity')
            ->hideable(),

            Column::name('datasheet_url')
            ->defaultSort('asc')
            ->searchable()
            ->hideable()
            ->link('datasheet_url')
            ->filterable(),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('item-table-actions', ['id' => $id, 'name' => $name]);
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

    public function getCategoriesProperty() 
    {
        return Category::pluck('name');
    }
}

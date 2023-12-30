<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Box;

class Items extends Component
{
    public $items, $boxes, $item_id, $box_id;
    public $name, $description, $use_quantity, $quantity, $low_quantity, $datasheet_url, $notes;
    public $updateMode = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteItem'=>'destroy'
    ];

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name' => 'required|min:3|max:49',
        'description' => 'max:255',
        'use_quantity' => 'boolean|nullable',
        'quantity' => 'integer',
        'low_quantity' => 'boolean',
        'datasheet_url' => 'url|nullable'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->items = Item::where('team_id', auth()->user()->current_team_id)->get();
        $this->boxes = Box::where('team_id', auth()->user()->current_team_id)->get();
        return view('livewire.items');
    }  
    
    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->name = '';
        $this->description = '';
    }

     /**
      * store the user inputted data in the table
      * @return void
      */
    public function store()
    {
        //$this->validate();
        try {
            Item::create([
                'name' => $this->name,
                'description' => $this->description,
                'team_id' => auth()->user()->current_team_id,
                'user_id' => Auth::id(),
                'box_id' => $this->box_id,
                'use_quantity' => $this->use_quantity,
                'quantity' => $this->quantity,
                'low_quantity' => false,
                'datasheet_url' => $this->datasheet_url,
                'notes' => $this->notes
            ]);
            session()->flash('success','Item Created Successfully!!');
            $this->resetFields();
        } catch (\Exception $ex) {
            dd($ex);
            session()->flash('error','Something goes wrong!!');
        }
    }
 
    /**
     * show existing data in edit form
     * @param mixed $id
     * @return void
     */
    public function edit($id){

        try {
            $item = Item::findOrFail($id);
            if( !$item) {
                session()->flash('error','Item not found');
            } else {
                $this->name = $item->name;
                $this->description = $item->description;
                $this->updateMode = true;
            }
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
 
    }
 
    /**
     * update the data
     * @return void
     */
    public function update()
    {
        $this->validate();
        try {
            Item::whereId($this->item_id)->update([
                'name' => $this->name,
                'description' => $this->description
            ]);
            session()->flash('success','Item Updated Successfully!!');
            $this->resetFields();
            $this->updateMode = false;
        } catch (\Exception $ex) {
            session()->flash('success','Something goes wrong!!');
        }
    }
 
    /**
     * Cancel Add/Edit form and redirect to listing page
     * @return void
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetFields();
    }
 
    /**
     * delete specific data from the table
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        try{
            Item::find($id)->delete();
            session()->flash('success',"Item Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }
}

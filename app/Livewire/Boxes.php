<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Box;
use App\Models\Shelf;

class Boxes extends Component
{
    public $shelves, $boxes, $quantity, $box, $name, $description, $box_id, $shelf_id;
    public $updateMode = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteShelf'=>'destroy'
    ];

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name' => 'required|min:3|max:49',
        'description' => 'max:255',
        'shelf_id' => 'required'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->boxes = Box::where('team_id', auth()->user()->current_team_id)->get();
        $this->shelves = Shelf::where('team_id', auth()->user()->current_team_id)->get();
        return view('livewire.box');
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
        $this->validate();
        try {
            Box::create([
                'name' => $this->name,
                'description' => $this->description,
                'team_id' => auth()->user()->current_team_id,
                'user_id' => Auth::id(),
                'shelf_id' => $this->shelf_id
            ]);
            session()->flash('success','Box Created Successfully!!');
            $this->resetFields();
        } catch (\Exception $ex) {
            dd($ex);
            session()->flash('error','Something goes wrong!!');
        }
    }

    /**
    * store the user inputted data in the table
    * @return void
    */
    public function bulk()
    {
        $prefix = $this->name;
        for($x = 1; $x <= $this->quantity; $x++)
        {
            try {
                Box::create([
                    'name' => $prefix." ".$x,
                    'description' => $this->description,
                    'team_id' => auth()->user()->current_team_id,
                    'user_id' => Auth::id(),
                    'shelf_id' => $this->shelf_id
                ]);
                session()->flash('success','Box Created Successfully!!');
                $this->resetFields();
            } catch (\Exception $ex) {
                dd($ex);
                session()->flash('error','Something goes wrong!!');
            }
        }
    }
 
    /**
     * show existing data in edit form
     * @param mixed $id
     * @return void
     */
    public function edit($id){

        try {
            $box = Box::findOrFail($id);
            if( !$box) {
                session()->flash('error','Box not found');
            } else {
                $this->name = $box->name;
                $this->description = $box->description;
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
            Box::whereId($this->box_id)->update([
                'name' => $this->name,
                'description' => $this->description
            ]);
            session()->flash('success','Box Updated Successfully!!');
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
            Box::find($id)->delete();
            session()->flash('success',"Box Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }
}

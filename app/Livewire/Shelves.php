<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Shelf;
use App\Models\Location;

class Shelves extends Component
{
    public $shelves, $locations, $shelf, $name, $description, $shelf_id, $location_id;
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
        'location_id' => 'required'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->shelves = Shelf::where('team_id', auth()->user()->current_team_id)->get();
        $this->locations = Location::where('team_id', auth()->user()->current_team_id)->get();
        return view('livewire.shelf');
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
            Shelf::create([
                'name' => $this->name,
                'description' => $this->description,
                'team_id' => auth()->user()->current_team_id,
                'user_id' => Auth::id(),
                'location_id' => $this->location_id
            ]);
            session()->flash('success','Shelf Created Successfully!!');
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
            $shelf = Shelf::findOrFail($id);
            if( !$shelf) {
                session()->flash('error','Shelf not found');
            } else {
                $this->name = $shelf->name;
                $this->description = $shelf->description;
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
            Shelf::whereId($this->shelf_id)->update([
                'name' => $this->name,
                'description' => $this->description
            ]);
            session()->flash('success','Shelf Updated Successfully!!');
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
            Shelf::find($id)->delete();
            session()->flash('success',"Shelf Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }
}

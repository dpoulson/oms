<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Location as Locations;

class Location extends Component
{
    public $name;
    public $description;
    public $locations;
    public $locationId;
    public $updateLocation = false;
    public $addLocation = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteLocationListner'=>'destroy'
    ];

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name' => 'required|min:3|max:49',
        'description' => 'max:255'
    ];
    
    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields(){
        $this->name = '';
        $this->description = '';
    }

    public function render()
    {
        $this->locations = Locations::where('team_id', auth()->user()->current_team_id)->get();
        return view('livewire.location');
    }

  /**
     * Open Add location form
     * @return void
     */
    public function new()
    {
        $this->resetFields();
        $this->addLocation = true;
        $this->updateLocation = false;
    }
     /**
      * store the user inputted location data in the locations table
      * @return void
      */
    public function store()
    {
        $this->validate();
        try {
            Locations::create([
                'name' => $this->name,
                'description' => $this->description,
                'team_id' => auth()->user()->current_team_id,
                'user_id' => Auth::id()
                
            ]);
            session()->flash('success','Location Created Successfully!!');
            $this->resetFields();
            $this->addLocation = false;
        } catch (\Exception $ex) {
            dd($ex);
            session()->flash('error','Something goes wrong!!');
        }
    }
 
    /**
     * show existing location data in edit location form
     * @param mixed $id
     * @return void
     */
    public function edit($id){
        try {
            $location = Locations::findOrFail($id);
            if( !$location) {
                session()->flash('error','Location not found');
            } else {
                $this->name = $location->name;
                $this->description = $location->description;
                $this->locationId = $location->id;
                $this->updateLocation = true;
                $this->addLocation = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
 
    }
 
    /**
     * update the location data
     * @return void
     */
    public function save()
    {
        $this->validate();
        try {
            Locations::whereId($this->locationId)->update([
                'name' => $this->name,
                'description' => $this->description
            ]);
            session()->flash('success','Location Updated Successfully!!');
            $this->resetFields();
            $this->updateLocation = false;
        } catch (\Exception $ex) {
            session()->flash('success','Something goes wrong!!');
        }
    }
 
    /**
     * Cancel Add/Edit form and redirect to location listing page
     * @return void
     */
    public function cancel()
    {
        $this->addLocation = false;
        $this->updateLocation = false;
        $this->resetFields();
    }
 
    /**
     * delete specific location data from the locations table
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        try{
            Locations::find($id)->delete();
            session()->flash('success',"Location Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }
}

<div>
    <div class="col-md-8 mb-2">
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif
        @if($addLocation)
            @include('livewire.locations.create')
        @endif
        @if($updateLocation)
            @include('livewire.locations.update')
        @endif
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @if(!$addLocation)
                <button wire:click="new()" class="btn btn-primary btn-sm float-right">Add New Location</button>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($locations) > 0)
                                @foreach ($locations as $location)
                                    <tr>
                                        <td>
                                            {{$location->name}}
                                        </td>
                                        <td>
                                            {{$location->description}}
                                        </td>
                                        <td>
                                            <button wire:click="edit({{$location->id}})" class="btn btn-primary btn-sm">Edit</button>
                                            <button onclick="deleteLocation({{$location->id}})" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" align="center">
                                        No locations Found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
</div>
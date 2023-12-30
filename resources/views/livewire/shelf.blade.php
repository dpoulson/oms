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
        @if($updateMode)
            @include('livewire.shelves.update')
        @else
            @include('livewire.shelves.create')
        @endif
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <button wire:click="new()" class="btn btn-primary btn-sm float-right">Add New Shelf</button>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($shelves) > 0)
                                @foreach ($shelves as $shelf)
                                    <tr>
                                        <td>
                                            {{$shelf->name}}
                                        </td>
                                        <td>
                                            {{$shelf->description}}
                                        </td>
                                        <td>
                                            {{$shelf->location->name}}
                                        </td>
                                        <td>
                                            <button wire:click="edit({{$shelf->id}})" class="btn btn-primary btn-sm">Edit</button>
                                            <button onclick="destroy({{$shelf->id}})" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" align="center">
                                        No shelves Found.
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
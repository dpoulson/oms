<div class="card">
    <div class="card-body" >
        <div x-data="{ open: false }">
        <button x-on:click="open = ! open">Quick Add</button>
            <div x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                > 
                <form class="w-full max-w-sm">
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label for="name" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">Name:</label>
                        </div>
                        <div class="md:w-2/3">
                            <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" wire:model="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label for="description" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">Description:</label>
                        </div>
                        <div class="md:w-2/3">
                            <textarea class="form-control bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('description') is-invalid @enderror" id="description" wire:model="description" placeholder="Enter Description"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>    
                    
                    
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="box_id">Location:</label>
                        </div>
                        <div class="md:w-2/3">
                            <select wire:model="location_id" id="shelf_id" class="border border-grey rounded-md bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                                <option value="-1">Select a location</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>    
                                @endforeach
                            </select>
                        </div>
                        @error('box_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button wire:click.prevent="store()" class="btn btn-success btn-block">Save</button>
                        <button wire:click.prevent="cancel()" class="btn btn-secondary btn-block">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

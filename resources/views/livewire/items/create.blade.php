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
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="category_id">Category:</label>
                        </div>
                        <div class="md:w-2/3">
                            <select wire:model="category_id" id="catgeory_id" class="border border-grey rounded-md bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                                <option value="-1">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>    
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="box_id">Box:</label>
                        </div>
                        <div class="md:w-2/3">
                            <select wire:model="box_id" id="box_id" class="border border-grey rounded-md bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                                <option value="-1">Select a box</option>
                                @foreach($boxes as $box)
                                    <option value="{{ $box->id }}">{{ $box->name }}</option>    
                                @endforeach
                            </select>
                        </div>
                        @error('box_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="use_quantity">Use Quantity:</label>
                        </div>
                        <div class="md:w-2/3">
                            <input  type="checkbox" class="form-control bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" wire:model="use_quantity">
                        </div>
                        @error('use_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="quantity">Quantity:</label>
                        </div>
                        <div class="md:w-2/3">
                            <input type="number" class="form-control bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('quantity') is-invalid @enderror" id="quantity" placeholder="Enter Quantity" wire:model="quantity">
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label for="datasheet_url" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">Datasheet URL:</label>
                        </div>
                        <div class="md:w-2/3">
                            <input type="text" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('datasheet_url') is-invalid @enderror" id="datasheet_url" placeholder="Enter Datasheet URL" wire:model="datasheet_url">
                            @error('datasheet_url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                            <label for="notes" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">Notes:</label>
                        </div>
                        <div class="md:w-2/3">
                            <textarea class="form-control bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('notes') is-invalid @enderror id="notes" wire:model="notes" placeholder="Enter Notes"></textarea>
                            @error('notes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
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

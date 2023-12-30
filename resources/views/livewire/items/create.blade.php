<div class="card">
    <div class="card-body">
        <form>
            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" wire:model="name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="description">Description:</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description" placeholder="Enter Description"></textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div>
                <select wire:model="box_id" id="box_id" class="border border-grey rounded-md">
                    @foreach($boxes as $box)
                        <option value="{{ $box->id }}">{{ $box->name }}</option>    
                    @endforeach
                </select>
            </div>
            <div>
                <label for="use_quantity">Use Quantity:</label>
                <input  type="checkbox" class="form-control" wire:model="use_quantity">
            </div>
            <div class="form-group mb-3">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" placeholder="Enter Quantity" wire:model="quantity">
                @error('quantity')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="datasheet_url">Datasheet:</label>
                <input type="text" class="form-control @error('datasheet_url') is-invalid @enderror" id="datasheet_url" placeholder="Enter Datasheet URL" wire:model="datasheet_url">
                @error('datasheet_url')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="notes">Notes:</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" wire:model="notes" placeholder="Enter Notes"></textarea>
                @error('notes')
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
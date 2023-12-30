<div>
  
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
  
    @if($updateMode)
        @include('livewire.items.update')
    @else
        @include('livewire.items.create')
    @endif
  
</div>
<div>
  
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
  
    @if($updateMode)
        @include('livewire.boxes.update')
    @else
        @include('livewire.boxes.create')
    @endif
  
</div>
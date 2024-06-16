@if ( session('error'))
    <div class="alert alert-danger alert-dive text-center">
           {{ session('error') }}
    </div>
@endif
@if ( session('success'))
    <div class="alert alert-success alert-div text-center">
            {{ session('success') }}
    </div>
@endif



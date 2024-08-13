@if (session('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger mt-4">
        {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning mt-4">
        {{ session('warning') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info mt-4">
        {{ session('info') }}
    </div>
@endif

@if (session('error_form'))
    <div class="alert alert-info mt-4">
        {{ session('info') }}
    </div>
@endif

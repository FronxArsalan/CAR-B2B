<style>
    .btn-close {
        display: inline-block !important;
        visibility: visible !important;
        color: black !important;
        opacity: 1 !important;
    }

    .btn-close:hover {
        opacity: 1;
        background-color: transparent !important;
        box-shadow: none;
    }
</style>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

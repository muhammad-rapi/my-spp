<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">{{ 'Apakah kamu yakin ingin menghapus data ini?' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>    
    @yield('modal')
    <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <form method="POST" action="/delete-major/{{ $m['id'] }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn bg-gradient-danger">Delete</button>
            </form>
        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_tag_delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma cancellazione</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3 id="custom-message">Sei sicuro di cancellare questo tag?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>

                <form id="form_delete" action="{{ route('admin.tags.destroy', ['tag' => $tag->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-square btn-danger">
                        Cancella
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

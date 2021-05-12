<button type="button" id="deleteModalTrigger" class="btn btn-danger">Delete</button>

<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-standard-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-standard-title">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> <!-- // END .modal-header -->
            <div class="modal-body">
                <p>You are going to delete this {{ $type }}. Remember all related data will be erased and it can't be recovered once its deleted. Proceed?</p>
            </div> <!-- // END .modal-body -->
            <div class="modal-footer">
                <form id="deleteForm" action="{{ $deleteUrl }}" method="post">
                    @csrf
                    @method('DELETE')

                </form>
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button form="deleteForm" type="submit" class="btn btn-danger">Yes Delete</button>
            </div> <!-- // END .modal-footer -->
        </div> <!-- // END .modal-content -->
    </div> <!-- // END .modal-dialog -->
</div> <!-- // END .modal -->

<!-- MODAL -->
<div class="modal fade" id="staffs" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="f-montserrat">ADD STAFF</h5>
            </div>
            <div class="modal-body">
                <div class="d-grid gap-2 staff-list">
                    @foreach ($staffs as $staff)
                        <button type="button" class="btn btn-outline-dark btn-md btn-block" data-staffid=" {{ $staff->staff_id }} "
                            data-staffname="{{ $staff->first_name . ' ' . $staff->last_name }}" data-bs-dismiss="modal">
                            + {{ $staff->first_name . ' ' . $staff->last_name }}
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

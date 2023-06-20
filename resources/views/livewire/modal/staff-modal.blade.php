<!-- MODAL -->
{{-- wire:ignore.self --}}
<div class="modal fade" id="staffs" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="f-montserrat">ADD STAFF</h5>
            </div>
            <div class="modal-body">
                <div class="input-search mb-4">
                    <input type="text" class="form-control" placeholder="Search Name"
                            wire:model="searchStaffName">
                </div>
                <div class="d-grid gap-1 staff-list mb-2">
                    @foreach ($staffs as $staff)
                        <button type="button" class="btn btn-outline-dark btn-md btn-block" data-bs-dismiss="modal" wire:click="addStaff('{{$currentRoleId}}', '{{$staff->staff_id}}')">
                            + {{ $staff->first_name . ' ' . $staff->last_name }}
                        </button>
                    @endforeach
                </div>
                {{ $staffs->links() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

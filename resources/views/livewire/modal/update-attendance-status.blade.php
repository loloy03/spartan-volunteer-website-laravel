<link rel="stylesheet" href="{{ asset('/css/image-model.css') }}">

<div>
    <div class="modal fade" id="update-attendance" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div>
                        <div class="row mb-4">
                            <div class="col align-items-center justify-content-end d-flex f-montserrat">
                                {{ ucwords($volunteer->first_name . ' ' . $volunteer->last_name) }}
                            </div>
                            <div class="col f-montserrat">
                                UPDATE
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col align-items-center justify-content-end d-flex f-montserrat">
                                {{ $volunteer->check_in ? date('Y-m-d', strtotime($volunteer->check_in)) : 'N/A' }}
                            </div>
                            <div class="col">
                                <label class="btn btn-secondary align-items-center d-flex">
                                    <input class="form-check-input" type="checkbox" autocomplete="off" wire:model="checked" value="checked"
                                    @if(empty($volunteer->check_in))
                                        disabled
                                    @endif> CHECK-IN
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col align-items-center justify-content-end d-flex f-montserrat">
                                {{ $volunteer->check_out ? date('Y-m-d', strtotime($volunteer->check_out)) : 'N/A' }}
                            </div>
                            <div class="col">
                                <label class="btn btn-secondary align-items-center d-flex">
                                    <input class="form-check-input" type="checkbox" autocomplete="off" wire:model="validated" value="validated"
                                    @if(empty($volunteer->check_out))
                                        disabled
                                    @endif> CHECK-OUT
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" wire:click="updateStatus({{ $volunteer->volunteer_id }})">UPDATE</button>
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</div>

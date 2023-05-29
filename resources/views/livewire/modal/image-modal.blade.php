<link rel="stylesheet" href="{{ asset('/css/image-model.css') }}">

<div>
    <div class="modal fade" id="image" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div x-data="{ hasImage: {{ $volunteer->proof_of_checkout ? 'true' : 'false' }} }">
                        <div x-show="!hasImage" class="d-flex justify-content-center align-items-center">
                            <h1>IMAGE NOT FOUND</h1>
                        </div>
                        <img src="/images/{{$volunteer->proof_of_checkout}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

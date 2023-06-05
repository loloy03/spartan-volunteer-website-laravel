<link rel="stylesheet" href="{{ asset('/css/image-model.css') }}">

<div>
    <div class="modal fade" id="receipt" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div>
                        @if (empty($volunteer->receipt))
                        <div class="d-flex justify-content-center align-items-center">
                            <h1>IMAGE NOT FOUND</h1>
                        </div>
                        @else
                            <img src="/images/{{$volunteer->receipt}}">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('/css/image-model.css') }}">

<div class="container-fluid">
    <div class="modal fade" id="receipt" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="image-area d-flex justify-content-center align-items-center">
                        {{-- 
                            IMAGE GOES HERE.
                            IMPLEMENTED VIA JAVASCRIPT
                            SEE: image-modal.js

                            Also I don't know how this isn't producing any errors
                        --}}
                        <img>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

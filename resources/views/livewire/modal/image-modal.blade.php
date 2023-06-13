<link rel="stylesheet" href="{{ asset('/css/image-model.css') }}">

<div>
    <div class="container-fluid">
        <div class="modal fade" id="image" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div>
                            @if (empty($volunteerImage))
                            <div class="d-flex justify-content-center align-items-center">
                                <h3>{{$volunteerImage}}</h3>
                            </div>
                            @else
                                <img src="/images/{{$volunteerImage}}">
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
</div>

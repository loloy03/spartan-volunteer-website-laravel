<link rel="stylesheet" href="{{ asset('/css/image-model.css') }}">

<div>
    <div class="container-fluid">
        <div class="modal fade" id="receipt" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div>
                            {{-- @if (empty($volunteer->receipt))
                            <div class="d-flex justify-content-center align-items-center">
                                <h3>NOT AVAILABLE ON STORAGE</h3>
                            </div>
                            @else
                                <img src="/images/{{$volunteer->receipt}}">
                            @endif --}}

                            <h1>{{$volunteerReceipt}}</h1>
                           
                            {{-- <img src="/images/{{ $volunteerReceipt }}"> --}}
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

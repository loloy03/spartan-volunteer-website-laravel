<!-- MODAL -->
<div class="modal fade" id="categories" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="f-montserrat">ADD CATEGORIES</h5>
            </div>
            <div class="modal-body">
                <ul class="categories" id="categories" data-group="categories">
                    @foreach ($categories as $key => $value)
                        <button class="btn btn-outline-dark mb-3" data="{{ $key }}" data-bs-dismiss="modal"> + {{$value}} </button>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
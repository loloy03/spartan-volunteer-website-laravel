<!-- MODAL -->
<div class="modal fade" id="categories" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="f-montserrat">ADD CATEGORIES</h5>
            </div>
            <div class="modal-body">
                <ul class="categories" id="categories" data-group="categories">
                    @foreach ($raceTypes as $raceType)
                        <button type="button" class="btn btn-outline-dark mb-3" wire:model="roles" wire:click="addRace('{{$raceType->race_id}}', '{{$raceType->race_type}}')" data-bs-dismiss="modal"> + {{$raceType->race_type}} </button>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
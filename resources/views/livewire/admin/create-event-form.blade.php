<div>
    <form enctype="multipart/form-data" wire:submit.prevent="submit">
        @csrf
        @include('partials.create-event-tabs')
        <div class="tab-content" id="ex1-content">
            <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                @include('livewire.admin.partials.event-form')
            </div>
            <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                @include('livewire.admin.partials.role-form')
            </div>
        </div>
    </form>
</div>
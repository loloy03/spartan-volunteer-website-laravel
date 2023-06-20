<div>
    <form enctype="multipart/form-data" wire:submit.prevent="submit">
        @csrf
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="event-tab" data-bs-toggle="tab" data-bs-target="#event" type="button"
                    role="tab" aria-controls="event" aria-selected="true" wire:ignore.self>EVENT DETAILS</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="roles-tab" data-bs-toggle="tab" data-bs-target="#roles" type="button"
                    role="tab" aria-controls="roles" aria-selected="false" wire:ignore.self>MANAGE ROLES</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="event" role="tabpanel" aria-labelledby="event-tab"
                wire:ignore.self>
                @include('livewire.admin.partials.event-form')
            </div>
            <div class="tab-pane fade" id="roles" role="tabpanel" aria-labelledby="roles-tab" wire:ignore.self>
                @include('livewire.admin.partials.role-form')
            </div>
        </div>
    </form>
</div>

<div class="row">
    <!--
        left column
    -->
    <div class="col-md-6 mt-4">
        <div class="image-file">
            <div class="image-area container-fluid">
                @if ($image)
                    <div>
                        <img src="{{ $image->temporaryUrl() }}">
                    </div>
                @else
                    <div class="upload-info">
                        <i class="bx bx-upload icon"></i>
                        <h3>Upload Image</h3>
                        <h6>Minimum Resolution: 480x360</h6>
                    </div>
                @endif
            </div>
            <input type="file" class="form-control input" id="file" accept="image/*" value="{{ old('event_pic') }}"
                wire:model="image" hidden>
        </div>
        <div wire:loading wire:target="image">Uploading...</div>
        @error('image')
            <p class="text-danger text-xs mt-1">
                {{ $message }}
            </p>
        @enderror

        <div class="form-group row mb-3 event-form">
            <label for="event" class="col-sm-4 col-form-label f-montserrat">EVENT TITLE</label>
            <div class="col-sm-8">
                <input type="text" class="form-control event-input input" name="title" id="event"
                    value="{{ old('title') }}" placeholder="Enter Title..." wire:model="title">
            </div>

            @error('title')
                <p class="text-danger text-xs mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>
        <div class="form-group row mb-3 event-form">
            <label for="desc" class="col-sm-4 col-form-label f-montserrat">DESCRIPTION</label>
            <div class="col-sm-8">
                <textarea class="form-control event-input input" name="description" id="desc" value="{{ old('description') }}"
                    placeholder="Enter Description..." wire:model="description"></textarea>
            </div>

            @error('description')
                <p class="text-danger text-xs mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>
    </div>

    <!--
        right column
    -->
    <div class="col-md-6">
        <div class="form-group row mb-3 event-form">
            <label for="loc" class="col-sm-5 col-form-label f-montserrat">LOCATION</label>
            <div class="col-sm-7">
                <input type="text" class="form-control event-input input" name="location" id="loc"
                    value="{{ old('location') }}" placeholder="Enter Location..." wire:model="location">

                @error('location')
                    <p class="text-danger text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>
        </div>
        <div class="form-group row mb-3 event-form">
            <label for="event-start" class="col-md-5 col-form-label f-montserrat">EVENT START DATE
            </label>
            <div class="col-md-7">
                <input type="date" class="form-control event-input input datepicker" value="{{ old('date') }}"
                    wire:model="date">

                @error('date')
                    <p class="text-danger text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>
        </div>
        <div class="form-group row mb-3 event-form">
            <label for="reg-start" class="col-md-5 col-form-label f-montserrat">REGISTRATION
                START</label>
            <div class="col-md-7">
                <input type="date" class="form-control event-input input" value="{{ old('start_date') }}"
                    wire:model="regStart">

                @error('regStart')
                    <p class="text-danger text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>
        </div>
        <div class="form-group row mb-3 event-form">
            <label for="reg-end" class="col-md-5 col-form-label f-montserrat ">REGISTRATION END</label>
            <div class="col-md-7">
                <input type="date" class="form-control event-input input" value="{{ old('end_date') }}"
                    wire:model="regEnd">

                @error('regEnd')
                    <p class="text-danger text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>
        </div>
        <div class="form-group row mb-3 event-form">
            <label for="event-start" class="col-md-5 col-form-label f-montserrat">CLAIM CODE START DATE
            </label>
            <div class="col-md-7">
                <input type="date" class="form-control event-input input datepicker" value="{{ old('code_start_date') }}"
                    wire:model="claimStart">

                @error('claimStart')
                    <p class="text-danger text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>
        </div>
        <div class="form-group row mb-3 event-form">
            <label for="event-end" class="col-md-5 col-form-label f-montserrat">CLAIM CODE END DATE</label>
            <div class="col-md-7">
                <input type="date" class="form-control event-input input" value="{{ old('code_end_date') }}"
                    wire:model="claimEnd">

                @error('claimEnd')
                    <p class="text-danger text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>
        </div>
        <div class="form-group row mb-3 event-form">
            <label class="col-md-5 col-form-label f-montserrat">
                <button type="button" class="btn btn-danger btn-modal" data-bs-toggle="modal"
                    data-bs-target="#categories">
                    ADD RACE +
                </button>
            </label>
            <div class="col-sm-7">
                <div class="overflow-auto">
                        {{-- race inserted here --}}
                        @foreach ($races as $raceId => $raceType)
                                <h5>
                                    <span class="badge badge-pill badge-dark">
                                        {{ucwords($raceType)}}
                                        <i role="button" class="fa-regular fa-circle-xmark" wire:click.prevent="removeRace('{{$raceId}}')"></i>
                                    </span>
                                </h5>
                        @endforeach
                </div>
                @include('livewire.modal.category-modal')
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/file-upload.js') }}"></script>

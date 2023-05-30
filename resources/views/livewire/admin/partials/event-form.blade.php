<div class="row">
    <!--
        left column
    -->
    <div class="col-md-6">
        <div class="image-file">
            <div x-data="hasImage{{$image:}}" class="image-area container-fluid">
                <div>
                    <img src="{{$image}}">
                </div>
                <div class="upload-info">
                    <i class="bx bx-upload icon"></i>
                    <h3>Upload Image</h3>
                    <h6>Minimum Resolution: 480x360</h6>
                </div>
            </div>
            <input type="file" class="form-control input" id="file" accept="image/*" value="{{ old('event_pic') }}"
                wire:change="$emit('imageUploaded')" hidden required>
        </div>
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
            <label for="reg-start" class="col-md-5 col-form-label f-montserrat">REGISTRATION
                START</label>
            <div class="col-md-7">
                <input type="text" class="form-control event-input input datepicker" name="start_date"
                    id="reg-start-datepicker" value="{{ old('start_date') }}"
                    placeholder="Enter Registration Start Date..." wire:model="regStart">

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
                <input type="text" class="form-control event-input input datepicker" name="end_date"
                    id="reg-end-datepicker" value="{{ old('end_date') }}" placeholder="Enter Registration End Date..."
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
                <input type="text" class="form-control event-input input datepicker" name="date"
                    id="event-start-datepicker" value="{{ old('date') }}" placeholder="Enter Event Start Date..."
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
                <input type="text" class="form-control event-input input datepicker" name="event_date_end"
                    id="event-end-datepicker" value="{{ old('event_date_end') }}" placeholder="Enter Event End Date..."
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
                    <ul class="list-group list-group-horizontal flex-nowrap" id="category"
                        data-group="event-categories">
                    </ul>
                </div>
                {{-- @include('layouts.category-modal') --}}
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/file-upload.js') }}"></script>
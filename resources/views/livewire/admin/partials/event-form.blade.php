<div class="row">
    <!--
        left column
    -->
    <div class="col-md-6">
        <div class="image-file">
            <input type="file" class="form-control-file input" name="event_pic" id="file" accept="image/*"
                title="Please Upload an Image" value="{{ old('event_pic') }}" hidden required>
            <div class="image-area container-fluid">
                <div class="upload-info">
                    <i class="bx bx-upload icon"></i>
                    <h3>Upload Event Image</h3>
                    <h6>Minimum Resolution: 480x360</h6>
                </div>
                <div class="remove-img" hidden>
                    <button type="button" class="btn btn-outline-danger" id="removeImg">
                        REMOVE IMAGE
                    </button>
                </div>
            </div>
        </div>
        @error('event_pic')
            <p class="text-danger text-xs mt-1">
                {{ $message }}
            </p>
        @enderror

        <div class="form-group row mb-3 event-form">
            <label for="event" class="col-sm-4 col-form-label f-montserrat">EVENT TITLE</label>
            <div class="col-sm-8">
                <input type="text" class="form-control event-input input" name="title" id="event"
                    value="{{ old('title') }}" placeholder="Enter Title...">
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
                    placeholder="Enter Description..."></textarea>
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
                    value="{{ old('location') }}" placeholder="Enter Location...">

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
                    placeholder="Enter Registration Start Date...">

                @error('start_date')
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
                    id="reg-end-datepicker" value="{{ old('end_date') }}" placeholder="Enter Registration End Date...">

                @error('end_date')
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
                    id="event-start-datepicker" value="{{ old('date') }}" placeholder="Enter Event Start Date...">

                @error('date')
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
                    id="event-end-datepicker" value="{{ old('event_date_end') }}"
                    placeholder="Enter Event End Date...">

                @error('event_date_end')
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
                    + Category
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

<div class="box-border-shadow p-3 two-color-in-div">
    <div class="d-flex justify-content-center f-montserrat">
        <div class="form-group mt-3 event-form d-grid gap-2">
            <a href="{{ route('check-attendance', $event->event_id) }}" class="btn btn-primary">
                VIEW LIST OF VOLUNTEERS
            </a>
            <a href="{{ route('add-volunteer', $event->event_id) }}" class="btn btn-primary">
                VIEW LIST OF STAFF
            </a>
            <a href="{{ route('add-volunteer', $event->event_id) }}" class="btn btn-primary">
                VIEW LIST OF FREE RACE CODES
            </a>
        </div>
    </div>
</div>

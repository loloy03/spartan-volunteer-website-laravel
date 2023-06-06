<div class="box-border-shadow p-3">
    <div class="d-flex justify-content-center f-montserrat">
        <div class="form-group mt-1 event-form d-grid gap-2">
            <a href="{{ route('event-volunteers', $event->event_id) }}" class="btn btn-danger rounded-pill">
                VIEW LIST OF VOLUNTEERS
            </a>
            <a href="{{ route('event-staffs', $event->event_id) }}" class="btn btn-danger rounded-pill">
                VIEW LIST OF STAFF
            </a>
            <a href="{{ route('claim-verify', $event->event_id) }}" class="btn btn-danger rounded-pill">
                VIEW LIST OF FREE RACE CODES
            </a>
        </div>
    </div>
</div>

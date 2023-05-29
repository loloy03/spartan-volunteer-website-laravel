<div class="box-border-shadow p-3">
    <div class="d-flex justify-content-center f-montserrat">
        <div class="form-group mt-1 event-form d-grid gap-2">
            <a href="{{ route('add-volunteer', $event->event_id) }}" class="btn btn-danger rounded-pill">
                ADD VOLUNTEERS
            </a>
            <a href="{{ route('check-attendance', $event->event_id) }}" class="btn btn-danger rounded-pill">
                VIEW LIST OF VOLUNTEERS
            </a>
        </div>
    </div>
</div>

<div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true" wire:ignore.self>ALL</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="checkin-tab" data-bs-toggle="tab" data-bs-target="#checkin" type="button" role="tab" aria-controls="checkin" aria-selected="false" wire:ignore.self>CHECK-IN</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="checkout-tab" data-bs-toggle="tab" data-bs-target="#checkout" type="button" role="tab" aria-controls="checkout" aria-selected="false" wire:ignore.self>CHECK-OUT</button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab" wire:ignore.self>
            @include('livewire.staff.partials.all-attendance')
        </div>
        <div class="tab-pane fade" id="checkin" role="tabpanel" aria-labelledby="checkin-tab" wire:ignore.self>
            @include('livewire.staff.partials.checkin-attendance')
        </div>
        <div class="tab-pane fade" id="checkout" role="tabpanel" aria-labelledby="checkout-tab" wire:ignore.self>
            @include('livewire.staff.partials.checkout-attendance')
        </div>
      </div>      
</div>

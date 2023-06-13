<div>
    <div class="table-responsive text-nowrap mt-4">
        <table class="table">
            <thead>
                <tr>
                    <div class="row g-2">
                        <div class="col-md-auto">
                            <button type="buton" class="btn btn-danger" wire:click="verifyClaim">
                                <i class="fa-regular fa-plus"></i>
                                VERIFY VOLUNTEERS
                            </button>
                        </div>
                        <div class="col-md-auto">
                            @include('partials.tables.racecode-status-select')
                        </div>
                    </div>
                    <th class="col">VERIFY</th>
                    <th class="col">RECEIPT</th>
                    <th class="col">STATUS</th>
                    <th class="col" role="button" wire:click="sort('event.location')">RACE TYPE
                        @if ($sortBy === 'race_ype')
                            <i class="fa fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                    <th class="col" role="button" wire:click="sort('first_name')">FIRST NAME
                        @if ($sortBy === 'first_name')
                            <i class="fa fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                    <th class="col" role="button" wire:click="sort('last_name')">LAST NAME
                        @if ($sortBy === 'last_name')
                            <i class="fa fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                    <th class="col" role="button" wire:click="sort('email')">EMAIL
                        @if ($sortBy === 'email')
                            <i class="fa fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                </tr>
                <tr>
                    <th class="col"></th>
                    <th class="col"></th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="Race Type" wire:model="searchRaceType">
                    </th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="First Name" wire:model="searchFirstName">
                    </th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="Last Name" wire:model="searchLastName">
                    </th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="Email" wire:model="searchEmail">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($volunteers as $volunteer)
                    <tr class="align-middle table-group-divider">
                        <td>
                            <div class="d-grid gap-1">
                                @if ($volunteer->status == 'pending')
                                    <label class="btn btn-secondary align-items-center d-flex">
                                        <input class="form-check-input" type="checkbox" autocomplete="off"
                                            wire:model="pendingClaim" value="{{ $volunteer->volunteer_id }}">VERIFY
                                    </label>
                                @endif 
                            </div>
                        </td>
                        <td>
                            @if (empty($volunteer->receipt))
                                <div class="d-flex justify-content-center align-items-center">
                                    <h5>IMAGE NOT FOUND</h5>
                                </div>
                            @else
                                <button type="button" class="btn btn-dark btn-modal" data-bs-toggle="modal" 
                                data-receipt-image="{{ $volunteer->receipt }}" data-bs-target="#receipt">
                                    VIEW
                                </button>
                            @endif
                        </td>
                        <td> 
                            @if ($volunteer->status === 'pending')
                                <h6><span
                                        class="badge rounded-pill badge-warning">{{ strtoupper($volunteer->status) }}</span>
                                </h6>
                            @elseif ($volunteer->status === 'claimed')
                                <h6><span
                                        class="badge rounded-pill badge-primary">{{ strtoupper($volunteer->status) }}</span>
                                </h6>
                            @elseif ($volunteer->status === 'released')
                                <h6><span
                                        class="badge rounded-pill badge-success">{{ strtoupper($volunteer->status) }}</span>
                                </h6>
                            @endif
                        </td>
                        <td> {{ ucwords($volunteer->race_type) }} </td>
                        <td> {{ ucwords($volunteer->first_name) }} </td>
                        <td> {{ ucwords($volunteer->last_name) }} </td>
                        <td> {{ ucwords($volunteer->email) }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $volunteers->links() }}
    </div>
    @include('partials.modals.picture-proof')
    <script src="{{ asset('js/receipt-modal.js') }}"></script>
</div>
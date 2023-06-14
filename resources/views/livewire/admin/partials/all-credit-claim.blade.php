<div>
    <div class="table-responsive text-nowrap mt-4">
        <table class="table">
            <thead>
                <tr>
                    <div class="row g-2">
                        <div class="col-md-auto">
                            @include('partials.tables.racecode-status-select')
                        </div>
                        <div class="col-md-auto">
                            <button type="buton" class="btn btn-success" wire:click="export">
                                <i class="fa-regular fa-plus"></i>
                                EXPORT
                            </button>
                        </div>
                    </div>
                    <th class="col">STATUS</th>
                    <th class="col" role="button" wire:click="sort('race_type')">RACE TYPE
                        @if ($sortBy === 'race_type')
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
</div>
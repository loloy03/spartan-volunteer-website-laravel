<div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <div class="row g-2">
                        <div class="col-md-auto">
                            @include('partials.tables.select-attendance-status')
                        </div>
                        {{-- <div class="col-md-auto">
                            @include('partials.tables.export-btn')
                        </div> --}}
                    </div>
                    <th class="col no-sort">STATUS</th>
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
                    <th class="col" role="button" wire:click="sort('event.title')">EVENT 
                        @if ($sortBy === 'event.title')
                            <i class="fa fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                    <th class="col" role="button" wire:click="sort('volunteer_status.role')">ROLE 
                        @if ($sortBy === 'volunteer_status.role')
                            <i class="fa fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                    <th class="col" role="button" wire:click="sort('event.location')">LOCATION
                        @if ($sortBy === 'event.location')
                            <i class="fa fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                    <th class="col" role="button" wire:click="sort('event.date')">DATE
                        @if ($sortBy === 'event.date')
                            <i class="fa fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                    <th class="col" role="button" wire:click="sort('volunteer_status.check_in')">CHECK-IN
                        @if ($sortBy === 'volunteer_status.check_in')
                            <i class="fa fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                    <th class="col" role="button" wire:click="sort('volunteer_status.check_out')">CHECK-OUT
                        @if ($sortBy === 'volunteer_status.check_out')
                            <i class="fa fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                </tr>
                <tr>
                    <th class="col"></th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="First Name"
                            wire:model="searchFirstName">
                    </th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="Last Name"
                            wire:model="searchLastName">
                    </th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="Event Title"
                            wire:model="searchEvent">
                    </th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="Role"
                            wire:model="searchRole">
                    </th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="Event Location"
                            wire:model="searchLocation">
                    </th>
                    <th class="col"></th>
                    <th class="col"></th>
                    <th class="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($volunteers as $volunteer)
                    <tr scope="row" class="align-middle table-group-divider">
                        <td> 
                            @if ($volunteer->attendance_status === 'checked') 
                                <h6><span class="badge rounded-pill badge-warning">{{strtoupper($volunteer->attendance_status)}}</span></h6>
                            @elseif ($volunteer->attendance_status === 'confirmed') 
                                <h6><span class="badge rounded-pill badge-primary">{{strtoupper($volunteer->attendance_status)}}</span></h6>
                            @elseif ($volunteer->attendance_status === 'validated') 
                                <h6><span class="badge rounded-pill badge-success">{{strtoupper($volunteer->attendance_status)}}</span></h6>
                            @endif
                        </td>
                        <td> {{ ucwords($volunteer->first_name) }} </td>
                        <td> {{ ucwords($volunteer->last_name )}} </td>
                        <td> {{ ucwords($volunteer->title )}} </td>
                        <td> {{ ucwords($volunteer->role )}} </td>
                        <td> {{ ucwords($volunteer->location )}} </td>
                        <td> {{ $volunteer->date ? date('Y-m-d | H:i', strtotime($volunteer->date)) : 'N/A' }} </td>
                        <td> {{ $volunteer->check_in ? date('Y-m-d | H:i', strtotime($volunteer->check_in)) : 'N/A' }}</td>
                        <td> {{ $volunteer->check_out ? date('Y-m-d | H:i', strtotime($volunteer->check_out)) : 'N/A' }}</td>
                    </tr>
                @empty
                    @include('partials.tables.empty-table')
                @endforelse
            </tbody>
        </table>
        {{-- include modal --}}
        {{ $volunteers->links() }}
    </div>
</div>

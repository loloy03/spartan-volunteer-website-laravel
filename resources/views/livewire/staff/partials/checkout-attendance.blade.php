<div>
    <div class="table-responsive text-nowrap mt-4" wire:ignore.self>
        <table class="table">
            <thead>
                <tr>
                    <div class="row g-2">
                        <div class="col-md-auto">
                            <button type="buton" class="btn btn-danger" wire:click="validateAttendance">
                                <i class="fa-regular fa-plus"></i>
                                VALIDATE CHECK-OUT
                            </button>
                        </div>
                        <div class="col-md-auto">
                            @include('partials.tables.select-attendance-status')
                        </div>
                    </div>
                    <td>UPDATE</td>
                    <th class="col no-sort">PICTURE PROOF</th>
                    <th class="col no-sort">STATUS</th>
                    <th class="col" role="button" wire:click="sort('first_name')">
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
                    <th class="col"></th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="First Name"
                            wire:model="searchFirstName">
                    </th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="Last Name" wire:model="searchLastName">
                    </th>
                    <th class="col"></th>
                    <th class="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($volunteers as $volunteer)
                    <tr class="align-middle table-group-divider">
                        <td>
                            <div class="d-grid gap-1">
                                @if (!empty($volunteer->check_out) && $volunteer->attendance_status === 'checked')
                                    <label class="btn btn-secondary align-items-center d-flex">
                                        <input class="form-check-input" type="checkbox" autocomplete="off"
                                            wire:model="validated" value="{{ $volunteer->volunteer_id }}">CHECK-OUT
                                    </label>
                                @endif 
                            </div>
                        </td>
                        <td>
                            @if (empty($volunteer->proof_of_checkout))
                                <div class="d-flex justify-content-center align-items-center">
                                    <h5>IMAGE NOT FOUND</h5>
                                </div>
                            @else
                                <button type="button" class="btn btn-dark btn-modal" data-bs-toggle="modal"
                                    wire:click.prevent="setVolunteerImage({{ $volunteer->proof_of_checkout }})" data-bs-target="#image">
                                    VIEW
                                </button>
                            @endif
                        </td>
                        <td>
                            @if ($volunteer->attendance_status === 'checked')
                                <h6><span
                                        class="badge rounded-pill badge-warning">{{ strtoupper($volunteer->attendance_status) }}</span>
                                </h6>
                            @elseif ($volunteer->attendance_status === 'confirmed')
                                <h6><span
                                        class="badge rounded-pill badge-primary">{{ strtoupper($volunteer->attendance_status) }}</span>
                                </h6>
                            @elseif ($volunteer->attendance_status === 'validated')
                                <h6><span
                                        class="badge rounded-pill badge-success">{{ strtoupper($volunteer->attendance_status) }}</span>
                                </h6>
                            @endif
                        </td>
                        <td> {{ ucwords($volunteer->first_name) }} </td>
                        <td> {{ ucwords($volunteer->last_name) }} </td>
                        <td> {{ $volunteer->check_in ? date('Y-m-d', strtotime($volunteer->check_in)) : 'N/A' }}</td>
                        <td> {{ $volunteer->check_out ? date('Y-m-d', strtotime($volunteer->check_out)) : 'N/A' }}</td>
                    </tr>
                    @include('livewire.modal.image-modal')
                @endforeach
            </tbody>
            {{ $volunteers->links() }}
        </table>
    </div>
</div>

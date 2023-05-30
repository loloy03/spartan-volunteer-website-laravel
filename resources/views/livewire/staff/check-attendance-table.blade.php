<div>
    <div class="table-responsive custom-table-responsive">
        <table class="table custom-table" id="table">
            <thead>
                @include('partials.tables.export-btn')
                <tr>
                    <th class="col no-sort">PICTURE PROOF</th>
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
                        <select class="form-control" role="button" wire:model="filterStatus">
                            <option value="" selected>STATUS</option>
                            <option value="checked">CHECKED</option>
                            <option value="confirmed">CONFIRMED</option>
                            <option value="validated">VALIDATED</option>
                        </select>
                    </th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="First Name"
                            wire:model="searchFirstName">
                    </th>
                    <th class="col">
                        <input type="text" class="form-control" placeholder="Last Name" wire:model="searchLastName">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($volunteers as $volunteer)
                    <tr scope="row" class="align-middle table-group-divider">
                        <td x-data="{ hasImage: {{ $volunteer->proof_of_checkout ? true : false }} }">
                            <div x-show="!hasImage" class="d-flex justify-content-center align-items-center">
                                <h5>NO IMAGE UPLOADED</h5>
                            </div>
                            <button x-show="hasImage" type="button" class="btn btn-dark btn-modal"
                                data-bs-toggle="modal" data-bs-target="#image">
                                IMAGE
                            </button>
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
        </table>
        {{ $volunteers->links() }}
    </div>
</div>

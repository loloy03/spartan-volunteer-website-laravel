<div>
    <div class="table-responsive custom-table-responsive">
        <table class="table custom-table" id="">
            <thead>
                <tr>
                    <div class="row g-2">
                        <div class="col-md-auto">
                            <button type="buton" class="btn btn-danger" wire:click="updateVolunteers">
                                ADD VOLUNTEERS
                            </button>
                        </div>
                        {{-- <div class="col-md-auto">
                            @include('partials.tables.export-btn')
                        </div> --}}
                    </div>
                </tr>
                <tr>
                    <th class="col">ADD TO ROLE</th>
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
                    <th class="col" role="button" wire:click="sort('occupation')">OCCUPATION
                        @if ($sortBy === 'occupation')
                            <i class="fa fa-sort-{{ $sortDirection }}"></i>
                        @else
                            <i class="fa-solid fa-sort"></i>
                        @endif
                    </th>
                </tr>
                <tr>
                    <th class="col"></th>
                    <th class="col"><input type="text" class="form-control" placeholder="First Name"
                            wire:model="searchFirstName"></th>
                    <th class="col"><input type="text" class="form-control" placeholder="Last Name"
                            wire:model="searchLastName"></th>
                    <th class="col"><input type="text" class="form-control" placeholder="Occupation"
                            wire:model="searchOccupation"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($volunteers as $volunteer)
                    <tr scope="row" class="table-row align-middle">
                        <td scope="row">
                            <div class="form-check d-flex justify-content-center">
                                <input type="checkbox" class="form-check-input input checkbox"
                                    wire:model="selectedCheckboxes" value="{{ $volunteer->volunteer_id }}" />
                            </div>
                        </td>
                        <td> {{ ucwords($volunteer->first_name) }} </td>
                        <td> {{ ucwords($volunteer->last_name) }} </td>
                        <td> {{ $volunteer->occupation ? ucwords($volunteer->occupation) : 'N/A' }}</td>
                    </tr>
                @empty
                    @include('partials.tables.empty-table')
                @endforelse
            </tbody>
        </table>
        {{ $volunteers->links() }}
    </div>
</div>

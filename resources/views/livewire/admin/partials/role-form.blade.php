       <div class="title-header mb-3 f-montserrat mt-4">
           <h1>ROLE MANAGEMENT</h1>
       </div>

       <div class="container">
           @foreach ($spartanRoles as $key => $value)
               <div class="row">
                   <div class="col">
                       <div class="form-group row role-input mb-2">
                           <div class="col-sm-3 role-label f-montserrat">
                               <h5>{{ strtoupper($value) }}</h5>
                           </div>
                           {{-- <div class="col-sm">
                               <input class="form-control event-input input" type="number" id="count">
                           </div> --}}
                           <div class="col-sm-2 add-staff">
                               <button type="button" class="btn btn-danger btn-modal staff-role" data-bs-toggle="modal"
                                   data-bs-target="#staffs" wire:click="setCurrentRoleId('{{ $key }}')">
                                   + Staff
                               </button>
                           </div>
                           <div class="col-sm-5">
                               <div class="overflow-auto d-flex gap-2">
                                   {{-- insert badges here --}}
                                   @foreach ($roles as $roleId => $staffIds)
                                       @if ($key == $roleId)
                                           @foreach ($staffIds as $staffId)
                                               <h5>
                                                   <span class="badge badge-pill badge-dark">
                                                       {{ $staffId }}
                                                       <i role="button" class="fa-regular fa-circle-xmark" wire:click.prevent="removeStaff('{{$roleId}}', '{{$staffId}}')"></i>
                                                   </span>
                                               </h5>
                                           @endforeach
                                       @endif
                                   @endforeach
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           @endforeach
       </div>

       <div class="form-group mt-3 event-form d-grid gap-2">
           <button type="submit" name="create-event" class="btn btn-danger btn-block">CREATE EVENT</button>
       </div>
       </div>
       @include('livewire.modal.staff-modal')
       </div>

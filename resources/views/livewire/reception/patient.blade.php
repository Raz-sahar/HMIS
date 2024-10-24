<div class="container">
    <!-- Flash Message Display -->
    <!-- Search Input -->
    <!-- Button to create new Patient -->
    <div class="row mb-2">

        <div class="col-md-6">
            <button wire:click="create" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">Add Patient</button>
        </div>

        <div class="col-md-3">

        </div>
        <div class="col-md-3">
            <input type="text" wire:model.live="search" class="form-control" placeholder="Search here...">
        </div>
    </div>

    <!-- Bootstrap Modal for creating or editing a Packing -->
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> <!-- Added modal-lg class for larger width -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">{{ $id ? 'Edit Patient' : 'Create Patient' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal()"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- Patient Name Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="name">Name <span class="text-danger fw-300"> *</span></label>
                            <input type="text" wire:model="name" id="name" class="form-control mt-1" placeholder="i.e. Mustafa AMINZAI">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Patient Father Name Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="father_name">Father Name</label>
                            <input type="text" wire:model="father_name" id="father_name" class="form-control mt-1" placeholder="i.e. Ahmad">
                            @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Patient Mobile Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="mobile">Mobile</label>
                            <input type="text" wire:model="mobile" id="mobile" class="form-control mt-1" placeholder="i.e. 0777000000">
                            @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Patient Email Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="email">Email</label>
                            <input type="email" wire:model="email" id="email" class="form-control mt-1" placeholder="i.e. patient@example.com">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Patient Age Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="age">Age <span class="text-danger fw-300"> *</span></label>
                            <input type="text" wire:model="age" id="age" class="form-control mt-1" placeholder="i.e. 18">
                            @error('age') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Patient Gender Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="gender">Gender</label>
                            <select wire:model="gender" id="gender" class="form-control mt-1">
                                <option value="" disabled>Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>


                    <div class="row">
                        <!-- Patient Address Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="address">Address <span class="text-danger fw-300"> *</span></label>
                            <input type="text" wire:model="address" id="address" class="form-control mt-1" placeholder="i.e. Arzan Qemat">
                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Patient City Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="city">City</label>
                            <input type="text" wire:model="city" id="city" class="form-control mt-1" placeholder="i.e. Kabul">
                            @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Patient State Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="state">Province</label>
                            <input type="text" wire:model="state" id="state" class="form-control mt-1" placeholder="i.e. Kabul">
                            @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Patient Zip Code Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" wire:model="zip_code" id="zip_code" class="form-control mt-1" placeholder="i.e. 2501">
                            @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Patient Emergency Contact Name Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="emergency_contact_name">Emergency Contact Name</label>
                            <input type="text" wire:model="emergency_contact_name" id="emergency_contact_name" class="form-control mt-1" placeholder="i.e. Ali">
                            @error('emergency_contact_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Patient Emergency Contact Number Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="emergency_contact_number">Emergency Contact Number</label>
                            <input type="text" wire:model="emergency_contact_number" id="emergency_contact_number" class="form-control mt-1" placeholder="i.e. 0777000000">
                            @error('emergency_contact_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Status Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="is_active">Status</label>
                            <select wire:model="is_active" id="is_active" class="form-control mt-1">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Created By (Auto-filled, just for display) -->
                        @if($id)
                        <div class="col-md-6 form-group mb-1">
                            <p>Created By: {{ Auth::user()->name }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <!-- Cancel Button -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <!-- Save Button -->
                    <button type="button" wire:click="{{ $id ? 'update' : 'add' }}" class="btn btn-success">
                        {{ ($id) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table displaying Patient details -->
    <div class="table-responsive">
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip Code</th>
                    <th>Emergency Name</th>
                    <th>Emergency Number</th>                    
                    <th>Staus</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                <tr>
                    <!-- <td>{{ $loop->iteration }}</td> -->
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->father_name ?? null }}</td>
                    <td>{{ $patient->mobile ?? null }}</td>
                    <td>{{ $patient->email ?? null }}</td>
                    <td>{{ $patient->age ?? null }}</td>
                    <td>{{ $patient->gender ?? null }}</td>
                    <td>{{ $patient->address ?? null }}</td>
                    <td>{{ $patient->city ?? null }}</td>
                    <td>{{ $patient->state ?? null }}</td>
                    <td>{{ $patient->zip_code ?? null }}</td>
                    <td>{{ $patient->emergency_contact_name ?? null }}</td>
                    <td>{{ $patient->emergency_contact_number ?? null }}</td>
                    <td>{!! $patient->is_active == 1 ?
                        '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}
                    </td>
                    <td>{{ ($patient->user) ? $patient->user->name : 'Unknown' }}</td>

                    <!-- Action buttons for editing and deleting -->
                    <td>
                        <button wire:click="edit({{ $patient->id }})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" title="Edit">Edit</button>
                        <button wire:click="delete({{ $patient->id }})" class="btn btn-danger btn-sm" title="Delete">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    {{ $patients->links() }}
</div>

<!-- Modal Event Listeners -->
<script>
    document.addEventListener('livewire:load', function() {
        window.addEventListener('open-modal', () => {
            var modal = new bootstrap.Modal(document.getElementById('modal'));
            modal.show();
        });

        window.addEventListener('close-modal', () => {
            var modal = bootstrap.Modal.getInstance(document.getElementById('modal'));
            modal.hide();
        });
    });


    window.addEventListener('save-modal', () => {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modal'));
        modal.hide();
    });
</script>
<div class="container">
    <!-- Flash Message Display -->
    <!-- Search Input -->
    <!-- Button to create new Service -->
    <div class="row mb-2">

        <div class="col-md-6">
            <button wire:click="create" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">Add Service</button>
        </div>

        <div class="col-md-3">

        </div>
        <div class="col-md-3">
            <input type="text" wire:model.live="search" class="form-control" placeholder="Search here...">
        </div>
    </div>

    <!-- Bootstrap Modal for creating or editing -->
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> <!-- Added modal-lg class for larger width -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">{{ $id ? 'Edit Service' : 'Create Service' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal()"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- Service Name Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="name">Name <span class="text-danger fw-300"> *</span></label>
                            <input type="text" wire:model="name" id="name" class="form-control mt-1" placeholder="i.e. CBC">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Service_Type_Id Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="service_type_id">Service Type <span class="text-danger fw-300"> *</span></label>
                            <select wire:model="service_type_id" id="service_type_id" class="form-control mt-1">
                                <option value="" disabled>Select Service Type</option>
                                @foreach($service_types as $service_type)
                                <option value="{{ $service_type->id }}">{{ $service_type->name }}</option>
                                @endforeach
                            </select>
                            @error('service_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Service Amount Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="amount">Amount <span class="text-danger fw-300"> *</span></label>
                            <input type="text" wire:model="amount" id="amount" class="form-control mt-1" placeholder="i.e. 180">
                            @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Service Currency Input -->
                        <div class="col-md-6 form-group mb-1">
                            <label for="currency">Currency</label>
                            <input type="text" wire:model="currency" id="currency" class="form-control mt-1" placeholder="i.e. AFN">
                            @error('currency') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Service Description in haing textarea with col-md-12 Input -->
                        <div class="col-md-12 form-group mb-1">
                            <label for="description">Description</label>
                            <textarea wire:model="description" id="description" class="form-control mt-1" placeholder="i.e. This is a test description" rows="3"></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
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

    <!-- Table displaying Service details -->
    <div class="table-responsive">
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Description</th>
                    <th>Service Type</th>                 
                    <th>Staus</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <!-- <td>{{ $loop->iteration }}</td> -->
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->amount }}</td>
                    <td>{{ $service->currency ?? '' }}</td>
                    <td>{{ Str::limit($service->description, 25) ?? '' }}</td>
                    <td>{{ ($service->serviceType) ? $service->serviceType->name : 'Unknown' }}</td>

                    <td>{!! $service->is_active == 1 ?
                        '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}
                    </td>
                    <td>{{ ($service->user) ? $service->user->name : 'Unknown' }}</td>

                    <!-- Action buttons for editing and deleting -->
                    <td>
                        <button wire:click="edit({{ $service->id }})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" title="Edit">Edit</button>
                        <button wire:click="delete({{ $service->id }})" class="btn btn-danger btn-sm" title="Delete">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    {{ $services->links() }}
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
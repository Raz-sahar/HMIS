<div class="container">
    <!-- Flash Message Display -->
    <!-- Search Input -->
    <!-- Button to create new Packing -->
    <div class="row mb-2">

        <div class="col-md-6">
            <button wire:click="create" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">Add Packing</button>
        </div>

        <div class="col-md-3">

        </div>
        <div class="col-md-3">
            <input type="text" wire:model.live="search" class="form-control" placeholder="Search here...">
        </div>
    </div>

    <!-- Bootstrap Modal for creating or editing a Packing -->
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">{{ $id ? 'Edit Packing' : 'Create Packing' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <!-- Packing Name Input -->
                    <div class="form-group mb-1">
                        <label for="name">Name</label>
                        <input type="text" wire:model="name" id="name" class="form-control mt-1" placeholder="Enter name...">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- description -->
                    <div class="form-group mb-1">
                        <label for="description">Description</label>
                        <input type="text" wire:model="description" id="description" class="form-control mt-1" placeholder="Enter description...">
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Div for Status Input -->
                    <div class="form-group mb-1">
                        <label for="is_active">Status</label>
                        <select wire:model="is_active" id="is_active" class="form-control mt-1">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    <!-- Created By (Auto-filled, just for display) -->
                    @if($id)
                    <p>Created By: {{ Auth::user()->name }}</p>
                    @endif
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

    <!-- Table displaying Packing details -->
    <div class="table-responsive">
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Staus</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packings as $packing)
                <tr>
                    <td>
                        <!-- Display S.No start from 1 -->
                        {{ $loop->iteration }}
                    </td>
                    <!-- Display Packing name -->
                    <td>{{ $packing->name }}</td>

                    <!-- description in text datatype should display only 25 characters-->
                    <td>{{ Str::limit($packing->description, 25) }}</td>

                    <!-- Status if is_active = 1 means active else inactive -->
                    <td>
                        {!! $packing->is_active == 1 ?
                        '<span class="badge bg-success">Active</span>' :
                        '<span class="badge bg-danger">Inactive</span>' !!}
                    </td>

                    <!-- Display Packing creator's name -->
                    <td>{{ ($packing->user) ? $packing->user->name : 'Unknown' }}</td>

                    <!-- Action buttons for editing and deleting -->
                    <td>
                        <button wire:click="edit({{ $packing->id }})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" title="Edit">Edit</button>
                        <button wire:click="delete({{ $packing->id }})" class="btn btn-danger btn-sm" title="Delete">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    {{ $packings->links() }}
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
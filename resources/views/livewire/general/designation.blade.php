<div class="container">
    <!-- Flash Message Display -->
    <!-- Search Input -->
    <!-- Button to create new Company -->
    <div class="row mb-2">

        <div class="col-md-6">
            <button wire:click="create" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">Add Designation</button>
        </div>

        <div class="col-md-3">

        </div>
        <div class="col-md-3">
            <input type="text" wire:model.live="search" class="form-control" placeholder="Search here...">
        </div>
    </div>

    <!-- Bootstrap Modal for creating or editing a Company -->
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">{{ $id ? 'Edit Designation' : 'Create Designation' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <!-- Company Name Input -->
                    <div class="form-group mb-4">
                        <label for="name">Name</label>
                        <input type="text" wire:model="name" id="name" class="form-control mt-1" placeholder="Enter name...">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Div for Status Input -->
                    <div class="form-group mb-4">
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

    <!-- Table displaying company details -->
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Staus</th>
                <th>Created By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($designations as $designation)
            <tr>
                <td>
                    <!-- Display S.No start from 1 -->
                    {{ $loop->iteration }}
                </td>
                <!-- Display company name -->
                <td>{{ $designation->name  ?? 'N/A' }}</td>

                <!-- Status if is_active = 1 means active else inactive -->
                <td>
                    {!! $designation->is_active == 1 ?
                    '<span class="badge bg-success">Active</span>' :
                    '<span class="badge bg-danger">Inactive</span>' !!}
                </td>

                <!-- Display designation creator's name -->
                <td>{{ ($designation->user) ? $designation->user->name : 'Unknown' }}</td>

                <!-- Action buttons for editing and deleting -->
                <td>
                    <button wire:click="edit({{ $designation->id }})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" title="Edit">Edit</button>
                    <button wire:click="delete({{ $designation->id }})" class="btn btn-danger btn-sm" title="Delete">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $designations->links() }}
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

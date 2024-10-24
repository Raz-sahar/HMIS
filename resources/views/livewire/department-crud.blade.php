

<div class="container">
    <!-- Flash Message Display -->
    <!-- Search Input -->
    <!-- Button to create new department -->
    <div class="row mb-2">

    <div class="col-md-6">
    <button wire:click="create" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#departmentModal">Create Department</button>
    </div>
    <div class="col-md-3">

    </div>
    <div class="col-md-3">
    <input type="text" wire:model.live="search" class="form-control" placeholder="Search here...">
    </div>
    </div>

    <!-- Bootstrap Modal for creating or editing a department -->
    <div wire:ignore.self class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="departmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="departmentModalLabel">{{ $department_id ? 'Edit Department' : 'Create Department' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal()"></button>
                </div>
                <div class="modal-body">
                    <!-- Department Name Input -->
                    <div class="form-group">
                        <label for="name">Department Name</label>
                        <input type="text" wire:model="name" id="name" class="form-control" placeholder="Department Name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Image Upload Input -->
                    <div class="form-group">
                        <label for="image">Department Image</label>
                        <input type="file" wire:model="image" id="image" class="form-control">
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Image Preview (for new or editing mode) -->
                    @if ($image && !$department_id)
                        <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail mb-2" width="100">
                    @elseif ($department_id)
                        <img src="{{ asset('storage/' . $departments->find($department_id)->image) }}" class="img-thumbnail mb-2" width="100">
                    @endif

                    <!-- Created By (Auto-filled, just for display) -->
                    @if($department_id)
                        <p>Created By: {{ Auth::user()->name }}</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <!-- Cancel Button -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <!-- Save Button -->
                    <button type="button" wire:click="{{ $department_id ? 'update' : 'add' }}" class="btn btn-success">
                        {{ $department_id ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table displaying department details -->
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Created By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
                <tr>
                    <!-- Display department name -->
                    <td>{{ $department->name }}</td>

                    <!-- Display department image -->
                    <td>
                        @if($department->image)
                            <img src="{{ asset('storage/' . $department->image) }}" alt="Image" class="img-thumbnail" width="100">
                        @else
                            No Image
                        @endif
                    </td>

                    <!-- Display department creator's name -->
                    <td>{{ $department->createdBy ? $department->createdBy->name : 'Unknown' }}</td>

                    <!-- Action buttons for editing and deleting -->
                    <td>
                        <button wire:click="edit({{ $department->id }})" class="btn btn-primary btn-smS" data-bs-toggle="modal" data-bs-target="#departmentModal">Edit</button>
                        <button wire:click="delete({{ $department->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $departments->links() }}
</div>

<!-- Modal Event Listeners -->
<script>
    document.addEventListener('livewire:load', function () {
        window.addEventListener('open-modal', () => {
            var modal = new bootstrap.Modal(document.getElementById('departmentModal'));
            modal.show();
        });

        window.addEventListener('close-modal', () => {
            var modal = bootstrap.Modal.getInstance(document.getElementById('departmentModal'));
            modal.hide();
        });
    });


    window.addEventListener('department-saved', () => {
        var modal = bootstrap.Modal.getInstance(document.getElementById('departmentModal'));
        modal.hide();
    });
</script>

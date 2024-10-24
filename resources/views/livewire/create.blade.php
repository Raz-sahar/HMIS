
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

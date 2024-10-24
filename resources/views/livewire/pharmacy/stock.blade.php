<div class="container">
    <!-- Flash Message Display -->
    <!-- Search Input -->
    <!-- Button to create new Stock -->
    <div class="row mb-2">

        <div class="col-md-6">
            <button wire:click="create" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">Add Stock</button>
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
                    <h5 class="modal-title" id="modalLabel">{{ $id ? 'Edit Stock' : 'Create Stock' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal()"></button>
                </div>

                <!-- 'batch_no' => $this->batch_no,
            'quantity_in_stock' => $this->quantity_in_stock,
            'minimum_required_quantity' => $this->minimum_required_quantity ? $this->minimum_required_quantity : null,
            'reorder_level' => $this->reorder_level ? $this->reorder_level : null,
            'expiry_date' => $this->expiry_date, -->

                <div class="modal-body">

                    <div class="form-group mb-1">
                        <label for="product_id">Product Name</label>
                        <select wire:model="product_id" id="product_id" class="form-control mt-1">
                            <option value="">Select Stock</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-1">
                        <label for="batch_no">Batch No</label>
                        <input wire:model="batch_no" type="text" class="form-control mt-1" id="batch_no" placeholder="Enter Batch No">
                        @error('batch_no') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-1">
                        <label for="quantity_in_stock">Quantity</label>
                        <input wire:model="quantity_in_stock" type="number" class="form-control mt-1" id="quantity_in_stock" placeholder="Enter Quantity...">
                        @error('quantity_in_stock') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-1">
                        <label for="expiry_date">Expiry Date</label>
                        <input wire:model="expiry_date" type="date" class="form-control mt-1" id="expiry_date" placeholder="Enter Expiry Date">
                        @error('expiry_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-1">
                        <label for="minimum_required_quantity">Minimum Quantity</label>
                        <input wire:model="minimum_required_quantity" type="number" class="form-control mt-1" id="minimum_required_quantity" placeholder="Enter Min Qtty...">
                        @error('minimum_required_quantity') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-1">
                        <label for="reorder_level">Reorder Level</label>
                        <input wire:model="reorder_level" type="number" class="form-control mt-1" id="reorder_level" placeholder="Reorder Level...">
                        @error('reorder_level') <span class="text-danger">{{ $message }}</span> @enderror
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

    <!-- Table displaying Stock details -->
    <div class="table-responsive">
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <!-- <th>S.No</th> -->
                    <th>Code</th>
                    <th>Name</th>
                    <th>Batch No</th>
                    <th>Expiry Date</th>
                    <th>Quantity</th>
                    <th>Cost Price</th>
                    <th>Sale Price</th>
                    <th>Min Qtty</th>
                    <th>Reorder</th>
                    <th>Staus</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                <tr>
                    <!-- <td>{{ $loop->iteration }}</td> -->
                    <td>{{ $stock->product->id }}</td>
                    <td>{{ $stock->product->name }}</td>
                    <td>{{ $stock->batch_no }}</td>
                    <td>{{ date('d-m-Y', strtotime($stock->expiry_date)) }}</td>
                    <td>{{ $stock->quantity_in_stock }}</td>
                    <td>{{ $stock->product->cost_price }}</td>
                    <td>{{ $stock->product->sale_price }}</td>
                    <td>{{ $stock->minimum_required_quantity ?? null }}</td>
                    <td>{{ $stock->reorder_level ?? null }}</td>
                    <td>{!! $stock->is_active == 1 ?
                        '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}
                    </td>

                    <!-- Display Stock creator's name -->
                    <td>{{ ($stock->user) ? $stock->user->name : 'Unknown' }}</td>

                    <!-- Action buttons for editing and deleting -->
                    <td>
                        <button wire:click="edit({{ $stock->id }})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" title="Edit">Edit</button>
                        <button wire:click="delete({{ $stock->id }})" class="btn btn-danger btn-sm" title="Delete">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    {{ $stocks->links() }}
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
<div class="container">
    <!-- Flash Message Display -->

    <!-- I want a Modal that Display the Purhcase related information as $id, $supplier_id, $purchase_no, $purchase_date, $total_amount, $total_discount, $total_quantity, $is_active in the Header as Common,
    and Display the Purchase Details inforamtion as $purchase_id, $product_id, $batch_no, $mgf_date, $expiry_date, $quantity, $bonus_quantity, $unit_price, $discount, $amount in tabular form in the Body as Common.
    Also the Add, Edit, Delete, Search, Previous & Next as Pagination, Preview, Print, Export to Excel, PDF, CSV Action Buttons at the Footer of the Modal. -->

    <!-- Bootstrap Modal for creating or editing a Packing -->
    <div wire:ignore.self class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">
                        @if ($purchase_id)
                            Edit Purchase
                        @else
                            Create Purchase
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body
                    @if ($purchase_id)
                        bg-light
                    @endif">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group
                                    @error('purchase_no') has-error @enderror">
                                    <label for="purchase_no">Purchase No</label>
                                    <input type="text" class="form-control" id="purchase_no" name="purchase_no" wire:model="purchase_no" placeholder="Enter Purchase No">
                                    @error('purchase_no') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group
                                    @error('purchase_date') has-error @enderror">
                                    <label for="purchase_date">Purchase Date</label>
                                    <input type="date" class="form-control" id="purchase_date" name="purchase_date" wire:model="purchase_date" placeholder="Enter Purchase Date">
                                    @error('purchase_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group

                                    @error('supplier_id') has-error @enderror">
                                    <label for="supplier_id">Supplier</label>
                                    <select class="form-control" id="supplier_id" name="supplier_id" wire:model="supplier_id">
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @error('total_amount') has-error @enderror">
                                    <label for="total_amount">Total Amount</label>
                                    <input type="text" class="form-control" id="total_amount" name="total_amount" wire:model="total_amount" placeholder="Enter Total Amount">
                                    @error('total_amount') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group
                                    @error('total_discount') has-error @enderror">
                                    <label for="total_discount">Total Discount</label>
                                    <input type="text" class="form-control" id="total_discount" name="total_discount" wire:model="total_discount" placeholder="Enter Total Discount">
                                    @error('total_discount') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group
                                    @error('total_quantity') has-error @enderror">
                                    <label for="total_quantity">Total Quantity</label>
                                    <input type="text" class="form-control" id="total_quantity" name="total_quantity" wire:model="total_quantity" placeholder="Enter Total Quantity">
                                    @error('total_quantity') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group
                                    @error('is_active') has-error @enderror">
                                    <label for="is_active">Status</label>
                                    <select class="form-control" id="is_active" name="is_active" wire:model="is_active">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title
                                            @if ($purchase_id)
                                                bg-light
                                            @endif">Purchase Details</h3>
                                    </div> 

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Batch No</th>
                                                        <th>Mgf Date</th>
                                                        <th>Expiry Date</th>
                                                        <th>Quantity</th>
                                                        <th>Bonus Quantity</th>
                                                        <th>Unit Price</th>
                                                        <th>Discount</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($purchaseDetails as $key => $purchaseDetail)
                                                        <tr>
                                                            <td>
                                                                <select class="form-control" id="product_id" name="product_id" wire:model="purchaseDetails.{{ $key }}.product_id">
                                                                    <option value="">Select Product</option>
                                                                    @foreach ($products as $product)
                                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="batch_no" name="batch_no" wire:model="purchaseDetails.{{ $key }}.batch_no" placeholder="Enter Batch No">
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" id="mgf_date" name="mgf_date" wire:model="purchaseDetails.{{ $key }}.mgf_date" placeholder="Enter Mgf Date">
                                                            </td>
                                                            <td>
                                                                <input type="date" class="form-control" id="expiry_date" name="expiry_date" wire:model="purchaseDetails.{{ $key }}.expiry_date" placeholder="Enter Expiry Date">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="quantity" name="quantity" wire:model="purchaseDetails.{{ $key }}.quantity" placeholder="Enter Quantity">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="bonus_quantity" name="bonus_quantity" wire:model="purchaseDetails.{{ $key }}.bonus_quantity" placeholder="Enter Bonus Quantity">
                                                            </td>
                                                            <td>
                                                                <input type="text" class
                                                                    @error('unit_price') has-error @enderror" id="unit_price" name="unit_price" wire:model="purchaseDetails.{{ $key }}.unit_price" placeholder="Enter Unit Price">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="discount" name="discount" wire:model="purchaseDetails.{{ $key }}.discount" placeholder="Enter Discount">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="amount" name="amount" wire:model="purchaseDetails.{{ $key }}.amount" placeholder="Enter Amount">
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-danger" wire:click.prevent="removePurchaseDetail({{ $key }})">Remove</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="10">
                                                            <button class="btn btn-sm btn-primary" wire:click.prevent="addPurchaseDetail">Add Purchase Detail</button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="savePurchase">Save</button>
                </div>
            </div>
        </div>
    </div>
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
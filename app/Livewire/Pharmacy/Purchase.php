<?php

namespace App\Livewire\Pharmacy;

use App\Models\Pharmacy\Product;
use App\Models\Pharmacy\Purchase as PharmacyPurchase;
use App\Models\Pharmacy\PurchaseDetail;
use App\Models\Pharmacy\Supplier;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Purchase extends Component
{
    use WithFileUploads, WithPagination;
    //for purchase
    public $id, $supplier_id, $purchase_no, $purchase_date, $total_amount, $total_discount, $total_quantity, $is_active;
    //for purchase detail
    public $purchase_id, $product_id, $batch_no, $mgf_date, $expiry_date, $quantity, $bonus_quantity, $unit_price, $discount, $amount;


    public $search = ''; // Add a search variable
    public $isOpen = 0;

    protected $paginationTheme = 'bootstrap'; // To use Bootstrap for pagination

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when search query is updated
    }

    public function render()
    {
        $suppliers = Supplier::where('is_delete', 0)->where('is_active', 1)->get();
        $products = Product::where('is_delete', 0)->where('is_active', 1)->get();
        $purchaseDetails = PurchaseDetail::where('is_delete', 0)->where('is_active', 1)->get();

        $purchases = PharmacyPurchase::where('is_delete', 0)->where('is_active', 1)
            ->with('supplier', 'purchaseDetails', 'user')
            ->latest()
            ->paginate(10);

        return view('livewire.pharmacy.purchase', [
            'purchases' => $purchases,
            'suppliers' => $suppliers,
            'products' => $products,
            'purchaseDetails' => $purchaseDetails,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
        $this->dispatch('open-modal');
    }

    public function closeModal()
    {
        $this->resetInputFields();
        $this->dispatch('close-modal');
    }

    private function resetInputFields()
    {
        $this->id = null;
        $this->supplier_id = null;
        $this->purchase_no = null;
        $this->purchase_date = null;
        $this->total_amount = null;
        $this->total_discount = null;
        $this->total_quantity = null;
        $this->purchase_id = null;
        $this->product_id = null;
        $this->batch_no = null;
        $this->mgf_date = null;
        $this->expiry_date = null;
        $this->quantity = null;
        $this->bonus_quantity = null;
        $this->unit_price = null;
        $this->discount = null;
        $this->amount = null;
        $this->is_active = 1;
    }

    public function add()
    {
        $this->validate([
            'supplier_id' => 'required',
            'purchase_no' => 'required',
            'purchase_date' => 'required|date',
            'product_id' => 'required',
            'mgf_date' => 'required|date',
            'expiry_date' => 'required|date',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'amount' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        $user_id = Auth::user()->id;

        
        // Store the relevent data in two different tables purchases and purchase_details
        // store the data in purchases table
        $purchase = PharmacyPurchase::create([
            'supplier_id' => $this->supplier_id,
            'purchase_no' => $this->purchase_no,
            'purchase_date' => $this->purchase_date,
            'total_amount' => $this->total_amount,
            'total_discount' => $this->total_discount,
            'total_quantity' => $this->total_quantity,
            'is_active' => $this->is_active,
            'created_by' => $user_id,
        ]);

        // store the data in purchase_details table
        $purchase->purchaseDetails()->create([
            'product_id' => $this->product_id,
            'batch_no' => $this->batch_no,
            'mgf_date' => $this->mgf_date,
            'expiry_date' => $this->expiry_date,
            'quantity' => $this->quantity,
            'bonus_quantity' => $this->bonus_quantity,
            'unit_price' => $this->unit_price,
            'discount' => $this->discount,
            'amount' => $this->amount,
            'is_active' => $this->is_active,
            'created_by' => $user_id,
        ]);        

        $this->resetInputFields();
        $this->dispatch('close-modal');
        $this->dispatch('save-modal');
        $this->dispatch('success', message: 'Record created successfully.');
    }
    
    public function edit($id)
    {
        // Show the relevent data from two different tables purchases related in header and footer of Modal and purchase_details in a tabular format
        $data = PharmacyPurchase::findOrFail($id);
        $this->id = $id;
        $this->supplier_id = $data->supplier_id;
        $this->purchase_no = $data->purchase_no;
        $this->purchase_date = $data->purchase_date;
        $this->total_amount = $data->total_amount;
        $this->total_discount = $data->total_discount;
        $this->total_quantity = $data->total_quantity;
        $this->is_active = $data->is_active;

        $this->purchase_id = $data->purchaseDetails->purchase_id;
        $this->product_id = $data->purchaseDetails->product_id;
        $this->batch_no = $data->purchaseDetails->batch_no;
        $this->mgf_date = $data->purchaseDetails->mgf_date;
        $this->expiry_date = $data->purchaseDetails->expiry_date;
        $this->quantity = $data->purchaseDetails->quantity;
        $this->bonus_quantity = $data->purchaseDetails->bonus_quantity;
        $this->unit_price = $data->purchaseDetails->unit_price;
        $this->discount = $data->purchaseDetails->discount;
        $this->amount = $data->purchaseDetails->amount;

        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'supplier_id' => 'required',
            'purchase_no' => 'required',
            'purchase_date' => 'required|date',
            'product_id' => 'required',
            'mgf_date' => 'required|date',
            'expiry_date' => 'required|date',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'amount' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        // update the relevent data in two different tables purchases and purchase_details
        // update the data in purchases table
        $data = PharmacyPurchase::findOrFail($this->id);
        $data->update([
            'supplier_id' => $this->supplier_id,
            'purchase_no' => $this->purchase_no,
            'purchase_date' => $this->purchase_date,
            'total_amount' => $this->total_amount,
            'total_discount' => $this->total_discount,
            'total_quantity' => $this->total_quantity,
            'is_active' => $this->is_active,
        ]);

        // update the data in purchase_details table
        $data->purchaseDetails()->update([
            'product_id' => $this->product_id,
            'batch_no' => $this->batch_no,
            'mgf_date' => $this->mgf_date,
            'expiry_date' => $this->expiry_date,
            'quantity' => $this->quantity,
            'bonus_quantity' => $this->bonus_quantity,
            'unit_price' => $this->unit_price,
            'discount' => $this->discount,
            'amount' => $this->amount,
            'is_active' => $this->is_active,
        ]);

        $this->resetInputFields();
        $this->dispatch('close-modal');
        $this->dispatch('save-modal');
        $this->dispatch('success', message: 'Record updated successfully.');
    }

    // Delete the relevent data from two different tables purchases and purchase_details as is_delete = 1
    public function delete($id)
    {
        // delete the data in purchases table
        $data = PharmacyPurchase::findOrFail($id);
        $data->update([
            'is_delete' => 1,
        ]);
        // delete the data in purchase_details table
        $data->purchaseDetails()->update([
            'is_delete' => 1,
        ]);
        // display notification
        $this->dispatch('success', message: 'Record deleted successfully.');
    }
}

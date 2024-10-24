<?php

namespace App\Livewire\Pharmacy;

use App\Models\Pharmacy\Product;
use App\Models\Pharmacy\Stock as PharmacyStock;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Stock extends Component
{

    public $id, $product_id, $batch_no, $quantity_in_stock, $minimum_required_quantity, $reorder_level, $expiry_date, $created_by, $updated_by, $deleted_by, $is_active, $is_delete;

    public $search = ''; // Add a search variable
    public $isOpen = 0;

    protected $paginationTheme = 'bootstrap'; // To use Bootstrap for pagination

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when search query is updated
    }

    public function render()
    {
        $products = Product::where('is_delete', 0)->where('is_active', 1)->get();
        // Add a search filter 
        $stocks = PharmacyStock::with(['user', 'product'])
            ->where('is_delete', 0) // Only display records where is_delete is 0
            ->where(function ($query) {
                $query->whereHas('product', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%'); // Search filter for product name
                })
                ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%'); // Search filter for creator's name
                });
            })
            ->paginate(10); // Paginate results (adjust as needed)

        return view('livewire.pharmacy.stock', ['stocks' => $stocks, 'products' => $products]);
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
        $this->product_id = '';
        $this->batch_no = '';
        $this->quantity_in_stock = '';
        $this->minimum_required_quantity = '';
        $this->reorder_level = '';
        $this->expiry_date = '';
        $this->is_active = 1;
    }

    public function add()
    {
        $this->validate([
            'product_id' => 'required',
            'quantity_in_stock' => 'required',
            'expiry_date' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $user_id = Auth::user()->id;

        PharmacyStock::create([
            'product_id' => $this->product_id,
            'batch_no' => $this->batch_no ? $this->batch_no : null,
            'quantity_in_stock' => $this->quantity_in_stock,
            'expiry_date' => $this->expiry_date,
            'minimum_required_quantity' => $this->minimum_required_quantity ? $this->minimum_required_quantity : null,
            'reorder_level' => $this->reorder_level ? $this->reorder_level : null,
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
        $data = PharmacyStock::findOrFail($id);
        $this->id = $data->id;
        $this->product_id = $data->product_id;
        $this->batch_no = $data->batch_no;
        $this->quantity_in_stock = $data->quantity_in_stock;
        $this->minimum_required_quantity = $data->minimum_required_quantity;
        $this->reorder_level = $data->reorder_level;
        $this->expiry_date = $data->expiry_date;
        $this->is_active = $data->is_active;

        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'product_id' => 'required',
            'quantity_in_stock' => 'required',
            'expiry_date' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $data = PharmacyStock::findOrFail($this->id);

        $data->update([
            'product_id' => $this->product_id,
            'batch_no' => $this->batch_no ? $this->batch_no : null,
            'expiry_date' => $this->expiry_date,
            'quantity_in_stock' => $this->quantity_in_stock,
            'minimum_required_quantity' => $this->minimum_required_quantity ? $this->minimum_required_quantity : null,
            'reorder_level' => $this->reorder_level ? $this->reorder_level : null,
            'is_active' => $this->is_active,
            'updated_by' => Auth::user()->id,
        ]);

        $this->resetInputFields();
        $this->dispatch('close-modal');
        $this->dispatch('save-modal');
        $this->dispatch('success', message: 'Record updated successfully.');
    }

    public function delete($id)
    {
        $data = PharmacyStock::findOrFail($id);
        $data->update(['is_delete' => 1]);
        $this->dispatch('error', message: 'Record marked as deleted successfully.');
    }
}

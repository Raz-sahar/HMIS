<?php

namespace App\Livewire\Pharmacy;

use App\Models\Pharmacy\Company as PharmacyCompany;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;


class Company extends Component
{
    use WithFileUploads, WithPagination;
    public $id ,$name, $created_by, $updated_by, $deleted_by, $is_active, $is_delete;
    public $search = ''; // Add a search variable
    public $isOpen = 0;

    protected $paginationTheme = 'bootstrap'; // To use Bootstrap for pagination

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when search query is updated
    }

    public function render()
    {
        // Add a search filter for both department name and creator's name
        $companies = PharmacyCompany::with('user')
            ->where('is_delete', 0) // Only display records where is_delete is 0
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%') // Search filter for department name
                      ->orWhereHas('user', function ($query) {
                          $query->where('name', 'like', '%' . $this->search . '%'); // Search filter for creator's name
                      });
            })
            ->paginate(10); // Paginate results (adjust as needed)

        return view('livewire.pharmacy.company', ['companies' => $companies]);
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
        $this->name = '';
        $this->is_active = 1; // Default value
    }

    public function add()
    {
        $this->validate([
            'name' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $user_id = Auth::user()->id;

        PharmacyCompany::create([
            'name' => $this->name,
            'created_by' => $user_id,
        ]);

        $this->resetInputFields();
        $this->dispatch('close-modal');
        $this->dispatch('save-modal');
        $this->dispatch('success', message: 'Record created successfully.');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'is_active' => 'required|boolean',
        ]);

        $data = PharmacyCompany::findOrFail($this->id);

        $data->update([
            'name' => $this->name,
            'updated_by' => Auth::user()->id,
            'is_active' => $this->is_active,
        ]);

        $this->resetInputFields();
        $this->dispatch('close-modal');
        $this->dispatch('save-modal');
        $this->dispatch('success', message: 'Record updated successfully.');
    }

    public function edit($id)
    {
        $data = PharmacyCompany::findOrFail($id);
        $this->id = $data->id;
        $this->name = $data->name;
        $this->is_active = $data->is_active;

        $this->openModal();
    }

    public function delete($id)
    {
        $data = PharmacyCompany::findOrFail($id);
        $data->update(['is_delete' => 1]);
        $this->dispatch('error', message: 'Record marked as deleted successfully.');
    }
}
<?php

namespace App\Livewire\Reception;

use App\Livewire\General\Department;
use App\Livewire\General\Employee;
use App\Models\Reception\Fee as ReceptionFee;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Fee extends Component
{
    public $id, $fees_type, $amount, $currency, $description, $employee_id, $department_id, $created_by, $updated_by, $deleted_by, $is_active, $is_delete;

    public $search = ''; // Add a search variable
    public $isOpen = 0;

    protected $paginationTheme = 'bootstrap'; // To use Bootstrap for pagination

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when search query is updated
    }

    public function render()
    {
        // $employees = Employee::where('is_delete', 0)->where('is_active', 1)->get(); // Get all active employees
        // $departments = Department::where('is_delete', 0)->where('is_active', 1)->get(); // Get all active departments
        // Add a search filter
        $fees = ReceptionFee::with(['user'])
            ->where('is_delete', 0) // Only display records where is_delete is 0
            ->where(function ($query) {
                $query->where('fees_type', 'like', '%' . $this->search . '%') // Search filter for fees type
                      ->orWhereHas('user', function ($query) {
                          $query->where('name', 'like', '%' . $this->search . '%'); // Search filter for creator's name
                      });
            })
            ->paginate(10); // Paginate results (adjust as needed)

        return view('livewire.reception.fee', ['fees' => $fees]);
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
        $this->fees_type = '';
        $this->amount = '';
        $this->currency = '';
        $this->description = '';
        $this->employee_id = '';
        $this->department_id = '';
        $this->is_active = 1;
    }

    public function add()
    {
        $this->validate([
            'fees_type' => 'required',
            'amount' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        $user_id = Auth::user()->id;

        ReceptionFee::create([
            'fees_type' => $this->fees_type,
            'amount' => $this->amount,
            'currency' => $this->currency ? $this->currency : null,
            'description' => $this->description ? $this->description : null,
            'employee_id' => $this->employee_id ? $this->employee_id : null,
            'department_id' => $this->department_id ? $this->department_id : null,
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
        $data = ReceptionFee::findOrFail($id);
        $this->id = $data->id;
        $this->fees_type = $data->fees_type;
        $this->amount = $data->amount;
        $this->currency = $data->currency;
        $this->description = $data->description;
        $this->employee_id = $data->employee_id;
        $this->department_id = $data->department_id;
        $this->is_active = $data->is_active;

        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'fees_type' => 'required',
            'amount' => 'required|numeric',
            'is_active' => 'required|boolean',
        ]);

        $data = ReceptionFee::findOrFail($this->id);

        $data->update([
            'fees_type' => $this->fees_type,
            'amount' => $this->amount,
            'currency' => $this->currency ? $this->currency : null,
            'description' => $this->description ? $this->description : null,
            'employee_id' => $this->employee_id ? $this->employee_id : null,
            'department_id' => $this->department_id ? $this->department_id : null,
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
        $data = ReceptionFee::findOrFail($id);
        $data->update(['is_delete' => 1]);
        $this->dispatch('error', message: 'Record marked as deleted successfully.');
    }
}
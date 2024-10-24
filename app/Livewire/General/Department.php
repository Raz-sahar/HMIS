<?php

namespace App\Livewire\General;

use App\Models\General\Department as GeneralDepartment;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Department extends Component
{
    use WithFileUploads, WithPagination;

    public $id, $name, $code, $department_head, $location, $phone_number,$email, $created_by, $updated_by, $deleted_by, $is_active, $is_delete;

    public $search = ''; // Add a search variable
    public $isOpen = 0;

    protected $paginationTheme = 'bootstrap'; // To use Bootstrap for pagination


    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when search query is updated
    }

    public function render()
    {
        $Employees = User::get();
        // Add a search filter for both department name and creator's name
        $departments = GeneralDepartment::with(['Department_Head','Created_By','updated_by','Deleted_By'])
            ->where('is_delete', 0) // Only display records where is_delete is 0
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%') // Search filter for department name
                      ->orWhereHas('Created_By', function ($query) {
                          $query->where('name', 'like', '%' . $this->search . '%'); // Search filter for creator's name
                      });
            })
            ->paginate(10); // Paginate results (adjust as needed)

        return view('livewire.general.department', ['departments' => $departments, 'Employees' => $Employees]);
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
        $this->id = '';
        $this->name = '';
        $this->code = '';
        $this->department_head= '';
        $this->location = '';
        $this->phone_number = '';
        $this->email = '';
        $this->is_active = 1; // Default value
    }

    public function add()
    {
        $this->validate([
            'name' => 'required',
            'code' => 'required',
            'department_head' => 'required',
            'phone_number' => 'required',
            'email'=>'required',
            'is_active' => 'required|boolean',
        ]);

        $user_id = Auth::user()->id;

        GeneralDepartment::create([
            'name' => $this->name,
            'code' => $this->code,
            'department_head' => $this->department_head,
            'location' => $this->location ?? null,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'is_active' => $this->is_active,
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
            'code' => 'required',
            'department_head' => 'required',
            'phone_number' => 'required',
            'email'=>'required',
            'is_active' => 'required|boolean',
        ]);

        $data = GeneralDepartment::findOrFail($this->id);

        $data->update([
            'name' => $this->name,
            'code' => $this->code,
            'department_head' => $this->department_head,
            'location' => $this->location ?? null,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'is_active' => $this->is_active,
            'updated_by' => Auth::user()->id,
        ]);

        $this->resetInputFields();
        $this->dispatch('close-modal');
        $this->dispatch('save-modal');
        $this->dispatch('success', message: 'Record updated successfully.');
    }

    public function edit($id)
    {
        $data = GeneralDepartment::findOrFail($id);
        $this->id = $data->id;
        $this->name = $data->name;
        $this->code = $data->code;
        $this->department_head = $data->department_head;
        $this->location = $data->location;
        $this->phone_number = $data->phone_number;
        $this->email= $data->email;
        $this->is_active = $data->is_active;

        $this->openModal();
    }

    public function delete($id)
    {
        $data = GeneralDepartment::findOrFail($id);
        $data->update(['is_delete' => 1]);
        $this->dispatch('error', message: 'Record marked as deleted successfully.');
    }

}


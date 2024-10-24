<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Department;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;


class DepartmentCrud extends Component
{
    use WithFileUploads, WithPagination;

    public $name, $department_id, $image;
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
        $departments = Department::with('createdBy')
            ->where('name', 'like', '%' . $this->search . '%') // Search filter for department name
            ->orWhereHas('createdBy', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%'); // Search filter for creator's name
            })
            ->paginate(10); // Paginate results (adjust as needed)

        return view('livewire.department-crud', ['departments' => $departments]);
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
        $this->department_id = null;
        $this->name = '';
        $this->image = null;
    }

    public function add()
    {
        $this->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:1024',
        ]);

        if ($this->image) {
            $imagePath = $this->image->store('departments', 'public');
        }

        $userId = Auth::user()->id;

        Department::create([
            'name' => $this->name,
            'image' => $imagePath ?? null,
            'created_by' => $userId,
        ]);

        $this->resetInputFields();
        $this->dispatch('close-modal');
        $this->dispatch('department-saved');
        $this->dispatch('success', message: 'Department created successfully.');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'image' => $this->image ? 'nullable|image|max:1024' : '',
        ]);

        $department = Department::findOrFail($this->department_id);

        if ($this->image) {
            $imagePath = $this->image->store('departments', 'public');
        }

        $department->update([
            'name' => $this->name,
            'image' => $imagePath ?? $department->image,
        ]);

        $this->resetInputFields();
        $this->dispatch('close-modal');
        $this->dispatch('department-saved');
        $this->dispatch('success', message: 'Department updated successfully.');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $this->department_id = $id;
        $this->name = $department->name;
        $this->image = $department->image;

        $this->openModal();
    }

    public function delete($id)
    {
        Department::find($id)->delete();
        $this->dispatch('error', message: 'Department deleted successfully.');
    }
}

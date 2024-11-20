<?php

namespace App\Livewire;

use Liveware\Component;

// App\Http\Livewire\CustomerIndex.php
class CustomerIndex extends Component {
    public $customers, $company_id, $name, $description, $customer_id;
    public $isModalOpen = 0;

    public function render() {
        $this->customers = Customer::all();
        return view('livewire.customer-index');
    }

    public function create() {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal() {
        $this->isModalOpen = true;
    }

    public function closeModal() {
        $this->isModalOpen = false;
    }

    private function resetInputFields() {
        $this->name = '';
        $this->description = '';
        $this->customer_id = '';
    }

    public function store() {
        $this->validate([
            'company_id' => 'required',
            'name' => 'required',
            'description' => 'nullable',
        ]);

        Customer::updateOrCreate(['id' => $this->customer_id], [
            'company_id' => $this->company_id,
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', $this->customer_id ? 'Customer Updated Successfully.' : 'Customer Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id) {
        $customer = Customer::findOrFail($id);
        $this->customer_id = $id;
        $this->company_id = $customer->company_id;
        $this->name = $customer->name;
        $this->description = $customer->description;

        $this->openModal();
    }

    public function delete($id) {
        Customer::find($id)->delete();
        session()->flash('message', 'Customer Deleted Successfully.');
    }
}

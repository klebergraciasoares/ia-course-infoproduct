<?php

namespace App\Livewire;

use Liveware\Component;

// App\Http\Livewire\ProductIndex.php
class ProductIndex extends Component {
    public $products, $company_id, $name, $description, $price, $product_id;
    public $isModalOpen = 0;

    public function render() {
        $this->products = Product::all();
        return view('livewire.product-index');
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
        $this->price = '';
        $this->product_id = '';
    }

    public function store() {
        $this->validate([
            'company_id' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
        ]);

        Product::updateOrCreate(['id' => $this->product_id], [
            'company_id' => $this->company_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ]);

        session()->flash('message', $this->product_id ? 'Product Updated Successfully.' : 'Product Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->company_id = $product->company_id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;

        $this->openModal();
    }

    public function delete($id) {
        Product::find($id)->delete();
        session()->flash('message', 'Product Deleted Successfully.');
    }
}

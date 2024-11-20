<?php

namespace App\Livewire;

use Liveware\Component;

// App\Http\Livewire\OrderIndex.php
class OrderIndex extends Component {
    public $orders, $company_id, $customer_id, $subtotal, $total, $order_id;
    public $isModalOpen = 0;

    public function render() {
        $this->orders = Order::all();
        return view('livewire.order-index');
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
        $this->company_id = '';
        $this->customer_id = '';
        $this->subtotal = '';
        $this->total = '';
        $this->order_id = '';
    }

    public function store() {
        $this->validate([
            'company_id' => 'required',
            'customer_id' => 'required',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        Order::updateOrCreate(['id' => $this->order_id], [
            'company_id' => $this->company_id,
            'customer_id' => $this->customer_id,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
        ]);

        session()->flash('message', $this->order_id ? 'Order Updated Successfully.' : 'Order Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id) {
        $order = Order::findOrFail($id);
        $this->order_id = $id;
        $this->company_id = $order->company_id;
        $this->customer_id = $order->customer_id;
        $this->subtotal = $order->subtotal;
        $this->total = $order->total;

        $this->openModal();
    }

    public function delete($id) {
        Order::find($id)->delete();
        session()->flash('message', 'Order Deleted Successfully.');
    }
}

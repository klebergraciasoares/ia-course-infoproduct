<!-- resources/views/livewire/order-index.blade.php -->
<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if($isModalOpen)
        @include('livewire.create-order')
    @endif

    <button wire:click="create()">Create New Order</button>

    <table class="table-fixed w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Customer ID</th>
                <th class="px-4 py-2">Subtotal</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td class="border px-4 py-2">{{ $order->customer_id }}</td>
                <td class="border px-4 py-2">{{ $order->subtotal }}</td>
                <td class="border px-4 py-2">{{ $order->total }}</td>
                <td class="border px-4 py-2">
                    <button wire:click="edit({{ $order->id }})">Edit</button>
                    <button wire:click="delete({{ $order->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

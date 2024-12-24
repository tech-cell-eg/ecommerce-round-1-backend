@extends('layouts.dashboard')
@section('content')


<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Order Details </h3>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Order #{{ $order->id }}</h4>
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> Field </th>
                                    <th> Value </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> Order ID </td>
                                    <td> {{ $order->id }} </td>
                                </tr>
                                <tr>
                                    <td> User Name </td>
                                    <td> {{ $order->user->name ?? 'N/A' }} </td>
                                </tr>
                                <tr>
                                    <td> Address </td>
                                    <td> {{ $order->address->address ?? 'N/A' }} </td>
                                </tr>
                                <tr>
                                    <td> Card Used </td>
                                    <td> {{ $order->card->card_number ?? 'N/A' }} </td>
                                </tr>
                                <tr>
                                    <td> Status </td>
                                    <td> {{ $order->status }} </td>
                                </tr>
                                <tr>
                                    <td> Delivery Date </td>
                                    <td> {{ $order->delivery_date ?? 'N/A' }} </td>
                                </tr>
                                <tr>
                                    <td> Discount Code </td>
                                    <td> {{ $order->discount_code ?? 'None' }} </td>
                                </tr>
                                <tr>
                                    <td> Delivery Charge </td>
                                    <td> ${{ $order->delivery_charge }} </td>
                                </tr>
                                <tr>
                                    <td> Grand Total </td>
                                    <td> ${{ $order->grand_total }} </td>
                                </tr>
                                <tr>
                                    <td> Review </td>
                                    <td> {{ $order->review ?? 'No review submitted' }} </td>
                                </tr>
                            </tbody>
                        </table>

                        <h4 class="mt-5">Ordered Products</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> Product Name </th>
                                    <th> Quantity </th>
                                    <th> Size </th>
                                    <th> Price </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $product)
                                    <tr>
                                        <td> {{ $product->name }} </td>
                                        <td> {{ $product->pivot->quantity }} </td>
                                        <td> {{ $product->pivot->size ?? 'N/A' }} </td>
                                        <td> ${{ $product->pivot->price }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a href="{{ route('orders.index') }}" class="btn btn-primary mt-4">Back to Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
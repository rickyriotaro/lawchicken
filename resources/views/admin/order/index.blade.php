@extends('layouts.admin')
@section('title', 'order')
@section('content')
<section>
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>Order</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Customer</th>
                                    <th>Table number</th>
                                    <th>Menu</th>
                                    <th>Qty</th>
                                    <th>Sub total</th>
                                    <th>Create at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    @if($item->is_active == 1)
                                    <td>
                                        <span class="bg-warning badge text-bg-warning text-light">menu sedang di siapkan</span>
                                    </td>
                                    @elseif($item->is_active == 2)
                                    <td>
                                        <span class="bg-success badge text-bg-succes text-light">sudah dibayar</span>
                                    </td>
                                    @else
                                    <td>
                                        <span class="bg-primary badge text-bg-primary text-light">selesai</span>
                                    </td>
                                    @endif
                                    <td>{{ $item->customer->name }}</td>
                                    <td>{{ $item->table->table_number }}</td>
                                   <td>{{ $item->product->name }}</td>
                                   <td>{{ $item->qty }}</td>
                                   <td>{{ $item->subtotal }}</td>
                                   <td>{{ $item->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
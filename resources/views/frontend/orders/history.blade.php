@extends('layout.template')

@section('content')
<div class="container py-5">
    <h2 class="font-weight-bold mb-4">Pesanan Saya</h2>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            @forelse($orders as $order)
            <div class="card border-0 shadow-sm rounded-lg mb-4 overflow-hidden">
                <div class="card-header bg-white border-bottom-0 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small">No. Invoice:</span>
                            <span class="font-weight-bold ml-1">{{ $order->invoice_number }}</span>
                        </div>
                        <span class="badge badge-pill 
                            @if($order->status == 'pending') badge-warning 
                            @elseif($order->status == 'processing') badge-info 
                            @elseif($order->status == 'completed') badge-success 
                            @else badge-danger @endif px-3 py-2">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body px-4">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="text-muted small mb-3">Item yang dibeli:</h6>
                            @foreach($order->items as $item)
                            <div class="d-flex mb-2">
                                <i class="fas fa-shopping-basket text-primary mr-2"></i>
                                <span>{{ $item->product_name }} <small class="text-muted">({{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }})</small></span>
                            </div>
                            @endforeach
                            
                            <div class="mt-4">
                                <h6 class="text-muted small mb-1">Alamat Pengiriman:</h6>
                                <p class="small text-dark mb-0">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-right mt-3 mt-md-0 d-flex flex-column justify-content-end">
                            <span class="text-muted small">Total Pembayaran:</span>
                            <h4 class="font-weight-bold text-primary mb-0">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h4>
                            <small class="text-muted mt-2">Dipesan pada: {{ $order->created_at->format('d M Y, H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="card border-0 shadow-sm rounded-lg p-5 text-center">
                <i class="fas fa-receipt fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Kamu belum pernah melakukan pesanan.</h5>
                <a href="{{ route('homepage') }}" class="btn btn-primary mt-3 px-4">Mulai Belanja</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

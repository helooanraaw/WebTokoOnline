@extends('layout.template')

@section('content')
<div class="container py-5">
    <h2 class="font-weight-bold mb-4 text-dark text-display-md" style="letter-spacing: -0.5px;">Pesanan Saya</h2>

    @if(session('success'))
        <div class="alert alert-success border-0 mb-4" style="border-radius: var(--radius-links); background-color: var(--color-surface-frost); color: var(--color-text-primary);">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            @forelse($orders as $order)
            <div class="card card-frost mb-4 overflow-hidden">
                <div class="card-header bg-white border-bottom-0 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted text-caption">No. Invoice:</span>
                            <span class="font-weight-bold ml-1 text-dark text-body">{{ $order->invoice_number }}</span>
                        </div>
                        <span class="font-weight-600 px-3 py-1.5" style="font-size: 12px; border-radius: 980px;
                            @if($order->status == 'pending') background-color: #fdf0e7; color: var(--color-accent-orange);
                            @elseif($order->status == 'processing') background-color: #e0f0ff; color: var(--color-action-blue);
                            @elseif($order->status == 'completed') background-color: #e6f9ed; color: var(--color-success-green);
                            @else background-color: #ffeef0; color: #ff3b30; @endif">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body px-4 py-4">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="text-muted text-caption mb-3">Item yang dibeli:</h6>
                            @foreach($order->items as $item)
                            <div class="d-flex mb-2 align-items-center">
                                <i class="fas fa-shopping-basket mr-2 text-muted" style="font-size: 14px;"></i>
                                <span class="text-dark text-body font-weight-500">
                                    {{ $item->product_name }} 
                                    <small class="text-muted">({{ $item->qty }} x Rp {{ number_format($item->price, 0, ',', '.') }})</small>
                                </span>
                            </div>
                            @endforeach
                            
                            <div class="mt-4">
                                <h6 class="text-muted text-caption mb-1">Alamat Pengiriman:</h6>
                                <p class="text-muted text-body mb-0">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-right mt-3 mt-md-0 d-flex flex-column justify-content-end">
                            <span class="text-muted text-caption">Total Pembayaran:</span>
                            <h4 class="font-weight-bold text-dark mb-0 text-heading-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h4>
                            <small class="text-muted mt-2 text-caption">Dipesan pada: {{ $order->created_at->format('d M Y, H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="card card-white p-5 text-center">
                <i class="fas fa-receipt fa-4x text-muted mb-3" style="opacity: 0.5;"></i>
                <h5 class="text-muted text-body-lg">Kamu belum pernah melakukan pesanan.</h5>
                <a href="{{ route('homepage') }}" class="btn-primary-filled mt-3 px-4 align-self-center">Mulai Belanja</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

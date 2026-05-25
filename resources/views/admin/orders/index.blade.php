@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-weight-bold mb-0">Manajemen Pesanan</h2>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 pl-4">Invoice</th>
                        <th class="border-0">Pelanggan</th>
                        <th class="border-0">Total</th>
                        <th class="border-0">Tanggal</th>
                        <th class="border-0">Status</th>
                        <th class="border-0 text-right pr-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="pl-4 align-middle">
                            <span class="font-weight-bold">{{ $order->invoice_number }}</span>
                        </td>
                        <td class="align-middle">
                            <span class="d-block">{{ $order->user->name }}</span>
                            <small class="text-muted">{{ $order->user->email }}</small>
                        </td>
                        <td class="align-middle font-weight-bold text-primary">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="align-middle text-muted">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="align-middle">
                            <span class="badge badge-pill 
                                @if($order->status == 'pending') badge-warning 
                                @elseif($order->status == 'processing') badge-info 
                                @elseif($order->status == 'completed') badge-success 
                                @else badge-danger @endif px-3 py-2">
                                {{ strtoupper($order->status) }}
                            </span>
                        </td>
                        <td class="text-right pr-4 align-middle">
                            <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-receipt fa-3x mb-3 d-block"></i>
                            Belum ada pesanan masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@extends('layout.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-weight-bold mb-0 text-dark">Manajemen Pesanan</h2>
</div>

<div class="card card-white">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
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
                            <span class="font-weight-bold text-dark text-body-lg">{{ $order->invoice_number }}</span>
                        </td>
                        <td class="align-middle text-body">
                            <span class="d-block font-weight-600 text-dark">{{ $order->user->name }}</span>
                            <small class="text-muted">{{ $order->user->email }}</small>
                        </td>
                        <td class="align-middle font-weight-bold text-dark text-body">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="align-middle text-muted text-caption">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="align-middle">
                            <span class="font-weight-600 px-3 py-1" style="font-size: 11px; border-radius: 980px; display: inline-block;
                                @if($order->status == 'pending') background-color: #fdf0e7; color: var(--color-accent-orange);
                                @elseif($order->status == 'processing') background-color: #e0f0ff; color: var(--color-action-blue);
                                @elseif($order->status == 'completed') background-color: #e6f9ed; color: var(--color-success-green);
                                @else background-color: #ffeef0; color: #ff3b30; @endif">
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
                            <i class="fas fa-receipt fa-3x mb-3 d-block" style="opacity: 0.5;"></i>
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

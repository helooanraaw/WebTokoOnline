@extends('layout.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.order.index') }}" class="text-muted text-decoration-none">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Pesanan
    </a>
    <h2 class="font-weight-bold mt-2">Detail Pesanan: {{ $order->invoice_number }}</h2>
</div>

<div class="row">
    <!-- Informasi Order -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-lg mb-4">
            <div class="card-body p-4">
                <h5 class="font-weight-bold mb-4">Daftar Produk</h5>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0">Produk</th>
                                <th class="border-0 text-center">Harga</th>
                                <th class="border-0 text-center">Jumlah</th>
                                <th class="border-0 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td class="align-middle">
                                    <span class="font-weight-bold d-block">{{ $item->product_name }}</span>
                                    <small class="text-muted">ID: #{{ $item->product_id }}</small>
                                </td>
                                <td class="text-center align-middle">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-center align-middle">{{ $item->qty }}</td>
                                <td class="text-right align-middle font-weight-bold">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right font-weight-bold pt-4">Total Tagihan:</td>
                                <td class="text-right font-weight-bold text-primary pt-4 h4">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-lg">
            <div class="card-body p-4">
                <h5 class="font-weight-bold mb-3">Alamat Pengiriman</h5>
                <p class="text-muted mb-0" style="line-height: 1.6;">{{ $order->shipping_address }}</p>
            </div>
        </div>
    </div>

    <!-- Informasi Status & Customer -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-lg mb-4">
            <div class="card-body p-4">
                <h5 class="font-weight-bold mb-3">Update Status Pesanan</h5>
                <form action="{{ route('admin.order.status', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <select name="status" class="form-control">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing (Diproses)</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block shadow-sm">
                        <i class="fas fa-save mr-1"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-lg mb-4">
            <div class="card-body p-4">
                <h5 class="font-weight-bold mb-3">Informasi Pelanggan</h5>
                <div class="d-flex align-items-center mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ $order->user->name }}&background=4F46E5&color=fff" class="rounded-circle mr-3" style="width: 50px;">
                    <div>
                        <h6 class="font-weight-bold mb-0">{{ $order->user->name }}</h6>
                        <small class="text-muted">{{ $order->user->email }}</small>
                    </div>
                </div>
                <hr>
                <div class="small">
                    <p class="mb-1 text-muted">Metode Pembayaran:</p>
                    <p class="font-weight-bold text-dark">{{ $order->payment_method }}</p>
                    
                    <p class="mb-1 text-muted">Tanggal Pesanan:</p>
                    <p class="font-weight-bold text-dark mb-0">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

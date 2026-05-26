@extends('layout.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.order.index') }}" class="text-muted text-decoration-none text-caption">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Pesanan
    </a>
    <h2 class="font-weight-bold mt-2 text-dark text-heading-lg">Detail Pesanan: {{ $order->invoice_number }}</h2>
</div>

<div class="row">
    <!-- Informasi Order -->
    <div class="col-md-8">
        <div class="card card-white mb-4">
            <div class="card-body p-4">
                <h5 class="font-weight-bold mb-4 text-dark text-heading-lg">Daftar Produk</h5>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
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
                                    <span class="font-weight-bold d-block text-dark text-body-lg">{{ $item->product_name }}</span>
                                    <small class="text-muted text-caption">ID: #{{ $item->product_id }}</small>
                                </td>
                                <td class="text-center align-middle text-body">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-center align-middle text-body">{{ $item->qty }}</td>
                                <td class="text-right align-middle font-weight-bold text-dark text-body">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right font-weight-bold pt-4 text-body-lg">Total Tagihan:</td>
                                <td class="text-right font-weight-bold text-dark pt-4 text-heading-lg">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-white">
            <div class="card-body p-4">
                <h5 class="font-weight-bold mb-3 text-dark text-heading-lg">Alamat Pengiriman</h5>
                <p class="text-muted mb-0 text-body" style="line-height: 1.6;">{{ $order->shipping_address }}</p>
            </div>
        </div>
    </div>

    <!-- Informasi Status & Customer -->
    <div class="col-md-4">
        <div class="card card-white mb-4">
            <div class="card-body p-4">
                <h5 class="font-weight-bold mb-3 text-dark text-heading-lg">Update Status Pesanan</h5>
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
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save mr-1"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

        <div class="card card-white mb-4">
            <div class="card-body p-4">
                <h5 class="font-weight-bold mb-3 text-dark text-heading-lg">Informasi Pelanggan</h5>
                <div class="d-flex align-items-center mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($order->user->name) }}&background=0071e3&color=fff" class="rounded-circle mr-3" style="width: 50px;">
                    <div>
                        <h6 class="font-weight-bold mb-0 text-dark text-body-lg">{{ $order->user->name }}</h6>
                        <small class="text-muted">{{ $order->user->email }}</small>
                    </div>
                </div>
                <hr style="border-top: 1px solid #d2d2d7;">
                <div class="text-body">
                    <p class="mb-1 text-muted text-caption">Metode Pembayaran:</p>
                    <p class="font-weight-bold text-dark">{{ $order->payment_method }}</p>
                    
                    <p class="mb-1 text-muted text-caption">Tanggal Pesanan:</p>
                    <p class="font-weight-bold text-dark mb-0">{{ $order->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

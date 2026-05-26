<footer class="footer-custom">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h6 class="font-weight-bold text-dark mb-3">
                    <i class="fab fa-apple mr-2"></i>iStore PakPras
                </h6>
                <p>Authorized Reseller Apple terpercaya di Indonesia. Kami menghadirkan iPhone orisinal dan aksesoris resmi dengan garansi resmi untuk mendukung gaya hidup digital Anda.</p>
                <div class="mt-3 text-muted">
                    <a href="#" class="mr-3 text-muted"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="mr-3 text-muted"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="mr-3 text-muted"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <h6 class="font-weight-bold text-dark mb-3">Jelajahi iStore</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('homepage') }}">Semua Produk</a></li>
                    <li><a href="{{ route('homepage', ['category' => 'iphone-pro']) }}">iPhone Pro</a></li>
                    <li><a href="{{ route('homepage', ['category' => 'iphone']) }}">iPhone</a></li>
                    <li><a href="{{ route('homepage', ['category' => 'aksesoris']) }}">Aksesoris</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="font-weight-bold text-dark mb-3">Dukungan & Kontak</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-map-marker-alt mr-2"></i> Apple Center, Lantai 2, Jakarta, Indonesia</li>
                    <li class="mb-2"><i class="fas fa-phone mr-2"></i> (021) 500-APPLE</li>
                    <li class="mb-2"><i class="fas fa-envelope mr-2"></i> support@pakpras-istore.com</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-center text-muted">
                <p class="mb-0">&copy; {{ date('Y') }} iStore PakPras. All rights reserved. Apple, iPhone, and MagSafe are trademarks of Apple Inc.</p>
                <div class="mt-2 mt-md-0">
                    <a href="#" class="mr-3">Kebijakan Privasi</a>
                    <a href="#" class="mr-3">Ketentuan Layanan</a>
                    <a href="#">Legalitas</a>
                </div>
            </div>
        </div>
    </div>
</footer>
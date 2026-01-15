{{-- ================================================
FUNGSI: Komponen kartu produk yang reusable
================================================ --}}

<div class="card product-card h-100 border-0 shadow-sm">
    {{-- Product Image --}}
    <div class="position-relative pb-3">
        <a href="{{ route('catalog.show', $product->slug) }}">
            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}"
                style="height: 200px; object-fit: cover;">
        </a>

        {{-- Badge Diskon --}}
        @if($product->discount_price && $product->discount_price < $product->price)
            <span class="badge-discount" style="position: absolute; top: 10px; left: 10px; background-color: red; color: white; padding: 5px; border-radius: 5px; font-weight: bold; z-index: 1;">
                -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
            </span>
        @endif

        {{-- Wishlist Button --}}
        @auth
            <button onclick="toggleWishlist({{ $product->id }})"
                {{-- Pastikan ada class wishlist-btn-ID --}}
                class="wishlist-btn-{{ $product->id }} btn btn-light btn-sm rounded-circle p-2 transition shadow-sm">
                <i class="bi {{ Auth::user()->hasInWishlist($product) ? 'bi-heart-fill text-danger' : 'bi-heart text-secondary' }} fs-5"></i>
            </button>
        @endauth
    </div>

    {{-- Card Body --}}
    <div class="card-body d-flex flex-column">
        {{-- Category --}}
        <small class="text-muted mb-1">{{ $product->category->name }}</small>

        {{-- Product Name --}}
        <h6 class="card-title mb-2">
            <a href="{{ route('catalog.show', $product->slug) }}" class="text-decoration-none text-dark stretched-link">
                {{ Str::limit($product->name, 40) }}
            </a>
        </h6>

        {{-- Price --}}
        <div class="mt-auto">
            @if($product->has_discount)
                <small class="text-muted text-decoration-line-through">
                    {{ $product->formatted_original_price }}
                </small>
            @endif
            <div class="fw-bold text-primary">
                {{ $product->formatted_price }}
            </div>
        </div>

        {{-- Stock Info --}}
        @if($product->stock <= 5 && $product->stock > 0)
            <small class="text-warning mt-2">
                <i class="bi bi-exclamation-triangle"></i>
                Stok tinggal {{ $product->stock }}
            </small>
        @elseif($product->stock == 0)
            <small class="text-danger mt-2">
                <i class="bi bi-x-circle"></i> Stok Habis
            </small>
        @endif
    </div>

    {{-- Card Footer --}}
    <div class="card-footer bg-white border-0 pt-0">
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="btn btn-primary btn-sm w-100" @if($product->stock == 0) disabled @endif>
                <i class="bi bi-cart-plus me-1"></i>
                @if($product->stock == 0)
                    Stok Habis
                @else
                    Tambah Keranjang
                @endif
            </button>
        </form>
    </div>
</div>
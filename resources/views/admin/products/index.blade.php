@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="mb-0 text-primary fw-bold">Daftar Produk</h5>

                    <div class="d-flex gap-2">
                        {{-- Filter Kategori --}}
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                id="filterCategory" data-bs-toggle="dropdown">
                                <i class="bi bi-filter me-1"></i>
                                {{-- Perbaikan: Mencari kategori berdasarkan ID sesuai logic Controller --}}
                                {{ request('category') && $categories->firstWhere('id', request('category'))
        ? $categories->firstWhere('id', request('category'))->name
        : 'Semua Kategori' }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">Semua Kategori</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @foreach($categories as $category)
                                    <li>
                                        {{-- Perbaikan: Mengirim ID, bukan Slug, agar sesuai dengan Controller --}}
                                        <a class="dropdown-item {{ request('category') == $category->id ? 'active' : '' }}"
                                            href="{{ route('admin.products.index', ['category' => $category->id]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="bi bi-plus-lg me-1"></i> Tambah Baru
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary">
                                <tr>
                                    <th class="ps-4" style="width: 30%">Nama Produk</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Berat</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-end pe-4">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                {{-- Menampilkan gambar utama dari relasi primaryImage --}}
                                                @if($product->primaryImage)
                                                    <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}"
                                                        class="rounded shadow-sm me-3" width="45" height="45"
                                                        style="object-fit: cover;">
                                                    {{-- Fallback jika hanya ada kolom 'image' di tabel products (data seeder) --}}
                                                @elseif($product->image)
                                                    <img src="{{ asset('storage/products/' . $product->image) }}"
                                                        class="rounded shadow-sm me-3" width="45" height="45"
                                                        style="object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-3"
                                                        style="width:45px;height:45px;">
                                                        <i class="bi bi-image text-muted"></i>
                                                    </div>
                                                @endif

                                                <div>
                                                    <div class="fw-bold text-dark">{{ $product->name }}</div>
                                                    <small class="text-muted">Slug: {{ $product->slug }}</small>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <span
                                                class="badge rounded-pill bg-info text-dark px-3">{{ $product->category->name }}</span>
                                        </td>

                                        <td class="text-center">
                                            <span class="text-muted small">{{ $product->weight }}g</span>
                                        </td>

                                        <td class="text-center">
                                            @if($product->is_active)
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success px-3">Aktif</span>
                                            @else
                                                <span
                                                    class="badge bg-secondary-subtle text-secondary border border-secondary px-3">Nonaktif</span>
                                            @endif
                                        </td>

                                        <td class="text-center fw-bold text-primary">
                                            Rp{{ number_format($product->price, 0, ',', '.') }}
                                        </td>

                                        <td class="text-center">
                                            <span class="fw-semibold {{ $product->stock <= 5 ? 'text-danger' : '' }}">
                                                {{ $product->stock }}
                                            </span>
                                        </td>

                                        <td class="text-end pe-4">
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editProduk{{ $product->id }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger ms-1">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="100"
                                                class="mb-3 opacity-25">
                                            <p class="text-muted">Tidak ada produk ditemukan dalam kategori ini.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-white py-3">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT (Looping) --}}
    @foreach($products as $product)
        <div class="modal fade" id="editProduk{{ $product->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form class="modal-content border-0 shadow" action="{{ route('admin.products.update', $product) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white">Edit Produk: {{ $product->name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-bold">Nama Produk</label>
                                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Kategori</label>
                                <select name="category_id" class="form-select" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea name="description" class="form-control"
                                    rows="3">{{ $product->description }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Harga (Rp)</label>
                                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Stok</label>
                                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Berat (gram)</label>
                                <input type="number" name="weight" class="form-control" value="{{ $product->weight }}" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Update Gambar Baru</label>
                                <input type="file" name="images[]" class="form-control" multiple>
                                <small class="text-muted">Bisa pilih lebih dari satu gambar.</small>
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold">Tampilkan Produk ke Pembeli</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">Update Produk</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- MODAL CREATE --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="modal-content border-0 shadow" action="{{ route('admin.products.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Nama Produk</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                placeholder="Contoh: Lookism Vol. 1" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Pilih Kategori...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3"
                                placeholder="Tuliskan detail komik...">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Harga Diskon (Opsional)</label>
                            <input type="number" name="discount_price"
                                class="form-control @error('discount_price') is-invalid @enderror"
                                value="{{ old('discount_price') }}" min="0">
                            @error('discount_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Stok</label>
                            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Berat (gram)</label>
                            <input type="number" name="weight" class="form-control" value="{{ old('weight', 200) }}"
                                required>
                        </div>
                        <div class="col-md-12 text-center py-3 border rounded bg-light border-dashed">
                            <label class="form-label fw-bold d-block mb-2">Upload Gambar Produk</label>
                            <input type="file" name="images[]" class="form-control" multiple required>
                            <p class="small text-muted mt-2 mb-0 italic">Saran: Gunakan rasio 3:4 untuk cover komik.</p>
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                <label class="form-check-label fw-bold">Aktifkan Produk</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>

@endsection

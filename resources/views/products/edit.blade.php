@extends('layout.index')
@section('content')
    <div class="card shadow-1">
        <div class="modal-body">
            <div class="card-body">
                <h4 class="card-title my-3 fw-bold fs-4 text-uppercase mb-5" id="header-title">edit product details -
                    {{ $product->name }}</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="editProduct" method="POST" action="{{ route('products.update', $product->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="row">
                        <!-- Product Name -->
                        <div class="col-md-6">
                            <div class="form-outline mb-4" data-mdb-input-init>
                                <input required type="text" value="{{ $product->name }}" name="name" id="productName"
                                    class="form-control form-control-lg" />
                                <label for="productName" class="form-label">Product Name</label>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <!-- Product Category -->
                        <div class="col-md-6">
                            <div class="form-outline mb-4" data-mdb-select-init>
                                <select id="productBrand" name="brand"
                                    class="form-select form-select-lg select2-dynamic select2--large">
                                    <option value="">Select Product Brand</option>
                                    @forelse ($brands as $brand)
                                        <option {{ $product->brand_id === $brand->id ? 'selected' : '' }}
                                            value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-outline mb-4" data-mdb-input-init>
                                <input type="date" value="{{ $product->expiry_date }}" name="expiry_date"
                                    class="form-control form-control-lg" id="expiry_date"
                                    min="{{ now()->addMonth()->format('Y-m-d') }}" />
                                <label for="expiry_date" class="form-label">Expiry Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline mb-4" data-mdb-select-init>
                                <select id="productCategory" name="category"
                                    class="form-select form-select-lg select2-dynamic select2--large">
                                    <option value="">Select Product Category</option>
                                    @forelse ($categories as $category)
                                        <option {{ $product->category_id === $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Price and Quantity -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-outline mb-4" data-mdb-input-init>
                                <input required type="number" onfocus="this.select()" value="{{ $product->market_price }}"
                                    step="0.01" name="market_price" id="market_price"
                                    class="form-control form-control-lg" />
                                <label for="market_price" class="form-label">Market Price (GHS)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-outline mb-4" data-mdb-input-init>
                                <input required type="number" onfocus="this.select()" value="{{ $product->price }}"
                                    name="price" step="0.01" id="price" class="form-control form-control-lg" />
                                <label for="price" class="form-label">Selling Price (GHS)</label>
                                <div class="invalid-feedback">value must be greater than market price.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-outline mb-4">
                                <label for="productImage" class="custom-file-label">Click to select product
                                    image</label>
                                <input type="file" name="image" accept=".jpeg,.jpg,.png,.webp" id="productImage"
                                    class="form-control form-control-lg" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <img id="imagePreview" src="{{ asset($product->image) }}" width="100" height="100"
                                class="img-fluid mt-2 d-block" />
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary mx-1">update</button>
                        <button type="reset" class="btn btn-warning mx-1">Reset</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            const market_price = document.getElementById('market_price');
            const price = document.getElementById('price');
            // console.log(market_price.value, price.value);

            price.addEventListener('input', function() {
                // alert('Please enter')
                let mp = parseFloat(market_price.value);
                let p = parseFloat(price.value);

                if (p < mp) {
                    $('.invalid-feedback').show();
                    price.classList.add('is-invalid');
                } else {
                    $('.invalid-feedback').hide();
                    price.classList.remove('is-invalid');
                }
                // else {
                //     price.setCustomValidity('');
                // }
            });
            const $loader = '<span id="btn-icon" class="fas fa-spinner fa-spin me-2"></span>';
            $('form#editProduct').submit(function(event) {
                let submitter = $('form#editProduct :submit');
                submitter.html($loader + 'Saving ...').addClass('disabled');
                let name = $('input[name="name"]');
                let mp = parseFloat(market_price.value);
                let p = parseFloat(price.value);
                if (p < mp) {
                    event.preventDefault();
                    $('.invalid-feedback').show();
                    submitter.html('update').removeClass('disabled');
                }
                if ($(name).hasClass('is-invalid') && $(name).val() !== '{{ $product->name }}') {
                    event.preventDefault();
                    submitter.html('update');
                }
            });
            $('input[name="name"]').on('input', function() {
                var name = $(this);
                $.ajax('{{ route('find.product') }}', {
                    data: {
                        name: name.val().toString().toLowerCase(),
                    },
                    success: function(data) {
                        if (data) {
                            name.addClass('is-invalid');
                            $('.invalid-feedback').first().text('Product already exist').show();
                        } else {
                            name.removeClass('is-invalid');
                            $('.invalid-feedback').first().text('').hide();
                        }
                    },
                    error: function(error) {

                    }
                });
            });
            const file_preview = document.getElementById('imagePreview');
            const img = document.getElementById('productImage');
            img.addEventListener('change', function(event) {
                var file = event.target.files[0];
                event.target.labels[0].textContent = file.name;
                var reader = new FileReader();
                reader.onload = function(event) {
                    file_preview.style.display = 'block';
                    file_preview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection

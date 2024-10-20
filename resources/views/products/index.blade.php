@extends('layout.index')
@section('content')
    @use(Carbon\Carbon)
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary my-3 shadow-0 position-sticky"
        style="top: 60px;z-index: 50;">
        <div class="container-fluid d-flex justify-content-between">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">{{ env('APP_NAME') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Products</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="#">Products</a>
                    </li>
                </ol>
            </nav>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                add product
            </a>
        </div>
    </nav>

    <div class="card shadow-1-soft">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <div class="d-flex align-items-center">
                    <button id="excelButton" class="btn text-white me-1" data-mdb-ripple-init
                        style="background-color: #438162;" title="Export table to excel" type="button">
                        <i class="fas fa-print me-1"></i>
                        Excel
                    </button>
                    <button id="pdfButton" class="btn text-white mx-1" data-mdb-ripple-init
                        style="background-color: #ee4a60;" title="Save table as PDF" type="button">
                        <i class="fas fa-file-pdf me-1"></i>
                        PDF
                    </button>
                    <button id="printButton" class="btn text-white ms-1" data-mdb-ripple-init
                        style="background-color: #44abff;" title="Click to print table" type="button">
                        <i class="fas fa-print me-1"></i>
                        print
                    </button>
                </div>
                <div class="d-flex align-items-center">
                    <input class="form-control me-2 search-table" type="search" placeholder="Search products..."
                        aria-label="Search">
                </div>
            </div>
            <div class="table-responsive">
                <table id="table-products" class="table table-hover table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Expiry Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead> 
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="text-capitalize">
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>
                                    @isset($product->image)
                                        <img class="img-fluid " style="width: 120px;" src="{{ asset($product->image) }}" />
                                    @endisset
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->brand?->name ?? 'N/A' }}</td>
                                <td>{{ $product->category?->name ?? 'N/A' }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ Carbon::parse($product->expiry_date)->longRelativeToNowDiffForHumans() }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('products.edit', $product->id) }}" type="button"
                                            class="btn btn-primary mx-1">
                                            Edit
                                        </a>
                                        <button {{ $product->quantity < 1 ? 'disabled' : '' }} title="Add Product to Cart"
                                            class="btn btn-sm btn-danger mx-1 add-to-cart-button" type="button"
                                            data-qty="{{ $product->quantity }}" data-product="{{ $product->id }}">
                                            <i class="fas fa-cart-plus"></i>
                                            add
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        {{-- @include('products.edit') --}}
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', 'button.btnEditProduct', function(e) {
                var product_id = e.currentTarget.id,
                    update_url = $(this).data('update-url');
                $.ajax({
                    url: product_id,
                    success: function(data) {
                        console.log(data);
                        $('#header-title').text(data.name.toString().toUpperCase());
                        $('form#editProduct input[name="id"]').val(data.id).addClass('active');
                        $('form#editProduct #productName').val(data.name).addClass('active');
                        $('form#editProduct #price').val(data.price).addClass('active');
                        $('form#editProduct #market_price').val(data.market_price).addClass(
                            'active');
                        $('form#editProduct select#productBrand').val(data.brand.id);
                        $('form#editProduct select[name="category"]').val(data.category.id);
                        $('form#editProduct #expiry_date').val(data.expiry_date).addClass(
                            'active');
                        $('form#editProduct img#imagePreview')[0].src = data.image;
                        $('form#editProduct img#imagePreview').show();
                    }
                });
                $('form#editProduct').submit(function(event) {
                    console.log(event, this);

                    event.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'PUT',
                        url: update_url,
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        beforeSend: function() {
                            // Show loading indicator
                            $('#loader').show();
                        },
                        success: function(response) {
                            // Hide loading indicator
                            $('#loader').hide();
                            // Display success message
                            toastr.success(response.message);
                            // Reset form
                            $('#editProduct')[0].reset();
                        },
                        error: function(xhr, status, error) {
                            // Hide loading indicator
                            $('#loader').hide();
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                // Display error messages
                                console.log('key: ', key, 'value:', value);

                                $('#' + key).siblings('.invalid-feedback').text(
                                    value[0]);
                                $('#' + key).addClass('is-invalid');
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection

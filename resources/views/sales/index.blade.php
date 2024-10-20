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
                        <a href="#">Sales</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="#">Sales</a>
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
                    <input class="form-control me-2 search-table" type="search" placeholder="Search table"
                        aria-label="Search">
                </div>
            </div>
            <div class="table-responsive">
                <table id="sales-products" class="table table-hover table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Customer</th>
                            {{-- <th scope="col">Product Name</th> --}}
                            <th scope="col">Item Count</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Payment Mode</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sales as $sale)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>
                                    {{ $sale->customer->name }}
                                </td>
                                {{-- <td>{{ $sale->product->name }}</td> --}}
                                <td>{{ $sale->salesItems->count() }}</td>
                                <td>{{ 'GHS ' . number_format($sale->total, 2) }}</td>
                                <td>{{ $sale->paymentMethod->name }}</td>
                                <td>{{ $sale->sales_status_id == 1 ? 'OK' : 'N/A' }}</td>
                                <td>{{ Carbon::parse($sale->date)->longRelativeToNowDiffForHumans() }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('products.edit', $sale->id) }}" type="button"
                                            class="btn btn-primary mx-1 disabled">
                                            view
                                        </a>
                                        <button onclick="return null;" title="Click to print receipt"
                                            class="btn btn-sm btn-success mx-1" type="button"
                                            data-sale_id="{{ $sale->id }}">
                                            <i class="fas fa-print"></i>
                                            print
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
    </div>
    <script>
        $(document).ready(function() {
            var sales_table = new DataTable('#sales-products', {
                select: false,
                serverSide: false,
                processing: true,
                lengthChange: false,
                searching: false,
                scrollY: $(window).height() / 1.8,
                fixedHeader: {
                    headerOffset: $('nav').outerHeight(true) + 45,
                },

                // dom: 'Brt<"row"<"col-sm-6"i><"col-sm-6"p>>',
                pageLength: 35,
                buttons: [{
                        extend: 'excel',
                        title: 'My Report',
                        filename: 'my-report',
                        text: '<i class="fas fa-print me-1"></i> excel',
                        className: 'btn text-white ms-1',
                        message: 'Printed on ' + new Date().toLocaleString(),
                        attr: {
                            "style": 'background-color: #438162;color: #fff',
                            "data-mdb-ripple-init": '',
                        },
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'My PDF Report',
                        filename: 'my-pdf-report',
                        orientation: 'portrait',
                        pageSize: 'A4',
                        text: '<i class="fas fa-print me-1"></i> pdf',
                        className: 'btn text-white ms-1',
                        message: 'Printed on ' + new Date().toLocaleString(),
                        attr: {
                            "style": 'background-color: #ee4a60;color: #fff',
                            "data-mdb-ripple-init": '',
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print me-1"></i> print',
                        className: 'btn text-white ms-1',
                        title: 'My Printed Report',
                        pageSize: 'A4',
                        orientation: 'landscape',
                        message: 'Printed on ' + new Date().toLocaleString(),
                        attr: {
                            "style": 'background-color: #44abff;color: #fff',
                            "data-mdb-ripple-init": '',
                        }
                    }
                ],
                language: {
                    paginate: {
                        first: 'First',
                        previous: 'Prev',
                        next: 'Next',
                        last: 'Last',
                    }
                }
            });
            $('#pdfButton').on('click', function() {
                sales_table.button(1).trigger();
            });

            $('#excelButton').on('click', function() {
                sales_table.buttons(0).trigger();
            });
            $('#printButton').on('click', function() {
                sales_table.button(2).trigger();
            });
            $('.search-table').on('keyup', function() {
                sales_table.search(this.value).draw();
            });
        });
    </script>
@endsection

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
                        <a href="#">Returns</a>
                    </li>
                </ol>
            </nav>
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
                {{-- <div class="d-flex align-items-center">
                    <input class="form-control me-2 search-table" type="search" placeholder="Search products..."
                        aria-label="Search">
                </div> --}}
            </div>
            <div class="table-responsive">
                <table id="return-products" class="table table-hover table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Return Quantity</th>
                            <th scope="col">Return Total</th>
                            <th scope="col">Returnee</th>
                            <th scope="col">Return Date</th>
                            {{-- <th scope="col"></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($returnSaleItems as $returnSaleItem)
                            <tr class="text-capitalize">
                                <td scope="row">{{ $loop->iteration }}</td>
                                <td>{{ $returnSaleItem->product->name }}</td>
                                <td>{{ $returnSaleItem->unit_price }}</td>
                                <td>{{ $returnSaleItem->quantity }}</td>
                                <td>{{ 'GHS ' . number_format($returnSaleItem->total, 2) }}</td>
                                <td>{{$returnSaleItem->returnSale->customer->name}}</td>
                                <td>{{ Carbon::parse($returnSaleItem->created_at)->format('l, d M Y') }}
                                </td>
                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            const return_table = new DataTable('#return-products', {
                select: false,
                serverSide: false,
                processing: true,
                lengthChange: false,
                // searching: false,
                scrollY: $(window).height() / 1.8,
                fixedHeader: {
                    headerOffset: $('nav').outerHeight(true) + 45,
                },

                // dom: 'Brt<"row"<"col-sm-6"i><"col-sm-6"p>>',
                pageLength: 35,
                buttons: [{
                        extend: 'excel',
                        title: 'Returns',
                        filename: 'products.' + new Date().toDateString(),
                        text: '<i class="fas fa-print me-1"></i> excel',
                        className: 'btn text-white ms-1',
                        message: 'Printed on ' + new Date().toLocaleString(),
                        attr: {
                            "style": 'background-color: #438162;color: #fff',
                            "data-mdb-ripple-init": '',
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Returns',
                        filename: 'products.stock.' + new Date().toDateString(),
                        orientation: 'portrait',
                        pageSize: 'A4',
                        text: '<i class="fas fa-print me-1"></i> pdf',
                        className: 'btn text-white ms-1',
                        message: 'Printed on ' + new Date().toLocaleString(),
                        attr: {
                            "style": 'background-color: #ee4a60;color: #fff',
                            "data-mdb-ripple-init": '',
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print me-1"></i> print',
                        className: 'btn text-white ms-1',
                        title: 'Returns',
                        pageSize: 'A4',
                        orientation: 'landscape',
                        message: 'Printed on ' + new Date().toLocaleString(),
                        attr: {
                            "style": 'background-color: #44abff;color: #fff',
                            "data-mdb-ripple-init": '',
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
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
                return_table.button(1).trigger();
            });

            $('#excelButton').on('click', function() {
                return_table.buttons(0).trigger();
            });
            $('#printButton').on('click', function() {
                return_table.button(2).trigger();
            });
            $('input.search-table').on('keyup', function() {
                return_table.search(this.value).draw();
            });
        });
    </script>
@endsection

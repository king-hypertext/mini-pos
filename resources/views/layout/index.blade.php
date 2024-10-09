<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-mdb-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{ asset('asset/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/select2/css/select2-bootstrap-5-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/mdb/css/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/perfect-scroll/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/custom/stylesheet.css') }}">
    <script src="{{ asset('asset/jquery/external/jquery.js') }}"></script>
    <script src="{{ asset('asset/alert/sweetalert2.all.min.js') }}"></script>
    <title>{{ $page_title ?? 'Q-POS' }}</title>
    <style>
        .preloader {
            z-index: 1099;
            background: rgba(0, 0, 0, 0.55);
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            overflow: hidden !important;
        }

        .preloader span.loader-text {
            display: flex;
            justify-content: center
        }

        .loader {
            aspect-ratio: 1;
            font-size: 50pt;
            text-align: center;
        }

        #floatingCirclesG {
            position: relative;
            width: 176px;
            height: 176px;
            margin: 0;
            transform: scale(0.6);
            -o-transform: scale(0.6);
            -ms-transform: scale(0.6);
            -webkit-transform: scale(0.6);
            -moz-transform: scale(0.6);
        }

        .f_circleG {
            position: absolute;
            background-color: rgb(255, 255, 255);
            height: 32px;
            width: 32px;
            border-radius: 17px;
            -o-border-radius: 17px;
            -ms-border-radius: 17px;
            -webkit-border-radius: 17px;
            -moz-border-radius: 17px;
            animation-name: f_fadeG;
            -o-animation-name: f_fadeG;
            -ms-animation-name: f_fadeG;
            -webkit-animation-name: f_fadeG;
            -moz-animation-name: f_fadeG;
            animation-duration: 1.2s;
            -o-animation-duration: 1.2s;
            -ms-animation-duration: 1.2s;
            -webkit-animation-duration: 1.2s;
            -moz-animation-duration: 1.2s;
            animation-iteration-count: infinite;
            -o-animation-iteration-count: infinite;
            -ms-animation-iteration-count: infinite;
            -webkit-animation-iteration-count: infinite;
            -moz-animation-iteration-count: infinite;
            animation-direction: normal;
            -o-animation-direction: normal;
            -ms-animation-direction: normal;
            -webkit-animation-direction: normal;
            -moz-animation-direction: normal;
        }

        #frotateG_01 {
            left: 0;
            top: 72px;
            animation-delay: 0.45s;
            -o-animation-delay: 0.45s;
            -ms-animation-delay: 0.45s;
            -webkit-animation-delay: 0.45s;
            -moz-animation-delay: 0.45s;
        }

        #frotateG_02 {
            left: 21px;
            top: 21px;
            animation-delay: 0.6s;
            -o-animation-delay: 0.6s;
            -ms-animation-delay: 0.6s;
            -webkit-animation-delay: 0.6s;
            -moz-animation-delay: 0.6s;
        }

        #frotateG_03 {
            left: 72px;
            top: 0;
            animation-delay: 0.75s;
            -o-animation-delay: 0.75s;
            -ms-animation-delay: 0.75s;
            -webkit-animation-delay: 0.75s;
            -moz-animation-delay: 0.75s;
        }

        #frotateG_04 {
            right: 21px;
            top: 21px;
            animation-delay: 0.9s;
            -o-animation-delay: 0.9s;
            -ms-animation-delay: 0.9s;
            -webkit-animation-delay: 0.9s;
            -moz-animation-delay: 0.9s;
        }

        #frotateG_05 {
            right: 0;
            top: 72px;
            animation-delay: 1.05s;
            -o-animation-delay: 1.05s;
            -ms-animation-delay: 1.05s;
            -webkit-animation-delay: 1.05s;
            -moz-animation-delay: 1.05s;
        }

        #frotateG_06 {
            right: 21px;
            bottom: 21px;
            animation-delay: 1.2s;
            -o-animation-delay: 1.2s;
            -ms-animation-delay: 1.2s;
            -webkit-animation-delay: 1.2s;
            -moz-animation-delay: 1.2s;
        }

        #frotateG_07 {
            left: 72px;
            bottom: 0;
            animation-delay: 1.35s;
            -o-animation-delay: 1.35s;
            -ms-animation-delay: 1.35s;
            -webkit-animation-delay: 1.35s;
            -moz-animation-delay: 1.35s;
        }

        #frotateG_08 {
            left: 21px;
            bottom: 21px;
            animation-delay: 1.5s;
            -o-animation-delay: 1.5s;
            -ms-animation-delay: 1.5s;
            -webkit-animation-delay: 1.5s;
            -moz-animation-delay: 1.5s;
        }



        @keyframes f_fadeG {
            0% {
                background-color: rgb(17, 114, 217);
            }

            100% {
                background-color: rgb(255, 255, 255);
            }
        }

        @-o-keyframes f_fadeG {
            0% {
                background-color: rgb(17, 114, 217);
            }

            100% {
                background-color: rgb(255, 255, 255);
            }
        }

        @-ms-keyframes f_fadeG {
            0% {
                background-color: rgb(17, 114, 217);
            }

            100% {
                background-color: rgb(255, 255, 255);
            }
        }

        @-webkit-keyframes f_fadeG {
            0% {
                background-color: rgb(17, 114, 217);
            }

            100% {
                background-color: rgb(255, 255, 255);
            }
        }

        @-moz-keyframes f_fadeG {
            0% {
                background-color: rgb(17, 114, 217);
            }

            100% {
                background-color: rgb(255, 255, 255);
            }
        }
    </style>
</head>

<body class="bg-light">
    <div class="preloader">
        {{-- <div class="loader">
            <i class="fas fa-spinner fa-spin"></i>
        </div> --}}
        <div id="floatingCirclesG">
            <div class="f_circleG" id="frotateG_01"></div>
            <div class="f_circleG" id="frotateG_02"></div>
            <div class="f_circleG" id="frotateG_03"></div>
            <div class="f_circleG" id="frotateG_04"></div>
            <div class="f_circleG" id="frotateG_05"></div>
            <div class="f_circleG" id="frotateG_06"></div>
            <div class="f_circleG" id="frotateG_07"></div>
            <div class="f_circleG" id="frotateG_08"></div>
        </div>
        <span class="fa-fade loader-text">Please wait...</span>
    </div>
    @include('layout.header')
    <main class="container" style="max-width: calc(100% - 420px); margin-top: 70px;">
        @include('layout.nav')
        <div class="container">
            @yield('content')
            <button id="test" class="btn btn-close-white">test cart</button>
        </div>
        <aside class="right-menu bg-white shadow-2-soft">
            <section class="container h-100 perfect-scrollbar mt-4">

                <div class="card shadow-1-soft">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-uppercase">
                                    <th scope="col">product</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody id="cart-row">
                                {{-- <tr class="">
                                    <td scope="row">R1C1</td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="form1" min="1" name="quantity" value="1"
                                                type="number" class="form-control form-control-sm"
                                                style="max-width: 60px; padding-right: 0;" />

                                            <button class="btn btn-link px-2" data-item-id=""
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp();f(this)">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>4</td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>

                </div>
            </section>
            <div class="container perfect-scrollbar">
                <div class="cart-footer">
                    <div class="d-flex justify-content-between mt-1">
                        <span class="ml-2">Subtotal: </span>
                        <span class="ml-2 cart-subtotal">GHS 0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <span class="ml-2">Discount: </span>
                        <span class="ml-2">GHS 0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <span class="ml-2">Payable Amount: </span>
                        <span class="ml-2 cart-payable">GHS 0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <button class="btn btn-danger clear-cart">cancel</button>
                        <button class="btn btn-success confirm-btn">
                            <i class="fas fa-check-circle me-2"></i>
                            confirm</button>
                    </div>
                </div>
            </div>
        </aside>
    </main>
    <script type="text/javascript">
        const showSuccessAlert = Swal.mixin({
            position: 'top',
            toast: true,
            timer: 6500,
            showCloseButton: true,
            showConfirmButton: false,
            timerProgressBar: false,
            onOpen: () => {
                setInterval(() => {
                    Swal.close()
                }, 6500);
            },
            showClass: {
                popup: `
                    animate__animated
                    animate__fadeInDown
                    animate__faster
                    `
            },
        });
    </script>
    @if (session('success'))
        <script type="text/javascript">
            showSuccessAlert.fire({
                icon: 'success',
                text: '{{ session('success') }}',
                padding: '15px',
                width: 'auto'
            });
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            showSuccessAlert.fire({
                icon: 'error',
                text: '{{ session('error') }}',
                padding: '15px',
                width: 'auto'
            });
        </script>
    @endif
    @if (session('warning'))
        <script type="text/javascript">
            showSuccessAlert.fire({
                icon: 'warning',
                text: '{{ session('warning') }}',
                padding: '15px',
                width: 'auto'
            });
        </script>
    @endif
    @if (session('info'))
        <script type="text/javascript">
            showSuccessAlert.fire({
                icon: 'info',
                text: '{{ session('info') }}',
                padding: '15px',
                width: 'auto'
            });
        </script>
    @endif
    <script src="{{ asset('asset/mdb/js/mdb.umd.min.js') }}"></script>
    <script src="{{ asset('asset/datatables.min.js') }}"></script>
    <script src="{{ asset('asset/perfect-scroll/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('asset/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('asset/custom/script.js') }}"></script>
    <script>
        var product_table = new DataTable('#table-products', {
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
            product_table.button(1).trigger();
        });

        $('#excelButton').on('click', function() {
            product_table.buttons(0).trigger();
        });
        $('#printButton').on('click', function() {
            product_table.button(2).trigger();
        });




        // Add event listeners
        $('.search-table').on('keyup', function() {
            product_table.search(this.value).draw();
        });
        const ps = new PerfectScrollbar(document.querySelector('.perfect-scrollbar'));
        $('.select2').select2({
            width: '100%',
        });
        $('.select2-dynamic').select2({
            multiple: false,
            width: '100%',
            tags: true,
            createTag: function(params) {
                console.log(params);

                return {
                    id: params.term,
                    text: params.term,
                    value: params.term,
                    newTag: true // add this property
                };
            }
        });
    </script>
    @yield('script')
</body>

</html>

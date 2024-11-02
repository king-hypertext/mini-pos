@extends('layout.index')
@section('content')
    <div class="card shadow-1">
        <div class="card-body">
            <div class="row">
                <div class="col-auto col-sm-3 gy-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="col-sm-4">
                                    <i class="fas fa-gift fa-2x text-primary mr-3"></i>
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="card-title text-uppercase">products</h5>
                                    <p class="card-text"> Total: {{ $products }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-sm-3 gy-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="col-sm-4">
                                    <i class="fas fa-hand-holding-dollar  fa-2x text-primary mr-3"></i>
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="card-title text-uppercase">total sales</h5>
                                    <p class="card-text">{{ 'GHS ' . number_format($total_sales, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-sm-3 gy-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="col-sm-4">
                                    <i class="fas fa-coins fa-2x text-primary mr-3"></i>
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="card-title text-uppercase">today sales</h5>
                                    <p class="card-text">{{ 'GHS ' . number_format($today_sales, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-sm-3 gy-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="col-sm-4">
                                    <i class="fas fa-user-tag fa-2x text-primary mr-3"></i>
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="card-title text-uppercase">customers</h5>
                                    <p class="card-text">Total: {{ $customers }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-sm-3 gy-3">
                    <div class="card bg-success-subtle">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                {{-- <div class="col-sm-4">
                                    <i class="fas fa-user-tag fa-2x text-primary mr-3"></i>
                                </div> --}}
                                <div class="col-sm-12">
                                    <h5 class="card-title text-uppercase">top-selling product</h5>
                                    <p class="card-text"><strong class="text-uppercase">{{ $topSelllingProduct }}</strong>
                                        (since last 7 days)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@extends('layout.index')
@section('content')
    settings
<div class="row">
    <div class="col-md-6"></div>
</div>
    <div class="card shadow-soft-1">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-end">
                <button class="btn btn-success" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#add-user">add
                    user</button>
            </div>
            <div class="row">
                <h4 class="h4 text-uppercase">user profile</h4>
                <form action="">
                    @csrf
                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label text-capitalize">username</label>
                        <div class="col-sm-10">
                            <input type="username" name="username" value="{{ @old('username') }}"
                                class="form-control @error('image') is-invalid @enderror" id="username">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label text-capitalize">password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" value="{{ @old('password') }}"
                                class="form-control @error('image') is-invalid @enderror" id="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="confirm_password" class="col-sm-2 col-form-label text-capitalize">confirm
                            password</label>
                        <div class="col-sm-10">
                            <input type="confirm_password" name="confirm_password" value="{{ @old('confirm_password') }}"
                                class="form-control @error('image') is-invalid @enderror" id="confirm_password">
                            @error('confirm_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-user" tabindex="-1" data-mdb-backdrop="static" data-mdb-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Modal title
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Body</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

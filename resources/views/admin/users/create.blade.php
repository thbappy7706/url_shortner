@extends('admin.layouts.app')
@section('pageTitle', $pageTitle)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">{{$pageTitle}}</h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                                <a href="{{route('admin.users.index')}}" class="btn btn-primary mr-3"><i class="flaticon-list-2"></i>Users</a>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label">Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Your Name" />
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}"  placeholder="Your Email" />
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleSelect1">Role<span class="text-danger">*</span></label>
                                        <select class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" name="role_id">
                                            <option value="" disabled>--Select--</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" {{$role->id == old('role_id') ? 'selected' : ''}}>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('role_id'))
                                            <div class="invalid-feedback">{{ $errors->first('role_id') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Image Browser</label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" id="UserImageFile" />
                                            <label class="custom-file-label" for="UserImageFile">Choose file</label>
                                            @if ($errors->has('image'))
                                                <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success mr-3"> <i class="flaticon2-paperplane"></i>Save</button>
                            <button type="reset" class="btn btn-danger"><i class="flaticon-close"></i>Cancel</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@endsection


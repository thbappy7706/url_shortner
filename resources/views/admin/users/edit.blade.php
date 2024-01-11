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
                    <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label">Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', $user->name) }}" placeholder="Your Name" />
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email', $user->email) }}"  placeholder="Your Email" />
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleSelect1">Role<span class="text-danger">*</span></label>
                                        <select class="form-control" name="role_id">
                                            <option value="" disabled>--Select--</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" {{$role->id == $user->role_id ? 'selected' : ''}}>{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-2 col-md-6">
                                    <div class="form-group">
                                        <label>Image Browser</label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="UserImageFile" />
                                            <label class="custom-file-label" for="UserImageFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2 col-md-6">
                                    <div class="form-group">
                                        <label for="exampleSelect1">Status<span class="text-danger">*</span></label>
                                        <select class="form-control" name="status">
                                            <option value="{{$user->status}}" {{$user->status == 1 ? 'selected' : ''}}>{{getCurrentStatus(1)}}</option>
                                            <option value="{{$user->status}}" {{$user->status == 0 ? 'selected' : ''}}>{{getCurrentStatus(0)}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
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


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
                                <a href="{{route('admin.contacts.index')}}" class="btn btn-primary mr-3"><i class="flaticon-list-2"></i>Contacts</a>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form action="{{ route('admin.contacts.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label">Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Enter Contact Name" />
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label">Email<span class="text-danger"></span></label>
                                            <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="Enter Contact Email" />
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label">Phone<span class="text-danger">*</span></label>
                                            <input type="text" name="phone_no" class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}" value="{{ old('phone_no') }}" placeholder="Enter Phone No"/>
                                            @if ($errors->has('phone_no'))
                                                <div class="invalid-feedback">{{ $errors->first('phone_no') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="form-control-label">Additional Phone No<span class="text-danger"></span></label>
                                            <input type="text" name="additional_phones" class="form-control {{ $errors->has('additional_phones') ? 'is-invalid' : '' }}" value="{{ old('additional_phones') }}" placeholder="Enter Other Phone No" />
                                            @if ($errors->has('additional_phones'))
                                                <div class="invalid-feedback">{{ $errors->first('additional_phones') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Image<span class="text-danger"></span></label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" id="OrganizationImageFile" />
                                            <label class="custom-file-label" for="OrganizationImageFile">Choose file</label>
                                            @if ($errors->has('image'))
                                                <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-success mr-3"><i class="flaticon2-paperplane"></i>Save</button>
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-danger"><i class="flaticon-close"></i> Cancel</a>

                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@endsection


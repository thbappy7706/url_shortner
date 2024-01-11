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
                                <a href="{{route('admin.contacts.index')}}" class="btn btn-primary mr-3"><i class="flaticon-list-2"></i>Contact</a>
                            </div>
                        </div>
                    </div>

                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body pt-4">

                            <div class="example-preview">

                                <div class="tab-content mt-5" id="myTabContent2">
                                    <div class="tab-pane fade active show" id="responsibility-2" role="tabpanel" aria-labelledby="responsibility-tab-2">
                                        <div class="d-flex flex-row">

                                            <div class="flex-row-fluid ml-lg-12">
                                                <!--begin::Card-->
                                                <div class="card card-custom">
                                                    <div class="card-body">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item"><b>Image:</b><br>
                                                                <img src="{{asset('assets/uploads/contact/image/'.$contact->image)}}" width="60" height="50">
                                                            </li>
                                                            <li class="list-group-item"><b>Name:</b><br>{{$contact->name}}</li>
                                                            <li class="list-group-item"><b>Email:</b><br>{{$contact->email}}</li>
                                                            <li class="list-group-item"><b>Phone No:</b> {{$contact->phone_no}}  </li>
                                                            <li class="list-group-item"><b>Other Phones:</b> {{$contact->additional_phones}}  </li>
                                                            <li class="list-group-item"><b>Bookmarked As:</b> {!!setBookMark($contact->isFavorite) !!} </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


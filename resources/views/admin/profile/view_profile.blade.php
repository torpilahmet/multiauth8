@extends('admin.layouts.admin_master')

@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <div class="card" style="width: 18rem;">
                <img src="{{ !empty($adminData->profile_photo_path) ? Storage::url($adminData->profile_photo_path) : asset('uploads/images/no_image.jpg') }}" class="card-img-top" alt="{{ $adminData->profile_photo_path }}">
                <div class="card-body">
                    <h5 class="card-title">{{$adminData->name}}</h5>
                    <p class="card-text">{{ $adminData->email }}</p>
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
@endsection

@section('style')
@endsection

@section('script')
@endsection

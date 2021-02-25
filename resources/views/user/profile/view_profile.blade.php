@extends('user.layouts.user_master')

@section('content')
    <div class="content_wrapper">
        <!--middle content wrapper-->
        <div class="middle_content_wrapper">
            <div class="card" style="width: 18rem;">
                <img src="{{ !empty($user->profile_photo_path) ? Storage::url($user->profile_photo_path) : asset('uploads/images/no_image.jpg') }}" class="card-img-top" alt="{{ $user->profile_photo_path }}">
                <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                    <p class="card-text">{{ $user->email }}</p>
                    <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
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

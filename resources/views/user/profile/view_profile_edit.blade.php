@extends('user.layouts.user_master')

@section('content')
    <div class="content_wrapper">
        <!--middle content wrapper-->
        <div class="middle_content_wrapper">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">User Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $editData->name) }}">
                        </div>
                        <div class="mb-3">
                            <label for="enail" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="enail" value="{{ old('email', $editData->email) }}">
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Profile Image</label>
                            <input class="form-control" type="file" id="image" name="profile_photo_path">
                        </div>
                        <div class="mb-3">
                            <img id="showImage" src="{{ !empty($editData->profile_photo_path) ? Storage::url($editData->profile_photo_path) : asset('uploads/images/no_image.jpg') }}" class="img img-thumbnail" width="200" alt="{{ $editData->profile_photo_path }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <div class="col-md-6"></div>
            </div>

        </div>
    </div>

@endsection

@section('css')
@endsection

@section('style')
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>
@endsection

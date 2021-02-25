@extends('user.layouts.user_master')

@section('content')
    <div class="content_wrapper">
        <!--middle content wrapper-->
        <div class="middle_content_wrapper">
            <div class="row">
                <div class="col-md-6">
                    <h4>Change Password</h4>
                    <form method="post" action="{{ route('user.password.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="oldpassword" class="form-control" id="current_password" >
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control" id="password" >
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" >
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

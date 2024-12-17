@extends('backend_views.layouts.main')

@section('main-section')

<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="btn-group" id="buttonlist"> 
                        <a class="btn btn-add"> 
                            <i class="fa fa-key"></i> Change Password
                        </a>  
                    </div>
                </div>
                
                <div class="panel-body">
                    <form id="ChangePassword" action="{{ route('password/update') }}" method="POST">
                        @csrf
                        
                        <!-- Hidden ID Field -->
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        
                        <!-- Email Input -->
                        <div class="form-group col-lg-12 required">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                            <span class="text-danger" id="email_error"></span>
                        </div>
                        
                        <!-- Password Input -->
                        <div class="form-group col-lg-12 required">
                            <label for="password" class="control-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="text-danger" id="password_error"></span>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-add btn-sm" id="submitBtn">Submit
                                <span id="submitBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

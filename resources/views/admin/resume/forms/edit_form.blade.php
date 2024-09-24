<?php
?>
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')


<div class="container-fluid">
    <div class="row">
        @if ($user_cv)
            @foreach ($user_cv as $cv)
                <div class="col-md-12">
                    <div class="form-body">
                        <form action="{{ route('update.resume') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $cv->user_id }}">
                            <input type="hidden" name="resume_id" value="{{ $cv->resume_id }}">
                            @if($cv->resume_file)
                            <input type="hidden" name="hidden_file" value="{{ $cv->resume_file != '' ? $cv->resume_file : '' }}">
                            @endif 
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="bold">Username</label>
                                        <input name="name" id="name" class="form-control"
                                            value="{{ $cv->name ? $cv->name : old('name') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email" class="bold">Email</label>
                                        <input name="email" id="email" class="form-control"
                                            value="{{ $cv->email ? $cv->email : old('email') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone" class="bold">Phone No</label>
                                        <input name="phone" id="phone" class="form-control"
                                            value="{{ $cv->phone ? $cv->phone : old('phone') }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="resume_status" class="bold">CV Status</label>
                                        <select name="resume_status" id="resume_status" class="form-control" required>
                                            <option value="">Select CV Status</option>
                                            <option value="1" {{ $cv->resume_status == 1 ? 'selected' : '' }}>Submited
                                            </option>
                                            <option value="2" {{ $cv->resume_status == 2 ? 'selected' : '' }}>Pending
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="resume_file" class="bold"></label>
                                        <input type="file" name="resume_file" id="resume_file" class="form-control" {{ ($cv->resume_file=='')?'required':'' }}>
                                        @error('resume_file')
                                        <div style="color: red;">{{ $message }}</div>
                                        @enderror   
                                    </div>
                                    @if($cv->resume_file!='')
                                    <div class="form-group">
                                        <a href="{{ asset('cvs/' . $cv->resume_file) }}"><span>View Resume</span></a>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="bold"></label>
                                        <textarea name="title" id="title" class="form-control">{{ $cv->title ? $cv->title : old('title') }}</textarea>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-large btn-primary">
                                            Update <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>


@push('scripts')
@endpush

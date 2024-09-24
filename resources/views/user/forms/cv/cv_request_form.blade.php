<div class="modal-body">
    <div class="form-body">
        
        <div class="formrow" id="div_title">
            <textarea class="form-control" id="title" placeholder="{{__('CV Request')}}" name="title" type="text" ></textarea>
            <span class="help-block title-error"></span> </div>
            <span class="text-success success_message"></span>
        @if(isset($profileCv))
        <div class="formrow">
            <i class="fas fa-file"></i>
            {{ImgUploader::print_doc("cvs/$profileCv->cv_file", $profileCv->title, $profileCv->title)}}
        </div>
        @endif

        <div class="formrow" id="div_is_default">
            <span class="help-block is_default-error"></span>
        </div>
    </div>
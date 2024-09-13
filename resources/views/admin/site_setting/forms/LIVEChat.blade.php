{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
    <fieldset>
        <legend>Paste Script:</legend>
        <div class="form-group {!! APFrmErrHelp::hasError($errors, 'live_chat') !!}">
           
			{!! Form::textarea('live_chat', null, array('class'=>'form-control', 'contenteditable'=>'true', 'id'=>'live_chat', 'placeholder'=>'Enter Username Here')) !!}
			
			
            {!! APFrmErrHelp::showErrors($errors, 'live_chat') !!}    
        </div>        
    </fieldset>
</div>

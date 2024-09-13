{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">        
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'nocaptcha_sitekey') !!}">
        {!! Form::label('nocaptcha_sitekey', 'Sitekey', ['class' => 'bold']) !!}                    
        {!! Form::text('nocaptcha_sitekey', null, array('class'=>'form-control', 'id'=>'nocaptcha_sitekey', 'placeholder'=>'Sitekey','readonly' => !empty('nocaptha_sitekey') ? 'readonly' : null)) !!}
        {!! APFrmErrHelp::showErrors($errors, 'nocaptcha_sitekey') !!}                                       
    </div>    
    <div class="form-group {!! APFrmErrHelp::hasError($errors, 'nocaptcha_secret') !!}">
        {!! Form::label('nocaptcha_secret', 'Secret', ['class' => 'bold']) !!}                    
        {!! Form::text('nocaptcha_secret', null, array('class'=>'form-control', 'id'=>'nocaptcha_secret', 'placeholder'=>'Secret','readonly' => !empty('nocaptha_secret') ? 'readonly' : null)) !!}
        {!! APFrmErrHelp::showErrors($errors, 'nocaptcha_secret') !!}                                       
    </div>    
</div>

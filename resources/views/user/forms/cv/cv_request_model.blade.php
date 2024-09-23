<div class="modal-dialog modal-lg modal-dialog-centered">

    <div class="modal-content">

    <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('CV Request')}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

       
            <form class="form" id="add_edit_profile_cv" method="POST" action="{{ route('store.cv.request', [$user->id]) }}" required>
            {{csrf_field()}}
            <input type="hidden" name="id" id="id" value="0"/>
            @include('user.forms.cv.cv_request_form')
            </form>

            
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" onclick="submitCvFormRequest();">{{__('Send CV Request')}} <i class="fas fa-arrow-circle-right" aria-hidden="true"></i></button>

            </div>

        

    </div>

    <!-- /.modal-content --> 

</div>

<!-- /.modal-dialog -->
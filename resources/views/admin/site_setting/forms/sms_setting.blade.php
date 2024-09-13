<style>
    .action-btns i {
        cursor: pointer;
        margin: 0 5px;
    }

    .action-btns i:hover {
        color: #007bff;
    }
</style>
{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="container">
    <div class="row">
        <div class="col-md-6" style="border-right: 1px solid #e7ecf1!important;">
            <div class="form-body">
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sms_provider_name') !!}">
                    {!! Form::label('sms_provider_name', 'SMS Provider Name', ['class' => 'bold']) !!}
                    {!! Form::text('sms_provider_name', null, [
                        'class' => 'form-control',
                        'id' => 'sms_provider_name',
                        'placeholder' => 'SMS Provider Name',
                    ]) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'sms_provider_name') !!}
                </div>
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sms_url_type') !!}">
                    {!! Form::label('sms_url_type', 'SMS URL Type', ['class' => 'bold']) !!}
                    {!! Form::text('sms_url_type', null, [
                        'class' => 'form-control',
                        'id' => 'sms_url_type',
                        'placeholder' => 'SMS URL Type',
                    ]) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'sms_url_type') !!}
                </div>
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sms_user_id') !!}">
                    {!! Form::label('sms_user_id', 'SMS USER ID', ['class' => 'bold']) !!}
                    {!! Form::text('sms_user_id', null, [
                        'class' => 'form-control',
                        'id' => 'sms_user_id',
                        'placeholder' => 'SMS USER ID',
                    ]) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'sms_user_id') !!}
                </div>
                <div class="form-group {!! APFrmErrHelp::hasError($errors, 'sms_password') !!}">
                    {!! Form::label('sms_password', 'SMS Password', ['class' => 'bold']) !!}
                    {!! Form::text('sms_password', null, [
                        'class' => 'form-control',
                        'id' => 'sms_password',
                        'placeholder' => 'SMS Password',
                    ]) !!}
                    {!! APFrmErrHelp::showErrors($errors, 'sms_password') !!}
                </div>
            </div>
            <button class="btn btn-large btn-primary" type="submit">Update <i class="fa fa-arrow-circle-right"
                    aria-hidden="true"></i></button>

        </div>
        <div class="col-md-6">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="bold"> Select Template </label>
                        <div class="form-group">
                            <select name="template_title_id" id="template_title_id" class="form-control"
                                onchange="FetchSmsDetail();">
                                <option value="">Please Select Title</option>
                                @foreach ($sms_setting as $sms)
                                    <option value="{{ $sms->id }}">{{ $sms->title }}</option>
                                @endforeach
                            </select>
                            <span class=" text-danger template_title_id"></span>
                        </div>
                    </div>
                    {{-- <div class="sms_template_info" style="display: none !important;"> --}}

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="template_id" class="bold">Template ID</label>
                            <input type="text" id="template_id" name="template_id" value=""
                                class="form-control">
                            <span class=" text-danger template_id"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="template_name" class="bold">Template Name</label>
                            <input type="text" id="template_name" name="template_name" value=""
                                class="form-control">
                            <span class=" text-danger template_name"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sender_id" class="bold">Sender ID</label>
                            <input type="text" id="sender_id" name="sender_id" value="" class="form-control"
                                onkeyup="ConvertSenderID();">
                            <span class=" text-danger sender_id"></span>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="template_content" class="bold">Template Content</label>
                    <textarea type="text" id="template_content" name="template_content" class="form-control" style="height: 110px;"></textarea>
                    <span class=" text-danger template_content"></span>
                </div>
                <input type="text" hidden value="1" name="template_status">
                {{-- <label for="template_status" class="bold"> Status </label>
                <div class="form-group">
                    <select name="template_status" id="template_status" class="form-control">
                        <option value="1">Active</option>
                        <option value="2">InActive</option>
                    </select>
                </div> --}}
                {{-- </div> --}}
            </div>
            <span class="btn btn-large btn-primary" onclick="update_template();">Update <i
                    class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>

        </div>
    </div>
</div>
@if ($template->isNotEmpty())
    <div class="container mt-5">
        <div class="row">
            <h2>SMS Credential</h2>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Template Title</th>
                        <th>Template ID</th>
                        <th>Template Name</th>
                        <th>Sender ID</th>
                        <th>Template Content</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($template as $tmp)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tmp->title }}</td>
                            <td>{{ $tmp->template_id }}</td>
                            <td>{{ $tmp->template_name }}</td>
                            <td>{{ $tmp->sender_id }}</td>
                            <td>{{ $tmp->template_content }}</td>
                            <td class="action-btns">
                                <i class="fa fa-edit" title="Edit" onclick="EditTemplate('{{ $tmp->id }}')"></i>
                                <button type="button" class="btn btn-primary mt-5" data-toggle="modal" data-target="#exampleModal" onclick="OpenModal('{{ $tmp->id }}');" >
                                    Test Key
                                </button>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-lsabel="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Test Key</h4>
                    <span class="text_success text-success"></span>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form id="singleFieldForm">
                        <div class="form-group">
                            <input type="text" id="send_template_id" hidden >
                            <label for="inputField" class="control-label">Mobile Number:</label>
                            <input type="text" class="form-control" id="mobile_number" oninput="validateMobileNumber(this);" placeholder="Enter Mobile Number" required>
                            <span class="text-danger mobile_number"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitFormTestKey();">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function FetchSmsDetail() {
        var template_id = $('#template_title_id').val();
        if (!template_id) {
            $(".sms_template_info").hide();

        }
        $.ajax({
            url: '{{ route('fetch.sms.setting') }}',
            type: 'post',
            contentType: 'application/json', // Sending data as JSON
            dataType: 'json', // Expect JSON response
            data: JSON.stringify({
                _token: '{{ csrf_token() }}', // CSRF token
                template_id: template_id // Data to send
            }),
            success: function(response) {

                if (response.status) {
                    $(".sms_template_info").show();
                    $('#template_id').val(response.template_id);
                    $('#template_name').val(response.template_name);
                    $('#sender_id').val(response.sender_id);
                    $('#template_content').val(response.template_content);
                    if (response.status == 1) {
                        $('#template_status option[value="1"]').prop('selected', true);
                    } else {
                        $('#template_status option[value="2"]').prop('selected', true);
                    }
                } else {
                    alert('Something went wrong');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error: ', textStatus);
            }
        });
    }

    function EditTemplate(val) {
        var template_id = val;
        if (!template_id) {
            $(".sms_template_info").hide();

        }
        $.ajax({
            url: '{{ route('fetch.sms.setting') }}',
            type: 'post',
            contentType: 'application/json', // Sending data as JSON
            dataType: 'json', // Expect JSON response
            data: JSON.stringify({
                _token: '{{ csrf_token() }}', // CSRF token
                template_id: template_id // Data to send
            }),
            success: function(response) {

                if (response.status) {

                    $(".sms_template_info").show();
                    $('#template_id').val(response.template_id);
                    $('#template_name').val(response.template_name);
                    $('#sender_id').val(response.sender_id);
                    $('#template_content').val(response.template_content);
                    if (response.id) {
                        $('#template_title_id').append('<option value="' + response.id + '">' + response
                            .title + '</option>');
                        $('#template_title_id option[value="' + response.id + '"]').prop('selected', true);
                    }

                } else {
                    alert('Something went wrong');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error: ', textStatus);
            }
        });
    }

    function update_template() {
        var template_title_id = $('#template_title_id').val().trim();
        var template_id = $('#template_id').val().trim();
        var template_name = $('#template_name').val().trim();
        var sender_id = $('#sender_id').val().trim();
        var template_content = $('#template_content').val().trim();

        var isValid = true; // Flag to check overall form validity

        // Validate template title ID
        if (template_title_id === '') {
            $(".template_title_id").text('Please select a template title');
            isValid = false;
        } else {
            $(".template_title_id").text('');
        }

        // Validate template ID
        if (template_id === '') {
            $(".template_id").text('Please enter a template ID');
            isValid = false;
        } else {
            $(".template_id").text('');
        }

        // Validate template name
        if (template_name === '') {
            $(".template_name").text('Please enter a template name');
            isValid = false;
        } else {
            $(".template_name").text('');
        }

        // Validate sender ID
        if (sender_id === '') {
            $(".sender_id").text('Please enter a sender ID');
            isValid = false;
        } else {
            $(".sender_id").text('');
        }

        // Validate template content
        if (template_content === '') {
            $(".template_content").text('Please enter template content');
            isValid = false;
        } else {
            $(".template_content").text('');
        }
        if (isValid) {
            $("form").submit();
        } else {
            console.log('Form has errors');
        }
    }
</script>
<script>
    function ConvertSenderID() {
        $("#sender_id").val($("#sender_id").val().toUpperCase());
    }
</script>
<script>
    function validateMobileNumber(input) {
        // Regular expression to match exactly 10 digits
        var regex = /^\d{0,10}$/;
        
        // Get the current value of the input
        var value = input.value;

        // Check if the value matches the regex
        if (regex.test(value)) {
            // If valid, update the input field with the value
            input.value = value;
        } else {
            // If invalid, remove the last character
            input.value = value.slice(0, -1);
        }
    }
</script>
<script>
    function OpenModal(template_id){
        $("#send_template_id").val(template_id);
    }
</script>
<script>
    function submitFormTestKey(){
        
        var template_id = $('#send_template_id').val();
        var mobile_number = $('#mobile_number').val();
     
        if(mobile_number.length != 10){
            $(".mobile_number").text("Please enter a Valid mobile number");
            return false;
        }
        $.ajax({
            url: '{{ route('sms.test.key') }}',
            type: 'post',
            contentType: 'application/json', // Sending data as JSON
            dataType: 'json', // Expect JSON response
            data: JSON.stringify({
                _token: '{{ csrf_token() }}', // CSRF token
                template_id: template_id, // Data to send
                mobile_number: mobile_number // Data to send
            }),
            success: function(response) {
                $(".text_success").text("Message sent successfully")
             if(response==="200 OK"){   
                setTimeout(function() {
                  window.location.reload(); 
                }, 2000); 
             }
               
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error: ', textStatus);
            }
        });
    }
</script>
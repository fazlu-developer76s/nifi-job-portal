{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')
<div class="form-body">
  <span class="text_success text-success"></span>
    <fieldset>
        <legend>Notification Setting:</legend>
        <div class="col-md-6">
            <h4>Employer Notification</h4>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Check All</th>
                        <th>Title</th>
                        <th>Whatsapp</th>
                        <th>Email</th>
                        <th>SMS</th>
                        <th>System</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employer_noti as $employe)
                        <tr class="sub_emp_noti{{ $loop->iteration }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <input type="checkbox" id="employe_noti{{ $loop->iteration }}"
                                    onclick="checkAllEmpNoti('{{ $loop->iteration }}');"
                                    onchange="saveNotify(this, {{ $employe->id }}, {{ $employe->type }},null);">
                            </td>
                            <td>{{ $employe->title }}</td>
                            <td><input type="checkbox"
                                    onclick="saveNotify(this,{{ $employe->id }},{{ $employe->type }},'whatsapp_notify' );" {{ ($employe->whatsapp_notify==1)?'checked':''; }}>
                            </td>
                            <td><input type="checkbox"
                                    onclick="saveNotify(this,{{ $employe->id   }},{{ $employe->type }},'email_notify' );" {{ ($employe->email_notify==1)?'checked':''; }}>
                            </td>
                            <td><input type="checkbox"
                                    onclick="saveNotify(this,{{ $employe->id }},{{ $employe->type }},'sms_notify' );" {{ ($employe->sms_notify==1)?'checked':''; }}>
                            </td>
                            <td><input type="checkbox"
                                    onclick="saveNotify(this,{{ $employe->id }},{{ $employe->type }},'bell_notify' );" {{ ($employe->bell_notify==1)?'checked':''; }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h4>Candidate Notification</h4>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Check All</th>
                        <th>Title</th>
                        <th>Whatsapp</th>
                        <th>Email</th>
                        <th>SMS</th>
                        <th>System</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidate_noti as $candidate)
                        
                        <tr class="sub_candidate_noti{{ $loop->iteration }}">
                          <td>{{ $loop->iteration }}</td>
                          <td>
                              <input type="checkbox" id="candidate_noti{{ $loop->iteration }}"
                                  onclick="checkAllCandidateNoti('{{ $loop->iteration }}');"
                                  onchange="saveNotify(this, {{ $candidate->id }}, {{ $candidate->type }},null);">
                          </td>
                          <td>{{ $candidate->title }}</td>
                          <td><input type="checkbox"
                                  onclick="saveNotify(this,{{ $candidate->id }},{{ $candidate->type }},'whatsapp_notify' );" {{ ($candidate->whatsapp_notify==1)?'checked':''; }}>
                          </td>
                          <td><input type="checkbox"
                                  onclick="saveNotify(this,{{ $candidate->id   }},{{ $candidate->type }},'email_notify' );" {{ ($candidate->email_notify==1)?'checked':''; }}>
                          </td>
                          <td><input type="checkbox"
                                  onclick="saveNotify(this,{{ $candidate->id }},{{ $candidate->type }},'sms_notify' );" {{ ($candidate->sms_notify==1)?'checked':''; }}>
                          </td>
                          <td><input type="checkbox"
                                  onclick="saveNotify(this,{{ $candidate->id }},{{ $candidate->type }},'bell_notify' );" {{ ($candidate->bell_notify==1)?'checked':''; }}>
                          </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
</div>
</fieldset>
</div>
<script>
    function checkAllEmpNoti(id) {
        if ($("#employe_noti" + id).prop('checked')) {
            $('.sub_emp_noti' + id + ' .checker').find('span').addClass('checked');
        } else {
            $('.sub_emp_noti' + id + ' .checker').find('span').removeClass('checked');
        }
    }
</script>
<script>
    function checkAllCandidateNoti(id) {
        if ($("#candidate_noti" + id).prop('checked')) {
            $('.sub_candidate_noti' + id + ' .checker').find('span').addClass('checked');
        } else {
            $('.sub_candidate_noti' + id + ' .checker').find('span').removeClass('checked');
        }
    }
</script>
<script>
    function saveNotify(checkbox, row_id, type, id) {
        if ($(checkbox).prop('checked')) {
            var update_value = 1;
        } else {
            var update_value = 0;
        }
        var row_id = row_id;
        var type = type;
        var id = id;
        $.ajax({
            url: '{{ route('notification.update') }}',
            type: 'post',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify({
                _token: '{{ csrf_token() }}',
                update_value: update_value,
                row_id: row_id,
                type: type,
                id: id
            }),
            success: function(response) {
              $(".text_success").text("Update Notification successfully")
             if(response==="200 OK"){   
                setTimeout(function() {
              $(".text_success").text(" ")
                  // window.location.reload(); 
                }, 2000); 
             }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error: ', textStatus);
            }
        });
    }
</script>

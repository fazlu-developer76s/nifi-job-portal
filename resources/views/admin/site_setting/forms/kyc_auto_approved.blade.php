{!! APFrmErrHelp::showErrorsNotice($errors) !!}
@include('flash::message')

<div class="form-body">
    <div class="form-group">
        <label class="bold">Kyc Auto Approved:</label>
        <br>
        <span>On:</span>
        <input type="radio" name="status" value="active" onclick="AutoapprovedKyc('1')"
            {{ $siteSetting->kyc_auto_approved == 1 ? 'checked' : '' }}>
        <span>Off:</span>
        <input type="radio" name="status" value="inactive" onclick="AutoapprovedKyc('0')"
            {{ $siteSetting->kyc_auto_approved == 0 ? 'checked' : '' }}>
    </div>

</div>
<script>
    function AutoapprovedKyc(kyc_status) {
        var kyc_status = kyc_status;
        $.ajax({
            url: '{{ route('kyc.autoapproved') }}',
            type: 'post',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify({
                _token: '{{ csrf_token() }}',
                kyc_status: kyc_status,
            }),
            success: function(response) {
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX Error: ', textStatus);
            }
        });
    }
</script>

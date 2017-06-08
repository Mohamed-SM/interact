@if(Session::has('flash_message'))
<script type="text/javascript">
    $.notify({
        icon: 'fa  fa-exclamation-triangle',
        message: "{!! session('flash_message') !!}"
    },{
        type: 'success',
        offset: {
            x: 20,
            y: 70
        }
    });
</script>
@endif
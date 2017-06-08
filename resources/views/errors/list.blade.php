<script type="text/javascript">
@if(count($errors) > 0)          
    @foreach ($errors->all() as $error)
    $.notify({
        icon: 'fa  fa-exclamation-triangle',
        message: "{{ $error }}"
    },{
        type: 'danger',
        offset: {
            x: 20,
            y: 70
        }
    });
    @endforeach
@endif
</script>
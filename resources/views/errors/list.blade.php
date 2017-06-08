<script type="text/javascript">
@if(count($errors))          
    @foreach ($errors->all() as $error)
    $.notify({
        icon: 'fa  fa-exclamation-triangle',
        message: "{{ $error }}"
    },{
        type: 'danger',
        offset: {
            x: 50,
            y: 70
        }
    });
    @endforeach
@endif
</script>
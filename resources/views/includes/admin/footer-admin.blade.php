
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" ></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magicsuggest/2.1.5/magicsuggest-min.js" ></script>



<script src="{{url('assets/AdminPro/js/avfweb-pro.js')}}"></script>
<script src="{{url('assets/AdminPro/js/chart-area-demo.js')}}"></script>
<script src="{{url('assets/AdminPro/js/chart-bar-demo.js')}}"></script>
<script src="j{{url('asset/sAdminPro/js/datatables-simple-demo.js')}}"></script>
<script src="{{url('assets/AdminPro/js/litepicker.js')}}"></script>

<script>
    $(function () {
        // requires the latest Bootstrap 4 or Bootstrap 3 framework
        var inputed = '';
        $('.suggestags').each(function() {
            var values = $(this).val();
            inputed = $(this).magicSuggest();
            inputed.setValue(values);
        });
    })

</script>


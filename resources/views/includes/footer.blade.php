<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.6.0.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" type="text/javascript" ></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" type="text/javascript"></script>

<script src="{{asset('assets/js/avfwebApp.js')}}" type="text/javascript"></script>

@if(session()->has('alertView'))
    <script>
        avfweb.alert('', '{{session()->get('alertView')['msg']}}', '{{session()->get('alertView')['status']}}');
    </script>

    {{session()->forget(['alertView'])}}
@endif



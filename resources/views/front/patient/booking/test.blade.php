@extends('front.patient.layout._dashboard_master')
@section('main_content')

    <input type="text" name="refresh" id="refresh" value="0">
    <script>
        
        $(document).ready(function(){
            loop1();
        });
        function loop1(){
            
            var refresh = $('#refresh').val();

            var int = parseInt(1) + parseInt(refresh);
            $('#refresh').val(int);

            setTimeout(function(){
               loop1();
            },1000);
                        
        }
    </script>

@endsection
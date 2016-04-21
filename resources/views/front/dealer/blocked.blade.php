@extends('front/layout/dealerfrontend_template')
@section('content')

    <section>
        <div class="container">
            @if(Session::get('message'))
                <div class = "alert alert-danger">
                    <a href = "#" class = "close" data-dismiss = "alert">
                    &times;
                    </a>
                    <strong>{{Session::get('message')}}</strong> 
                </div>
            @endif
            <h2 class="head center-block">Sorry<b> <?php echo Session::get('dealer_name');?> </b> You Cant Bid Until You Are Aproved By Admin</h2>
            
        </div>
    </section>

@stop
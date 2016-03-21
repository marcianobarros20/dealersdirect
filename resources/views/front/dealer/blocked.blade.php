@extends('front/layout/dealer_template')
@section('content')
		
    <!-- ================================================== TESTIMONIALS ================================================== -->
    <section class="space-top-and-bottom medium">
        <div class="container">

            <!-- heading -->
            <div class="row">
                <div class="twelve columns" data-appear-animation="bounceIn">
                    <div class="heading">
                        <h1>Sorry<b> <?php echo Session::get('dealer_name');?> </b> You Cant Bid Until You Are Aproved By Admin</h1>
                        <span></span>
                    </div>
                </div>
            </div>
            <!-- .heading -->

            
            

            

        </div>
    </section>

    <!-- ================================================== END TESTIMONIALS ================================================== -->

@stop
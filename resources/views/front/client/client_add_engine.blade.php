@extends('front/layout/client_template')
@section('content')
    <!-- ================================================== BLOG POSTS ================================================== -->
    <section class="space-top-and-bottom">
        <div class="container">

            <!-- blog posts -->
            <div class="row">

                <div class="twelve columns alpha">

                    <!-- vertical blog post -->
                    <div class="twelve columns alpha" data-appear-animation="bounceIn">
                        <?php foreach ($Engine as $key => $value) {
                        ?>
                        <div class="latest-blog-post vertical clearfix">

                           

                            <!-- blog content -->
                            <div class="blog-content">
                                <div class="blog-content-wrap">

                                    <!-- meta -->
                                    <div class="blog-meta">
                                        <ul class="clearfix">
                                            <li>
                                                
                                                    <span class="icon-cogs"></span>{!! $RequestQueue->makes->name; !!}
                                            </li>
                                            <li>
                                               
                                                    <span class="icon-key"></span>{!! $RequestQueue->models->name; !!}
                                            </li>
                                            <li>
                                                
                                                    <span class="icon-clock"></span>{!! $RequestQueue->year; !!}
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- meta -->

                                    <!-- title -->
                                    <div class="blog-title">
                                        <h5><b>{!!  $value->name !!}</b>
                                        </h5>
                                    </div>
                                    <!-- title -->

                                    <!-- content -->
                                    <div class="blog-excerpt-content">
                                        <p><b>Compression Ratio :</b> {!!  $value->compressionRatio !!}</p>
                                        <p><b>Cylinder :</b> {!!  $value->cylinder !!}</p>
                                        <p><b>Size :</b> {!!  $value->size !!}</p>
                                        <p><b>Displacement :</b> {!!  $value->displacement !!}</p>
                                        <p><b>Configuration :</b> {!!  $value->configuration !!}</p>
                                        <p><b>Fuel Type :</b> {!!  $value->fuelType !!}</p>
                                        <p><b>Horsepower :</b> {!!  $value->horsepower !!}</p>
                                        <p><b>Torque :</b> {!!  $value->torque !!}</p>
                                        <p><b>Total Valves :</b> {!!  $value->totalValves !!}</p>
                                        <p><b>Type :</b> {!!  $value->type !!}</p>
                                        <p><b>Code :</b> {!!  $value->code !!}</p>
                                        <p><b>Compressor Type :</b> {!!  $value->compressorType !!}</p>
                                        <?php if(!empty($value->rpm)){foreach (json_decode($value->rpm,true) as $key => $rpm) { ?>
                                        <p><b>RPM ({!! $key !!}):</b> {!!  $rpm !!}</p>
                                        <?php }} ?>
                                        <?php if(!empty($value->valve)){foreach (json_decode($value->valve,true) as $keyv => $valve) { ?>
                                        <p><b>Valve ({!! $keyv !!}):</b> {!!  $valve !!}</p>
                                        <?php }} ?>
                                        
                                    </div>
                                    <!-- .content -->

                                    <!-- read more -->
                                    <div class="blog-read-more">
                                        <br />
                                        <a href=""  data-id="{!!  $RequestQueue->id !!}" data-count="{!!$countnum!!}" data-engineid="{!!  $value->engine_id !!}" class="button light small add_engine"><span class="icon-checkmark2"></span><b>Add This Engine</b></a>
                                    </div>
                                    <!-- .read more -->

                                </div>
                            </div>
                            <!-- .blog content -->
                            
                        </div>
                        <?php }
                        ?>
                    </div>
                    <!-- .vertical blog post-->

                    


                </div>

                


            </div>
        </div>
    </section>

    <!-- ================================================== END BLOG POSTS ================================================== -->

@stop
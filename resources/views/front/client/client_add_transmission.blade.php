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
                        <?php foreach ($Transmission as $key => $value) {
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
                                        <p><b>Name :</b> {!!  $value->name !!}</p>
                                        <p><b>Transmission Type :</b> {!!  $value->transmissionType !!}</p>
                                        <p><b>Number Of Speeds :</b> {!!  $value->numberOfSpeeds !!}</p>
                                        
                                        
                                        
                                    </div>
                                    <!-- .content -->

                                    <!-- read more -->
                                    <div class="blog-read-more">
                                        <br />
                                        <a href=""  data-id="{!!  $RequestQueue->id !!}" data-count="{!!$countnum!!}" data-transmissionid="{!!  $value->transmission_id !!}" class="button light small add_transmission"><span class="icon-checkmark2"></span><b>Add This Transmission</b></a>
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
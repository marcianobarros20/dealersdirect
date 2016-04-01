                {{--*/ $i =0 /*--}}
                {{--*/ $start =0 /*--}}
                {{--*/ $end =0 /*--}}
                @foreach($RS as $key=>$RequestLog)
                <!-- car vertical medium -->
                @if($i==0)
                        {{--*/ $start++ /*--}}
                    <div class="row">
                    @endif
                        <div class="four columns">
                            <div class="car-box vertical medium">

                                <!-- image -->
                                <div class="car-image">
                                    <a href="#">
                                        <img src="{{ url('/')}}/public/edmunds/make/small/<?php echo $RequestLog['imx']; ?>" title="car" alt="car" />
                                        <span class="background">
                                            <span class="icon-plus"></span>
                                        </span>
                                    </a>
                                </div>
                                <!-- .image -->

                                <!-- content -->
                                <div class="car-content">

                                    <!-- title -->
                                    <div class="car-title">
                                        <h3>
                                        <a href="#">
                                        {!! $RequestLog->makes->name !!} 
                                        {!! $RequestLog->requestqueue->models->name !!}
                                        </a>
                                        </h3>
                                    </div>
                                    <!-- .title -->

                                    <!-- tags -->
                                    <div class="car-tags">
                                        <ul class="clearfix">
                                            @if($RequestLog->blocked==1)
                                            <li class="new-error">BLOCKED</li>
                                            @endif
                                            @if($RequestLog->accepted_state!=0)
                                            <li class="new-success">Accepted</li>
                                            @endif
                                            @if($RequestLog->rejected_state!=0)
                                            <li class="new-alert">Rejected</li>
                                            @endif
                                            <li>{!! $RequestLog->requestqueue->year !!}</li>
                                            <li>{!! $RequestLog->requestqueue->models->name !!}</li>
                                            <li>ONETIME :{!! $RequestLog->requestqueue->total_amount !!}</li>
                                            <li>MONTHLY :{!! $RequestLog->requestqueue->monthly_amount !!}</li>
                                            
                                        </ul>
                                    </div>
                                    <!-- .tags -->

                                    <!-- price -->
                                    <div class="car-price">
                                        <a href="<?php echo url('/');?>/dealers/request_detail/<?php echo base64_encode($RequestLog->id);?>" class="clearfix">
                                        <span class="price">Open</span>
                                        <span class="icon-arrow-right2"></span>
                                        </a>
                                    </div>
                                    <!-- .price -->

                                </div>
                                <!-- .content -->

                            </div>
                        </div>
                @if($i==2)
                        {{--*/ $end++ /*--}}
                        </div>
                        {{--*/ $i=0 /*--}}
                        
                    @else
                        {{--*/ $i++ /*--}}
                    @endif
                @endforeach 
                @if($start!=$end)
                </div>
                @endif
                    @if(empty($RS))
                        <div class="share">

                            <ul>
                                <li>Sorry No Request List</li>

                            </ul>

                        </div>
                    @endif
                <!-- .car vertical medium -->
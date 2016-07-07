@extends('front/layout/clientfrontend_template')
@section('content')
<?php  $bcount=count($RequestQueue->bids); ?>
<input type="hidden" id="sortby" value="{{$fill}}">
<input type="hidden" id="pagestart" value="0">
<input type="hidden" id="pageend" value="2">
<input type="hidden" id="requestid" value="{{base64_encode($RequestQueue->id)}}">

<section>
    <div class="container request-client-cont">
        <div class="row detail-text">
            <div class="col-md-4">
                <h4><i class="fa fa-calendar"></i> {{$RequestQueue->created_at}}<h4>
                <h2>{{$RequestQueue->makes->name}}</h2>
            </div>
            
        </div>
     
        
        <div class="post-bid">
            <div class="col-xs-12 col-sm-8 col-md-8">
                
        <!-- ================================================ -->
        <!-- OPTIONS TYPE FUEL GALLERY VIEW BEGIN  -->
        <!-- ================================================ -->
        <?php 
        $OptionsImageloop = count($fuelapiOptionProductImageArray); 
        $NumberofOptionsSelected = count($fuelapiOptionProductImageCountArray);
        //echo $NumberofOptionsSelected;
        ?>
               
        @for($mainloop=0; $mainloop<$NumberofOptionsSelected; $mainloop++)       
            <div class="OptionsGallery{{$mainloop}}">
                <div id = "carousel-demo{{$mainloop}}" class = "carousel slide ctborder ctheight" data-interval="2000">
                 <!-- Carousel indicators -->
                    <ol class = "carousel-indicators">
                     @if($OptionsImageloop!=0)
                       <!--@for($m=0; $m<$OptionsImageloop; $m++)-->
                        @foreach($fuelapiOptionProductImageArray[$mainloop] as $fuelOptionsImagesKey => $fuelOptionsImagesValue)
                           <li data-target = "#carousel-demo{{$mainloop}}" data-slide-to = "{{$fuelOptionsImagesKey}}"  @if($fuelOptionsImagesKey==0)class = "active"@endif ></li>
                         @endforeach
                        <!--@endfor-->
                       
                     @else
                           <li data-target = "#carousel-demo{{$mainloop}}" data-slide-to = "0" class = "active"></li>
                     @endif
                    </ol>

                        <!-- Carousel items -->
                   <div class = "carousel-inner client-carousel-img">
                  
                    @if($OptionsImageloop!=0)
                        <!--@for($g=0; $g<$OptionsImageloop; $g++)-->
                        <!-- Image Loop Begin -->
                        @foreach($fuelapiOptionProductImageArray[$mainloop] as $fuelOptionsImagesKey => $fuelOptionsImagesValue)  
                            <div class = "item @if($fuelOptionsImagesKey==0) active @endif">
                                 <img src = "{{ url('/')}}/public/fuelgallery/small/{{$fuelOptionsImagesValue->fuelImg_small_jpgformatlocal}}" alt = "x">
                            </div>
                            @endforeach
                            <!--@endfor-->
                            @else
                            <div class = "item active">
                                <img src = "{{url('/')}}/public/front_end/images/dealers_direct_pic_logo.png" alt = "x">
                            </div>
                    @endif 
                      
                  </div>

                    <!-- OPTIONS TYPE FUEL GALLERY VIEW BEGIN -->
                   <a class = "carousel-control left" href = "#carousel-demo{{$mainloop}}" data-slide = "prev">&lsaquo;</a>
                   <a class = "carousel-control right" href = "#carousel-demo{{$mainloop}}" data-slide = "next">&rsaquo;</a>
                </div>
            </div>
        
        @endfor
        <!-- ================================================ -->
        <!-- Options Images End -->
        <!-- ================================================ -->

                 <!-- Default Carousel Begin ============ -->
                <div class="DefaultGallery">
                <div id = "myCarousel" class = "carousel slide ctborder ctheight">
                   
                   <!-- Carousel indicators -->
                    <ol class = "carousel-indicators">
                    @if($countimgFuelData!=0)
                        @foreach($FuelMakeModelYearImageDetails as $vx=>$img)
                        <li data-target = "#myCarousel" data-slide-to = "{{$vx}}"  @if($vx==0)class = "active"@endif ></li>
                        @endforeach
                    @else
                        <li data-target = "#myCarousel" data-slide-to = "0" class = "active"></li>
                    @endif
                    </ol>   
                   
                   <!-- Carousel items -->
                   <div class = "carousel-inner client-carousel-img">
                   @if($countimgFuelData!=0)
                        @foreach($FuelMakeModelYearImageDetails as $vx=>$img)
                            <div class = "item @if($vx==0) active @endif">
                                <img src = "{{ url('/')}}/public/fuelgallery/small/{{$img->fuelImg_small_jpgformatlocal}}" alt = "x">
                            </div>
                        @endforeach 
                    @else
                            <div class = "item active">
                                <img src = "{{url('/')}}/public/front_end/images/dealers_direct_pic_logo.png" alt = "x">
                            </div>
                    @endif 
                   </div>
                   
                   <!-- Carousel nav -->
                   <a class = "carousel-control left" href = "#myCarousel" data-slide = "prev">&lsaquo;</a>
                   <a class = "carousel-control right" href = "#myCarousel" data-slide = "next">&rsaquo;</a>
                   
                </div> 
                </div>
                <!-- /.Default carousel End -->



                @if(count($RequestQueue->bids)!=0)
                <div class="col-md-12 d-v">
                    <select id="shortoptions">
                        <option value="" >Sort By</option>
                        <option value="1" @if($fill==1)selected="selected"@endif>Best Pick</option>
                        <option value="2" @if($fill==2)selected="selected"@endif>Best Monthly</option>
                        <option value="3" @if($fill==3)selected="selected"@endif>Best Onetime</option>
                    </select>
                </div>
                @endif
                <div class="brand-sec bidlist">
                    
                </div>
            </div>  <!-- /col-xs-8 -->
            <div class="col-xs-12 col-sm-4 col-md-4">
                @if(empty($CheckForLeadContact))
                <a href="{{url('/')}}/client/add-style/{{base64_encode($RequestQueue->id)}}" class="btn btn-default c-v">Add More Details</a> 
                <a data-action="<?php echo URL::to('/client/update-budget');?>/{{$RequestQueue->id}}" data-whatever="@mdo" data-target="#edit_budget_modal" data-toggle="modal" href="#" class="btn btn-default c-v update-budget">Update Budget</a>
                @endif
                <div id="content">
                    <ul id="tabs" class="nav nav-tabs profile-browse postbid-browse" data-tabs="tabs">
                        <li class="active"><a class="vechilesOptions"href="#requestdetail" data-toggle="tab">Details</a></li>
                        @if(!empty($RequestQueue->trade_ins) && $RequestQueue->trade_ins->make_id!=0)
                            <li><a href="#trad" data-toggle="tab">Trade In</a></li>
                        @endif
                        @if(!empty($RequestQueue->options))
                            @foreach($RequestQueue->options as $optionkey=>$option)
                                <li><a class="vechilesOptions" href="#options{{$optionkey+1}}" data-toggle="tab">Option{{$optionkey+1}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                    <div id="my-tab-content" class="tab-content">
                        <div class="tab-pane active form-head" id="requestdetail">
                            <table class="table client-table"> 
                                <tbody class="post-text"> 
                                    <tr> 
                                        <td>MAKE :</td> 
                                        <td>{{$RequestQueue->makes->name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>MODEL :</td> 
                                        <td>{{$RequestQueue->models->name}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>YEAR :</td> 
                                        <td>{{$RequestQueue->year}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>CONDITION :</td> 
                                        <td>{{$RequestQueue->condition}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>TOTAL AMOUNT :</td> 
                                        <td><?php $DoubleTotal=floatval($RequestQueue->total_amount);echo "$".number_format($DoubleTotal,2);?></td> 
                                    </tr> 
                                    <tr> 
                                        <td>MONTHLY AMOUNT:</td> 
                                        <td><?php $DoubleMonthly=floatval($RequestQueue->monthly_amount);echo "$".number_format($DoubleMonthly,2);?></td> 
                                    </tr> 
                                </tbody> 
                            </table>
                        </div>
                        @if(!empty($RequestQueue->trade_ins) && $RequestQueue->trade_ins->make_id!=0)
                            <div class="tab-pane form-head" id="trad">
                                <table class="table client-table"> 
                                    <tbody class="post-text"> 
                                        <tr> 
                                            <td>Trade-IN MAKE</td> 
                                            <td>{{$RequestQueue->trade_ins->makes->name}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN MODEL</td> 
                                            <td>{{$RequestQueue->trade_ins->models->name}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN YEAR</td> 
                                            <td>{{$RequestQueue->trade_ins->year}}</td> 
                                        </tr> 
                                        <tr> 
                                            <td>Trade-IN CONDITION</td> 
                                            <td>{{$RequestQueue->trade_ins->condition}}</td> 
                                        </tr> 
                                        @if($RequestQueue->trade_ins->owe==1)
                                            <tr> 
                                                <td>Trade-IN OWE Amount:</td> 
                                                <td><?php $DoubleTrade_ins=floatval($RequestQueue->trade_ins->owe_amount);echo "$".number_format($DoubleTrade_ins,2);?></td> 
                                            </tr> 
                                        @endif
                                        
                                    </tbody> 
                                </table>
                            </div>
                        @endif
                        @if(!empty($RequestQueue->options))
                            @foreach($RequestQueue->options as $optionkey=>$option)
                                <div class="tab-pane form-head" id="options{{$optionkey+1}}">
                                    <table class="table client-table"> 
                                        <tbody class="post-text">
                                            @if(!empty($option->styles->price))
                                                @foreach (json_decode($option->styles->price,true) as $key => $price)
                                                    @if($key=="baseMSRP")
                                                        <tr> 
                                                            <td>{{$key}}:</td> 
                                                            <td>{{$price}}</td> 
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <tr> 
                                                <td>Style Name :</td> 
                                                <td>{{$option->styles->name}}</td> 
                                            </tr> 

                                             <tr> 
                                                <td>Trim Name :</td> 
                                                <td>{{$option->styles->trim}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Body :</td> 
                                                <td>{{$option->styles->body}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Compression Ratio :</td> 
                                                <td>{{$option->engines['compressionRatio']}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Cylinder :</td> 
                                                <td>{{$option->engines['cylinder']}}</td> 
                                            </tr> 
                                            <tr> 
                                                <td>Displacement :</td> 
                                                <td>{{$option->engines['displacement']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Configuration :</td> 
                                                <td>{{$option->engines['configuration']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Fuel Type :</td> 
                                                <td>{{$option->engines['fuelType']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Torque :</td> 
                                                <td>{{$option->engines['torque']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Total Valves :</td> 
                                                <td>{{$option->engines['totalValves']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Code :</td> 
                                                <td>{{$option->engines['code']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Compressor Type :</td> 
                                                <td>{{$option->engines['compressorType']}}</td> 
                                            </tr>
                                            <tr> 
                                                <td>Compressor Type :</td> 
                                                <td>{{$option->engines['compressorType']}}</td> 
                                            </tr>
                                            @if(!empty($option->engines['rpm']))
                                                @foreach (json_decode($option->engines['rpm'],true) as $key => $rpm)
                                                <tr> 
                                                    <td>RPM ({{ $key }}) :</td> 
                                                    <td>{{  $rpm }}</td> 
                                                </tr>
                                                @endforeach
                                            @endif
                                            @if(!empty($option->engines['valve']))
                                                @foreach (json_decode($option->engines['valve'],true) as $keyv => $valve)
                                                <tr> 
                                                    <td>Valve ({{ $keyv }}) :</td> 
                                                    <td>{{  $valve }}</td> 
                                                </tr>
                                                @endforeach
                                            @endif
                                            @if(!empty($option->excolor))
                                                <tr> 
                                                    <td>Exterior Color :</td> 
                                                    <td>
                                                        {{$option->excolor['name']}}
                                                        @if($option->excolor['hex']!="")
                                                        <div style="min-width: 10%;background-color:#{{$option->excolor['hex']}};">&nbsp;</div>
                                                        @endif
                                                    </td> 
                                                </tr>
                                            @endif
                                            @if(!empty($option->incolor))
                                                <tr> 
                                                    <td>Interior Color :</td> 
                                                    <td>
                                                        {{$option->incolor['name']}}
                                                        @if($option->incolor['hex']!="")
                                                        <div style="min-width: 10%;background-color:#{{$option->incolor['hex']}};">&nbsp;</div>
                                                        @endif
                                                    </td> 
                                                </tr>
                                            @endif
                                        </tbody> 
                                    </table>
                                </div>
                            @endforeach
                        @endif
                        
                    </div>
                </div>
            </div>  <!-- /col-xs-4 -->
        </div>
    </div>
</section>


<div class="modal fade" id="edit_budget_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Edit Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Budget</h4>
        </div>
        <div class="modal-body modal-body-data">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <script type="text/javascript" src="http://malsup.github.com/jquery.cycle.all.js"></script>
<script type="text/javascript">
    $(".update-budget").click(function(){
    $.ajax({
        url: $(this).attr('data-action'),
        type:'GET',
        success: function(msg){
        $(".modal-body-data").html(msg);    
        }
    });
});


    $(document).ready(function(){
        $('.OptionsGallery0').hide();
        $('.OptionsGallery1').hide();

        $('.vechilesOptions').click(function(){
        //alert($(this).attr('href').replace('#',''));
        // or alert($(this).hash();
        var Options = $(this).attr('href').replace('#','');
        //alert(Options);

        switch(Options)
        {
            case 'options1':
            $('.OptionsGallery0').show();
            $('.OptionsGallery1').hide();
            $('.DefaultGallery').hide();
            break;

            case 'options2':
            $('.OptionsGallery1').show();
            $('.OptionsGallery0').hide();
            $('.DefaultGallery').hide();
            break;

            case 'requestdetail' :
            $('.OptionsGallery0').hide();
            $('.OptionsGallery1').hide();
            $('.DefaultGallery').show();
            break;

            default:
            $('.OptionsGallery0').hide();
            $('.OptionsGallery1').hide();
            $('.DefaultGallery').show();

        }
        
            });
    });



</script>


@stop
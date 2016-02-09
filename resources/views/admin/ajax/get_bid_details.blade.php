<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Bid Details</h4>
    </div>
    <div class="modal-body">
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Details
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                @foreach($BidQueue as $key=>$Bid)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <ul class="list-inline">
                                        <li><h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}">{{$Bid->total_amount}}(TP)/{{$Bid->monthly_amount}}(MP)</a>
                                            </h4>
                                        </li>
                                        <li>{{$Bid->dealers->first_name}} {{$Bid->dealers->last_name}}</li>
                                        <li>{{$Bid->created_at}}</li>
                                         @if($Bid->visable==1 && $Bid->blocked!=1)

                                        <li><button type="button" class="btn btn-success">Visible</button></li>
                                        @endif
                                        @if($Bid->status==2)

                                        <li><button type="button" class="btn btn-warning">Rejected</button></li>
                                        @endif
                                        @if($Bid->status==3)

                                        <li><button type="button" class="btn btn-info">Accepted</button></li>
                                        @endif
                                        @if($Bid->blocked==1)
                                        <li><button type="button" class="btn btn-danger">Blocked</button></li>
                                        @endif
                                        </ul>
                                        
                                       
                                    </div>
                                    <div id="collapse{{$key}}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Total Ammount</div>
                                                <div class="col-xs-9 col-md-9">{{$Bid->total_amount}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Monthly Ammount</div>
                                                <div class="col-xs-9 col-md-9">{{$Bid->monthly_amount}}</div>
                                                </div>
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Details</div>
                                                <div class="col-xs-9 col-md-9">{{$Bid->details}}</div>
                                                </div>
                                                @if(!empty($Bid->bid_image))
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Images</div>
                                                <div class="col-xs-9 col-md-9">
                                                    @foreach($Bid->bid_image as $image)
                                                    <img src="<?php echo url('/');?>/public/uploads/project/thumb/{!! $image->image!!}" title="car" alt="car" />
                                                    @endforeach
                                                </div>
                                                </div>
                                                @endif
                                                @if($Bid->status==2)
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Rejected Reason</div>
                                                <div class="col-xs-9 col-md-9">{{$Bid->details_of_actions}}</div>
                                                </div>
                                                @endif
                                                @if($Bid->status==3)
                                                <div class="row show-grid">
                                                <div class="col-xs-3  col-md-3">Accepted Reason</div>
                                                <div class="col-xs-9 col-md-9">{{$Bid->bid_acceptance_log->details}}</div>
                                                </div>
                                                @endif
                                               

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>


            
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Client Details</h4>
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
                                <div class="row show-grid">
                                <div class="col-xs-3  col-md-3">First Name</div>
                                <div class="col-xs-9 col-md-9">{{$Client->first_name}}</div>
                                </div>
                                <div class="row show-grid">
                                <div class="col-xs-3  col-md-3">Last Name</div>
                                <div class="col-xs-9 col-md-9">{{$Client->last_name}}</div>
                                </div>
                                <div class="row show-grid">
                                <div class="col-xs-3  col-md-3">Phone</div>
                                <div class="col-xs-9 col-md-9">{{$Client->phone}}</div>
                                </div>
                                <div class="row show-grid">
                                <div class="col-xs-3  col-md-3">Email</div>
                                <div class="col-xs-9 col-md-9">{{$Client->email}}</div>
                                </div>
                                <div class="row show-grid">
                                <div class="col-xs-3  col-md-3">UN-ID</div>
                                <div class="col-xs-9 col-md-9">{{$Client->code_number}}</div>
                                </div>
                                <div class="row show-grid">
                                <div class="col-xs-3  col-md-3">Registration Date</div>
                                <div class="col-xs-9 col-md-9">{{$Client->created_at}}</div>
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


            
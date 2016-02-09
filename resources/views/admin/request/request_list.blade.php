@extends('admin/layout/admin_inner_template')
@section('content')
<!-- /navbar -->
<div id="page-wrapper">
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Request List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Request List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                           
                                            <th>Client</th>
                                            <th>Type</th>
                                            <th>Make</th>
                                            <th>Model</th>
                                            <th>Year</th>
                                            <th>Condition</th>
                                            <th>Options</th>
                                            <th>Bids</th>

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($RequestQueue as $key => $Request)
                                        <tr class="gradeA">
                                            
                                            <td>
                                                @if(isset($Request->clients))
                                                    
                                                    <button class="btn btn-success getclientdetails" data-toggle="modal" data-id="{{$Request->clients->id}}" data-target="#myModal" type="button">{{$Request->clients->first_name}} {{$Request->clients->last_name}}</button><br>
                                                    @else
                                                        
                                                        <button class="btn btn-warning getguestclientdetails" data-toggle="modal" data-id="{{$Request->id}}" data-target="#myModal" type="button">{{$Request->fname}} {{$Request->lname}}</button><br>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($Request->clients))
                                                    Registered
                                                        @else 
                                                            UnRegistered
                                                @endif
                                            </td>
                                            <td>{{$Request->makes->name}}</td>
                                            <td>
                                            @if(isset($Request->models))
                                                    {{$Request->models->name}}
                                            @endif
                                            </td>
                                            <td>{{$Request->year}}</td>
                                            <td>{{$Request->condition}}</td>
                                            <td>
                                                @if(isset($Request->options))
                                                    @foreach($Request->options as $options)
                                                        <button class="btn btn-info getoptiondetails" data-toggle="modal" data-id="{{$options->id}}" data-target="#myModal" type="button">{{$options->styles->name}}</button><br>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                            @if(count($Request->bids)!=0)
                                                <button type="button" class="btn btn-danger btn-circle getbiddetails"  data-toggle="modal" data-id="{{$Request->id}}" data-target="#myModal" ><i class="fa fa-bell"></i> </button>
                                            @endif
                                            
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                           <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog reqopt">
                                    
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div> 
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

</div>
<div id="storeview" style="display:none;">
    <div class="modal-content">
    
    <div class="modal-body">
        <img src="<?php echo url('/');?>/public/backend/ajax-loader.gif">
        
    </div>
   
</div>
</div>
@stop
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
                            <div class="dataTable_wrapper">
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
                                                    {{$Request->clients->first_name}} {{$Request->clients->last_name}}

                                                    @else
                                                        {{$Request->fname}} {{$Request->lname}}
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
                                            <td>{{$Request->models->name}}</td>
                                            <td>{{$Request->year}}</td>
                                            <td>{{$Request->condition}}</td>
                                            <td>
                                                @if(isset($Request->options))
                                                    @foreach($Request->options as $options)
                                                        <button class="btn btn-info" type="button">{{$options->styles->name}}</button><br>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{count($Request->bids)}}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

</div>

@stop
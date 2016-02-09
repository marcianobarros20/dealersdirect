@extends('admin/layout/admin_inner_template')

@section('content')

 
  <!-- /navbar -->
 
                  
<div id="page-wrapper">
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dealer List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Dealer List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Dealer Id</th>
                                            <th>Dealer Name</th>
                                            <th>Dealer Email</th>
                                            <th>Dealer Login Date</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Dealers as $key => $Dealer) {
                                        ?>
                                        <tr class="gradeA">
                                            <td>{{$Dealer->code_number}}</td>
                                            <td>{{$Dealer->first_name}} {{$Dealer->last_name}}</td>
                                            <td>{{$Dealer->email}}</td>
                                            <td>{{$Dealer->created_at}}</td>
                                            <th>
                                                @if($Dealer->status==0)
                                                <button class="btn btn-success activatedealer"  data-id="{{base64_encode ($Dealer->id)}}"  type="button"><i class="fa fa-thumbs-o-up"></i> Activate</button><br>
                                                    @else
                                                        
                                                    <button class="btn btn-warning deactivatedealer"  data-id="{{base64_encode ($Dealer->id)}}"  type="button"><i class="fa fa-thumbs-o-down"></i> Deactivate</button><br>
                                                @endif
                                            </th>
                                        </tr>
                                        <?php } ?>
                                        
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
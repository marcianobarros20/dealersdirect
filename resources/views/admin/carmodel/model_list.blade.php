@extends('admin/layout/admin_inner_template')

@section('content')

 
  <!-- /navbar -->
 
                  
<div id="page-wrapper">
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Model List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Model List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Model Id</th>
                                            <th>Model Name</th>
                                            <th>Model Nice-Name</th>
                                            <th>Make Name</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Carmodel as $key => $Carmodels) {
                                        ?>
                                        <tr class="gradeA">
                                            <td>{{$Carmodels->model_id}}</td>
                                            <td>{{$Carmodels->name}}</td>
                                            <td>{{$Carmodels->nice_name}}</td>
                                            <td>{{$Carmodels->makes->name}}</td>
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
@extends('admin/layout/admin_inner_template')

@section('content')

 
  <!-- /navbar -->
 
                  
<div id="page-wrapper">
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Year List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Year List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Year Id</th>
                                            <th>Year</th>
                                            <th>Make Name</th>
                                            <th>Model Name</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Caryears as $key => $Caryear) {
                                        ?>
                                        <tr class="gradeA">
                                            <td>{{$Caryear->year_id}}</td>
                                            <td>{{$Caryear->year}}</td>
                                            <td>{{$Caryear->makes->name}}</td>
                                            <td>{{$Caryear->models->name}}</td>
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
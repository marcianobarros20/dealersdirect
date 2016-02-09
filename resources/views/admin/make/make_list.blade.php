@extends('admin/layout/admin_inner_template')

@section('content')

 
  <!-- /navbar -->
 
                  
<div id="page-wrapper">
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Make List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Make List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Make Id</th>
                                            <th>Make Name</th>
                                            <th>Make Nice-Name</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Makes as $key => $Make) {
                                        ?>
                                        <tr class="gradeA">
                                            <td>{{$Make->makes_id}}</td>
                                            <td>{{$Make->name}}</td>
                                            <td>{{$Make->nice_name}}</td>
                                            <td class="center">
                                                                <?php if($Make->image!=""){?>
                                                                <img src="{{ url('/')}}/public/uploads/carmake/thumb/{{$Make->image}}">
                                                                <?php }else{ ?>
                                                                <img height="40px" src="{{ url('/')}}/public/front/images/car-1.jpg">
                                                                <?php } ?>
                                            </td>
                                            <td class="center"><?php if($Make->image!=""){?><a href="{{ url('/')}}/admin/make/update_image/{{base64_encode($Make->makes_id)}}"><button type="button" class="btn btn-success">Update Image</button></a><?php }else{ ?><a href="{{ url('/')}}/admin/make/add_image/{{base64_encode($Make->makes_id)}}"><button type="button" class="btn btn-success">Add Image</button></a><?php } ?></td>
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
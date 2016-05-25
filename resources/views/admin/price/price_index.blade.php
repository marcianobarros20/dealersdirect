@extends('admin/layout/admin_inner_template')
@section('content') 
  <!-- /navbar -->                  
<div id="page-wrapper">
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Price List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row --> 
    <div class="row">
                <div class="col-lg-12">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                    <strong>{{Session::get('success')}}</strong>
                    </div>
                    @endif
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Price List
                           <!--&nbsp; <span> <i class="fa fa-plus-square" aria-hidden="true" data-toggle="modal" data-target="#PriceModal"></i> Add Price</span>-->
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Price</th>
                                            <th>Set By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(empty($get_price))
                                        <tr class="gradeA">
                                        <td>No Data Found</td>
                                        </tr>
                                        @else
                                        @foreach($get_price as $data)
                                        <tr class="gradeA">
                                            <td>{{$data->price}}</td>
                                            <td>{{$data->added_by}}</td>
                                            <td><a class="edt_lnk" href="#" data-action="<?php echo URL::to('/admin/edit-price');?>/{{$data->id}}" data-whatever="@mdo" data-target="#edit_price_modal" data-toggle="modal"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                             &nbsp;<!-- &nbsp;<a class='del-price' href="<?php echo URL::to('/admin/delete-price');?>/{{$data->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>-->
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        
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


<!--Add Price Modal -->

  <div class="modal fade" id="PriceModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Price</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
          <label> Price</label>
          <input type='text' name='price' class='input-md' required>
          <button class='btn btn-success' type='submit' name='add_price'> Save</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div id='modal-results'> </div>

  <!--Add Price Modal -->

  <div class="modal fade" id="edit_price_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Edit Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Price</h4>
        </div>
        <div class="modal-body modal-body-data">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">
    $(".edt_lnk").click(function(){
    $.ajax({
        url: $(this).attr('data-action'),
        type:'GET',
        success: function(msg){
        $(".modal-body-data").html(msg);    
        }
    });
});

</script>
<script type="text/javascript">
$(".alert").fadeTo(2000, 500).slideUp(500, function(){
$(".alert").alert('close');
});

$(".del-price").click(function(){
    if (!confirm("Do you want to delete")){
      return false;
    }
});

</script>

@stop


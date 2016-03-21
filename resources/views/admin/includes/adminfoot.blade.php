<script src="{{ url('/')}}/public/backend/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('/')}}/public/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ url('/')}}/public/backend/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('/')}}/public/backend/dist/js/sb-admin-2.js"></script>
    
<!-- DataTables JavaScript -->
<script src="{{ url('/')}}/public/backend/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="{{ url('/')}}/public/backend/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        


        $('.getoptiondetails').click(function(){
            $(".reqopt").html('');
            $( "#storeview" ).appendTo( ".reqopt" );
            var requestid=$(this).data("id");
            console.log(requestid);
                $.ajax({
                url: "<?php echo url('/');?>/admin/ajax/getoptiondetails",
                data: {requestid:requestid,_token: '{!! csrf_token() !!}'},
                type :"post",
                success: function( data ) {
                  $(".reqopt").html('');
                  $(".reqopt").html(data);
                
                }
                });
        });
        $('.getclientdetails').click(function(){
            $(".reqopt").html('');
            $( "#storeview" ).appendTo( ".reqopt" );
            var requestid=$(this).data("id");
            console.log(requestid);
                $.ajax({
                url: "<?php echo url('/');?>/admin/ajax/getclientdetails",
                data: {requestid:requestid,_token: '{!! csrf_token() !!}'},
                type :"post",
                success: function( data ) {
                  $(".reqopt").html('');
                  $(".reqopt").html(data);
                
                }
                });
        });
        $('.getguestclientdetails').click(function(){
            $(".reqopt").html('');
            $( "#storeview" ).appendTo( ".reqopt" );
            var requestid=$(this).data("id");
            console.log(requestid);
                $.ajax({
                url: "<?php echo url('/');?>/admin/ajax/getguestclientdetails",
                data: {requestid:requestid,_token: '{!! csrf_token() !!}'},
                type :"post",
                success: function( data ) {
                  $(".reqopt").html('');
                  $(".reqopt").html(data);
                
                }
                });
        });
        $('.getbiddetails').click(function(){
            $(".reqopt").html('');
            $( "#storeview" ).appendTo( ".reqopt" );
            var requestid=$(this).data("id");
            console.log(requestid);
                $.ajax({
                url: "<?php echo url('/');?>/admin/ajax/getbiddetails",
                data: {requestid:requestid,_token: '{!! csrf_token() !!}'},
                type :"post",
                success: function( data ) {
                  $(".reqopt").html('');
                  $(".reqopt").html(data);
                
                }
                });
        });
        $('.activatedealer').click(function(){
            var requestid=$(this).data("id");
            console.log(requestid);
            $.ajax({
                url: "<?php echo url('/');?>/admin/ajax/activatedealer",
                data: {requestid:requestid,_token: '{!! csrf_token() !!}'},
                type :"post",
                success: function( data ) {
                  if(data==1){
                    window.location.reload();
                  }
                  else{
                    alert("Sorry Please Try Later");
                  }
                
                }
                });

        });
        $('.deactivatedealer').click(function(){
            var requestid=$(this).data("id");
            console.log(requestid);
            $.ajax({
                url: "<?php echo url('/');?>/admin/ajax/deactivatedealer",
                data: {requestid:requestid,_token: '{!! csrf_token() !!}'},
                type :"post",
                success: function( data ) {
                  if(data==1){
                    window.location.reload();
                  }
                  else{
                    alert("Sorry Please Try Later");
                  }
                
                }
                });

        });
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

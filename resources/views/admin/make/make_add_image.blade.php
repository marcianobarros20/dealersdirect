@extends('admin/layout/admin_inner_template')

@section('content')

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{$Makes->name}}({{$Makes->makes_id}})</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Image Of {{$Makes->name}}({{$Makes->makes_id}})
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                     {{ Form::open(array('url' => 'admin/make/add_image', 'files' => true)) }}   
                                        <div class="form-group">
                                            <label>File input</label>
                                            {{ Form::hidden('id',$Makes->makes_id) }}
                                            {{Form::file('makeimg')}}
                                            <p class="help-block">Upload Make Image Of {{$Makes->name}} Which Will Be Shown In Frontend.</p>
                                        </div>
                                        
                                        <!-- <button type="submit" class="btn btn-default">Add Image</button> -->
                                        {{ Form::submit('Add Image',array('class' => 'btn btn-default'))}}
                                    {{ Form::close() }}
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
@stop
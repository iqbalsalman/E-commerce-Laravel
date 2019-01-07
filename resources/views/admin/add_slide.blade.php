@extends('admin_layout')
@section('admin_content')
<ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i> 
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Add Slider</a>
        </li>
    </ul>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Slider</h2>
                	
                </div>
            <div class="box-content">
            <form class="form-horizontal" action="{{ url('/save_slide')}}" method="POST" enctype="multipart/form-data">
                @if(Session::get('message'))
                <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!!</strong>
                    {{ Session::get('message') }}</p>
                     {{Session::put('message',null)}}
            </div>
                @endif
                {{ csrf_field() }}
                  <fieldset>
                    <div class="control-group">
                    <label class="control-label">Slider Image</label>
                    <div class="controls">
                    <input type="file" class="input-file uniform_on" name="slider_image" for="fileInput"  >
                    </div>
                    </div>  
                    <div class="control-group">
                    <label class="control-label" for="fileInput">Publications Status</label>
                    <div class="controls">
                            <input type="checkbox" name="publications_status" value="1">
                    </div>
                    </div>         
                    <div class="form-actions">
                      <button type="submit" class="btn btn-primary">Add Slider</button>
                      <button type="reset" class="btn">Cancel</button>
                    </div>
                  </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div><!--/row-->

    
@endsection
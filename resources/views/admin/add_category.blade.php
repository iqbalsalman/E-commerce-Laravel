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
            <a href="#">Add Category</a>
        </li>
    </ul>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Category</h2>
                	
                </div>
            <div class="box-content">
            <form class="form-horizontal" action="{{ url('/save-category')}}" method="POST">
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
                      <label class="control-label">Category Name </label>
                      <div class="controls">
                        <input type="text" class="input-xlarge" name="category_name" for="fileInput">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="fileInput">Category description</label>
                      <div class="controls">
                            <textarea class="cleditor" name="category_description" id="textarea2" rows="3"></textarea>
                      </div>
                    </div>     
                    <div class="control-group">
                            <label class="control-label" for="fileInput">Publications Status</label>
                            <div class="controls">
                                  <input type="checkbox" name="publications_status" value="1">
                            </div>
                          </div>            
                    <div class="form-actions">
                      <button type="submit" class="btn btn-primary">Add Category</button>
                      <button type="reset" class="btn">Cancel</button>
                    </div>
                  </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div><!--/row-->

    
@endsection
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
            <a href="#">Add Product</a>
        </li>
    </ul>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Product</h2>
                	
                </div>
            <div class="box-content">
            <form class="form-horizontal" action="{{ url('/save_product')}}" method="POST" enctype="multipart/form-data">
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
                      <label class="control-label">Product Name </label>
                      <div class="controls">
                        <input type="text" class="input-xlarge" name="product_name" for="fileInput"  required="" >
                      </div>
                    </div>
                     <div class="control-group">
                    <label class="control-label" for="selectError3">Product Category </label>
                        <div class="controls">
                        <select id="selectError3" name="category_id">
                        <option value="">Select Option</option>
                    @php
                        $all_publishhed_category = DB::table('tbl_category')
                                                        ->where('publications_status',1)
                                                        ->get();								   
                    @endphp
                    @foreach ($all_publishhed_category as $item)
                        <option value="{{$item->category_id}}">{{($item->category_name)}}</option>
                    @endforeach	
                        </select>
                        </div>
                          </div> 
                        <div class="control-group">
                        <label class="control-label" for="selectError3">Manafacture Name </label>
                        <div class="controls">
                        <select id="selectError3" name="manufacture_id">
                                <option value="">Select Option</option>
                                @php
                                    $all_publishhed_category = DB::table('tbl_manufacture')
                                                                    ->where('publications_status',1)
                                                                    ->get();								   
                                @endphp
                                @foreach ($all_publishhed_category as $item)
                                    <option value="{{$item->manufacture_id}}">{{($item->manufacture_name)}}</option>
                                @endforeach	
                        </select>
                            </div>
                                </div> 
                    <div class="control-group">
                    <label class="control-label" for="fileInput">Product short description</label>
                    <div class="controls">
                        <textarea class="cleditor" name="product_short_description" id="textarea2" rows="3"></textarea>
                    </div>
                    </div>
                    <div class="control-group">
                    <label class="control-label" for="fileInput">Product Long description</label>
                    <div class="controls">
                        <textarea class="cleditor" name="product_long_description" id="textarea2" rows="3"></textarea>
                    </div>
                    </div>     
                    <div class="control-group">
                    <label class="control-label">Product Price </label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="product_price" for="fileInput"  required="" >
                    </div>
                    </div> 
                    <div class="control-group">
                    <label class="control-label">Image input</label>
                    <div class="controls">
                    <input type="file" class="input-file uniform_on" name="product_image" for="fileInput"  >
                    </div>
                    </div>  
                    <div class="control-group">
                    <label class="control-label">Product Size </label>
                    <div class="controls">
                    <input type="text" class="input-xlarge" name="product_size" for="fileInput"  required="" >
                    </div>
                    </div> 
                    <div class="control-group">
                    <label class="control-label">Product Color </label>
                    <div class="controls">
                    <input type="text" class="input-xlarge" name="product_color" for="fileInput"  required="" >
                    </div>
                    </div> 
                    <div class="control-group">
                    <label class="control-label" for="fileInput">Publications Status</label>
                    <div class="controls">
                            <input type="checkbox" name="publications_status" value="1">
                    </div>
                    </div>         
                    <div class="form-actions">
                      <button type="submit" class="btn btn-primary">Add Product</button>
                      <button type="reset" class="btn">Cancel</button>
                    </div>
                  </fieldset>
                </form>   

            </div>
        </div><!--/span-->

    </div><!--/row-->

    
@endsection
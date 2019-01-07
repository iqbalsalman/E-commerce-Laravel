@extends('admin_layout')
@section('admin_content')

<ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Tables</a></li>
    </ul>
    <div class="row-fluid sortable">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        @if(Session::get('message'))
                        <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Warning!</strong>
                            {{ Session::get('message') }}</p>
                        {{Session::put('message',null)}}
                        @endif
                  <thead>
                      <tr>
                          <th>Category ID</th>
                          <th>Category Name</th>
                          <th>Category Description</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>   
                  <?php $no=0 ?>
                  @foreach ($all_category_info as $item)
                  <tbody>
                    <tr>
                   <?php $no++ ?>
                        <td class="center">{{$no}}</td>
                        <td class="center">{{$item->category_name}}</td>
                        <td class="center">{{$item->category_description}}</td>
                        <td class="center">
                            @if ($item->publications_status==1)
                            <span class="label label-success">Active</span>
                            @else
                            <span class="label label-danger">Unactive</span>
                            @endif
                        </td>
                        <td class="center">
                            @if ($item->publications_status==1)
                        <a class="btn btn-danger" href="{{URL::to('/unactive_category/'.
                        $item->category_id)}}">
                                    <i class="halflings-icon white thumbs-down"></i>  
                                </a>   
                            @else
                            <a class="btn btn-success" href="{{URL::to('/active_category/'.
                            $item->category_id)}}">
                                    <i class="halflings-icon white thumbs-up"></i>  
                                </a> 
                            @endif
                            <a class="btn btn-info" href="{{URL::to('/edit_category/'.
                            $item->category_id)}}">
                                <i class="halflings-icon white edit"></i>  
                            </a>
                            <a class="btn btn-danger"  href="{{URL::to('/delete_category/'.
                            $item->category_id)}}" id="delete">
                                <i class="halflings-icon white trash"></i> 
                            </a>
                        </td>
                    </tr>       
                </tbody>
                    @endforeach
                 </table>  
                    
            </div>
        </div><!--/span-->
    </div><!--/row-->  
@endsection
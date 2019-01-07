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
                          <th>Product ID</th>
                          <th>Product Name</th>
                          <th>Product Image</th>
                          <th>Product Price</th>
                          <th>Category Name</th>
                          <th>Manufacture Name</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>   
                  <?php $no=0 ?>
                  @foreach ($data as $item)
                  <tbody>
                    <tr>
                   <?php $no++ ?>
                        <td class="center">{{$no}}</td>
                        <td class="center">{{$item->product_name}}</td>
                        <td class="center"> <img src="{{URL::to($item->product_image)}}" style=" height: 80px; width: 80px "></td>
                        <td class="center">{{$item->product_price}}</td>
                        <td class="center">{{$item->category_name}}</td>
                        <td class="center">{{$item->manufacture_name}}</td>
                        <td class="center">
                                @if ($item->publications_status==1)
                                <span class="label label-success">Active</span>
                                @else
                                <span class="label label-danger">Unactive</span>
                                @endif
                            </td>
                            <td class="center">
                                @if ($item->publications_status==1)
                            <a class="btn btn-danger" href="{{URL::to('/unactive_product/'.
                            $item->product_id)}}">
                                        <i class="halflings-icon white thumbs-down"></i>  
                                    </a>   
                                @else
                                <a class="btn btn-success" href="{{URL::to('/active_product/'.
                                $item->product_id)}}">
                                        <i class="halflings-icon white thumbs-up"></i>  
                                    </a> 
                                @endif
                                <a class="btn btn-info" href="{{URL::to('/edit_product/'.
                                $item->product_id)}}">
                                    <i class="halflings-icon white edit"></i>  
                                </a>
                                <a class="btn btn-danger"  href="{{URL::to('/delete_product/'.
                                $item->product_id)}}" id="delete">
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
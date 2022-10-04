@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              
              <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">Employees Management</h2>
                  <div class="card shadow">
                    <div class="card-body">
                    @include('message_data')
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form class="form-inline" action="" method="GET" role="search">
                            <div class="form-row">
                              <div class="form-group col-auto mr-2">
                                <label for="search" class="sr-only">Search</label>
                                <input type="text" placeholder="Search" class="form-control" id="search_by_english_text" name="search_by_user_name" value="{{isset($request->search_by_user_name)?$request->search_by_user_name:'' }}">
                              </div>
                            </div>
                            <button type="submit" name="search_submit" value="1" class="btn btn-primary mr-2">Search</button>
                            <a href="{{ url('/admin/employees_management') }}" class="btn btn-secondary">Reset</a>
                          </form>
                        </div>
                        <div class="col ml-auto">
                          <div class="dropdown float-right">
                            
                            <a class="btn btn-primary float-right ml-3" href="{{url('/admin/add_employees')}}">Add Employees +</a>
                          </div>
                        </div>
                      </div>
                      <!-- table -->
                      <table class="table table-bordered">
                        <thead>
                          <tr role="row">
                          <th>#</th>
                        <th>Name</th>
                        <th>Email id</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                       
          <?php 
            if(!empty($data)){
                $i = 1;
                foreach ($data as $key => $value) { ?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$value->employee_name}}</td>
                        <td>{{$value->employee_work_email}}</td>
                        <td>{{$value->status}}</td>
                        <td class="mb-0 text-center">
                          <a class="mr-3" href="{{url('admin/edit_employees/'.$value->id)}}" alert="Edit"><i class="fe fe-edit fe-16"></i></a>
                          <!-- <a onClick="deleteClient({{$value->id}})" href="{{url('admin/delete_employees/'.$value->id)}}" ><i alert="Delete" class="fe fe-trash-2 fe-16"></i></a> -->
                          <a onClick="deleteClient({{$value->id}})" href="javascript:void(0)"><i alert="Delete" class="fe fe-trash-2 fe-16"></i></a>
                        </td>
                    </tr>
            <?php 
                $i++;
                }}
            ?>
                        </tbody>
                      </table>
                        {!! $data->links('pagination::bootstrap-4') !!}
                      
                    </div>
                  </div>
                </div> <!-- simple table -->
              </div> <!-- end section -->
              
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        
@endsection
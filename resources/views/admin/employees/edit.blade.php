@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Employees Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Edit Employees</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                        <form class="needs-validation" novalidate id="add_employees_page" name="add_employees_page" action="{{ route('update_employees', $empdata->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf            
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="name">Employee Name <span class="astrick">*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{!empty(old('name'))?old('name'):$empdata->employee_name}}">
                                 @if ($errors->has('company_name'))
                                    <div class="invalid-feedback">{{ $errors->first('company_name') }}</div>
                                  @endif
                          </div>
                          <div class="col-md-6 mb-3">
                              <label for="email">Email <span class="astrick">*</span></label>
                              <input type="text" class="form-control validateEmail" id="email" placeholder="Email Id" name="email" value="{{!empty(old('email'))?old('email'):$empdata->employee_work_email}}">
                              @if ($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                              @endif
                          </div>

                          <div class="col-md-6 mb-3">
                            <label for="password">Department <span class="astrick">*</span></label>
                            <select name="department" id="department" class="form-control" placeholder="Department" required>
                              <option value="">Select Department</option>
                              @foreach($department as $val)
                                <option {{$empdata->department_id == $val->id ?"selected":""}} value="{{$val->id}}">{{$val->department_name}}</option>
                              @endforeach

                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="phone">Salary</label>
                              <input id="salary" type="text" class="form-control onlynum" name="salary" placeholder="Salary" value="{{!empty(old('salary'))?old('salary'):$empdata->salary->salary}}">
                              <div class="invalid-feedback">{{ $errors->first('salary') }}</div>
                              
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" id="status" name="status" class="custom-control-input" value="active" {{!empty($empdata->status)?"checked":""}}>
                          <label class="custom-control-label" for="status">Active</label>
                          <div class="invalid-feedback">Example invalid feedback text</div>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                        
                        
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->   
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @endsection
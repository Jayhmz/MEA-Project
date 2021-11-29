@extends('layouts.mainlayout')
@section('title', 'Reports Upload')
@section('body')


<section class="content">
  <div class="block-header">
    <div class="row">
      <div class="col-lg-7 col-md-7 col-sm-12">
        <h2>Report</h2>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="zmdi zmdi-home"></i> Home </a></li>
          <li class="breadcrumb-item active"><a href="{{route('view-reports')}}">Reports</a></li>
          <li class="breadcrumb-item active">Add Report</li>
        </ul><button type="button" class="btn btn-primary btn-icon mobile_menu"><i class="zmdi zmdi-sort-amount-desc"></i></button>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="card">
        <div class="header">
          <h2><strong>Create Report</strong></h2>
        </div>
        <div class="body">
          <form action="{{route('admin.report-upload')}}" method="POST" enctype="multipart/form-data">
          @if(Session::get('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
          @endif
          @if(Session::get('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
          @endif
          <!-- report title -->
          @csrf
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="report-title">Report Title</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <span class="small text-danger" style="display: none;"></span>
                <div class="form-group">
                  <input type="text" name="title" id="report-title" placeholder="Enter report title" class="form-control" aria-required="true" aria-invalid="false">
                </div>
              </div>
            </div>
            <!-- report type -->
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="report-type">Report type</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <!-- <span class="small text-danger" style="display: none;"></span> -->
                <div class="form-group">
                  <select class="custom-select" id="report-type" name="type">
                    <option selected>Choose...</option>
                    <option value="First Quarter">First Quarter</option>
                    <option value="Second Quarter">Second Quarter</option>
                    <option value="Third Quarter">Third Quarter</option>
                    <option value="Fourth Quarter">Fourth Quarter</option>
                    <option value="First Half ">First Half </option>
                    <option value="Second Half">Second Half</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- report year -->
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="report-year">Report Year</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <span class="small text-danger" style="display: none;"></span>
                <div class="form-group">
                  <input type="text" name="year" id="report-year" placeholder="Enter year for the report" class="form-control" aria-required="true" aria-selected="current" aria-invalid="false">
                </div>
              </div>
            </div>
            <!-- report image -->
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label"><label for="report-image">Report Image</label></div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group"><input name="image" type="file" id="report-image" class="form-control"></div>
              </div>
            </div>
            <!-- report file pdf -->
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label"><label for="report-file-pdf">Report PDF File</label></div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group"><input name="file" type="file" id="report-file-pdf" class="form-control"></div>
              </div>
            </div>
            
            <!-- form button -->
            <div class="row clearfix text-center">
              <div class="col-sm-8 offset-sm-2"><button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Create Report</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
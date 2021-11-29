@extends('layouts.mainlayout')
@section('title', 'Report')
@section('body')

<section class="content">
  <div class="block-header">
    <div class="row">
      <div class="col-lg-7 col-md-7 col-sm-12">
        <h2>Report</h2>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="zmdi zmdi-home"></i> Home </a></li>
          <li class="breadcrumb-item active"><a href="{{route('view-reports')}}">Reports</a></li>
          <li class="breadcrumb-item active">All-reports</li>
        </ul><button type="button" class="btn btn-primary btn-icon mobile_menu"><i class="zmdi zmdi-sort-amount-desc"></i></button>
      </div>
    </div>
  </div>

  <!-- all reports to be displayed here -->
  <div class="container-fluid">
    <div class="row">
      <div class="card">
        <div class="header ">
          <h2 class="text-secondary"><strong>Reports</strong></h2>
        </div>
      </div>

      @if(Session::get('error'))
      <div class="alert alert-danger">{{Session::get('error')}}</div>
      @endif
      @if(Session::get('success'))
      <div class="alert alert-success">{{Session::get('success')}}</div>
      @endif
      @foreach($reports as $report)
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card">
          <div class="card-body p-3">
            <!-- <div class="imgcontainer"> -->
            <img src="{{asset($report->fileimage)}}" alt="" width="350" height="200">
            <div title="views" class="rounded bg text-center color"><i class="fa fa-eye padding" aria-hidden="true"></i>{{$report->views}}</div>
            <!-- </div> -->
            <div class="card-footer text-center">
              <div class="title">
                <span class="fw-normal">{{$report->title}}</span><br>
                <span class="small">{{$report->created_at}}</span>
              </div>
              <div class="basenav">
                <ul class="nav d-flex justify-content-center">
                  <li class="nav-item">
                    <a class="btn bg-primary nav-link editreportlink" href="{{route('admin.edit-report',$report)}}">Edit</a>
                  </li>
                  <li class="nav-item">
                    <a type="button" class="btn btn-danger" data-toggle="modal" data-target=".{{$report->id}}">
                      Delete
                    </a>
                    <div class="modal fade {{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                            <small>Are you sure to delete this report? </small>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn btn-secondary " data-dismiss="modal">Cancel</button>
                            <a type="button" href="{{route('admin.delete-report', $report)}}" class="btn btn-sm btn-danger">Delete</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    

                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @if($reports->hasPages())
  <div> {{ $reports->links() }}</div>
  @endif
</section>


@endsection
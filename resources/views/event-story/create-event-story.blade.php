@extends('layouts.mainlayout')
@section('title', 'Reports Upload')
@section('body')

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <h2>Event</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Home
                            </a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.event-gallery') }}">Event</a></li>
                        <li class="breadcrumb-item active">Create Event</li>
                    </ul><button type="button" class="btn btn-primary btn-icon mobile_menu"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="header">
                        <h2 class="text-secondary"><strong>Create Event Story</strong></h2>
                    </div>
                    <form action="{{ route('admin.create-event-story') }}" method="POST" enctype="multipart/form-data"
                        class="p-3">

                        @csrf

                        @if (Session::get('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                        @if (Session::get('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @foreach ($errors->all() as $message)
                            <p class="alert alert-danger">{{ $message }}</p>
                        @endforeach
                        <!-- event title -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                <label for="event-title">Event Title</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="eventtitle" id="event-title" placeholder="Enter event title"
                                        class="form-control" aria-required="true" aria-invalid="false">
                                </div>
                            </div>
                        </div>

                        <!-- event description -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                <label for="event-description">Event Description</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8">
                                <div class="form-group">
                                    <textarea type="text" name="eventdescription" id="event-description"
                                        placeholder="Enter event description" class="form-control" aria-required="true"
                                        aria-invalid="false" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- event category -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                <label for="event-category">Event Category</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8">
                                <div class="form-group">
                                    <select class="custom-select form-control" id="event-category" name="eventcategory"
                                        aria-required="true" aria-invalid="false">
                                        <option selected>Choose event category</option>
                                        @foreach ($categories as $eventcategory)

                                            <option class="nav-item" value="{{ $eventcategory->id }}">
                                                {{ $eventcategory->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- event year -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                <label for="eventyear">Event Date</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 d-flex justify-content-between">
                                <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                    <label for="startdate" class="ml-0 mt-1">Start Date</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-8 ml-0 ">
                                    <span class="small text-danger" style="display: none;"></span>
                                    <div class="form-group">
                                        <input type="date" name="startdate" id="startdate" placeholder="Date event starts"
                                            class="form-control" aria-required="true" aria-selected="current"
                                            aria-invalid="false">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                                    <label for="enddate" class="ml-3 mt-1">End Date</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-8 pl-0 ml-0">
                                    <span class="small text-danger" style="display: none;"></span>
                                    <div class="form-group">
                                        <input type="date" name="enddate" id="enddate" placeholder="Date event ends"
                                            class="form-control" aria-required="true" aria-invalid="false">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- event type -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                <label for="event-type">Event Type</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8">
                                <div class="form-group">
                                    <select class="custom-select form-control" id="event-type" name="eventtype"
                                        aria-required="true" aria-invalid="false">
                                        <option selected>Choose event type</option>
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
                        <!-- event links -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                <label for="reg_link">Registration Link</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="ext_reg_link" id="reg_link"
                                        placeholder="Enter Registration Link" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                <label for="flyer_link">Flyer Link</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="flyer_link" id="flyer_link"
                                        placeholder="Enter Registration Link" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <!-- event images -->
                        <div class="row clearfix">
                            <div class="col-lg-3 col-md-3 col-sm-4 form-control-label">
                                <label for="eventimages">Event Image(s)</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8">
                                <div class="input-group mr-3">
                                    <input type="file" name="eventimages[]" multiple class="form-control">
                                </div>
                                <small style="color: green; font-size: 10px">You can select multiple files at once</small>
                            </div>
                        </div>
                        <!-- button -->
                        <div class="row clearfix text-center">
                            <div class="col-sm-8 offset-sm-2"><button type="submit"
                                    class="btn buttons btn-raised btn-primary btn-round waves-effect">Create Event</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection

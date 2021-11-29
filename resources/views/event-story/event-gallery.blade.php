@extends('layouts.mainlayout')
@section('title', 'Reports Upload')

@section('body')
<section class="content">
  <div class="block-header">
    <div class="row">
      <div class="col-lg-7 col-md-7 col-sm-12">
        <h2>Event</h2>
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="zmdi zmdi-home"></i> Home </a></li>
          <li class="breadcrumb-item"><a href="#">Event</a></li>
          <li class="breadcrumb-item active" aria-disabled="true">All events</li>
        </ul><button type="button" class="btn btn-primary btn-icon mobile_menu"><i class="zmdi zmdi-sort-amount-desc"></i></button>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="card">
        <div class="header">
          <h2 class="text-secondary"><strong>Event Story</strong></h2>
        </div>

        @if(Session::get('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::get('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif

        @foreach($Events as $event)

        <div id="accordion">
          <div class="card">
            <div class="" id="showCollapse">
              <h5 class="mb-0">
                <div class="d-flex justify-content-between ">
                  <span class="ml-2 fw-normal">{{$loop->index + 1}}.</span>
                  <span class="medium">{{$event->title}}</span>
                  <div class="btns mr-5">
                    <button class="btn btn-link buttons mr-3 " data-toggle="collapse" data-target="#{{$event->id}}" aria-expanded="true" aria-controls="{{$event->id}}">
                      Manage Photos
                    </button>
                    <a type="button" class="btn btn-link bg-danger" data-toggle="modal" data-target=".{{$event->id}}">
                      <i class="fas fa-trash"></i>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade {{$event->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <div class="modal-body">
                            <small>Are you sure to delete "{{$event->title}}" event</small>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn btn-secondary " data-dismiss="modal">Cancel</button>
                            <a type="button" href="{{route('deleteevent', $event)}}" class="btn btn-sm btn-danger">Delete</a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                </div>
              </h5>
            </div>

            <div id="{{$event->id}}" class="collapse hide" aria-labelledby="showCollapse" data-parent="#accordion">
              <div class="card-body">
                <form action="{{route('admin.update-event-story', $event)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <!-- //change title, category, description, event_type -->
                  <div class="row">
                    <div class="col-md-4">
                      <!-- event title -->
                      <div class="form-group">
                        <label for="{{$event->id}}">Event Title</label>
                        <input type="text" name="eventtitle" class="form-control" id="{{$event->id}}" value="{{$event->title}}">
                        @error('eventtitle') <span class="text-danger">{{$message}}</span> @enderror
                      </div>
                      <!-- event description -->
                      <div class="form-group">
                        <label for="{{$event->id}}">Event Description</label>
                        <textarea type="text" name="eventdescription" rows="10" class="form-control" id="{{$event->id}}">{{$event->description}}
                        @error('eventdescription') <span class="text-danger">{{$message}}</span> @enderror
                        </textarea>
                      </div>
                      <!-- event category -->
                      <div class="form-group">
                        <label for="{{$event->id}}">Event Category</label>
                        <select class="custom-select form-control" id="{{$event->id}}" name="eventcategory" aria-required="true" aria-invalid="false" value="{{$event->eventcategory}}">
                          @error('eventcategory') <span class="text-danger">{{$message}}</span> @enderror
                          @foreach($Categories as $eventcategory)
                          <option class="nav-item" value="{{$eventcategory->id}}">{{$eventcategory->title}}</option>
                          @endforeach
                        </select>
                      </div>
                      <!-- event year -->
                      <div class="form-group">
                        <label for="{{$event->id}}">Start date</label>
                        <input type="date" name="startdate" id="{{$event->id}}" value="{{$event->start_date}}" placeholder="Date event starts" class="form-control" aria-required="true" aria-selected="current" aria-invalid="false">
                      </div>
                      <div class="form-group">
                        <label for="{{$event->id}}">End date</label>
                        <input type="date" name="enddate" id="{{$event->id}}" value="{{$event->end_date}}" placeholder="Date event ends" class="form-control" aria-required="true" aria-selected="current" aria-invalid="false">
                      </div>
                      <!-- event type -->
                      <div class="form-group">
                        <label for="{{$event->id}}">Event Type</label>
                        <select class="custom-select form-control" id="{{$event->id}}" name="eventtype" aria-required="true" aria-invalid="false" value="{{$event->eventcategory}}">
                          @error('eventtype') <span class="text-danger">{{$message}}</span> @enderror
                          <option value="First Quarter">First Quarter</option>
                          <option value="Second Quarter">Second Quarter</option>
                          <option value="Third Quarter">Third Quarter</option>
                          <option value="Fourth Quarter">Fourth Quarter</option>
                          <option value="First Half ">First Half </option>
                          <option value="Second Half">Second Half</option>
                        </select>
                      </div>

                    </div>
                    <!-- event posts -->
                    <div class="col-md-8">
                      <div class="row">
                        @foreach($event->posts as $post)
                        <div class="col-md-4 p-1">
                          <div class="imagecontainer">
                            <img src="{{asset($post->filepath)}}" alt="" class="image">
                            <div class="over pt-2 text-center">
                              <a type="button" class="btn btn-danger" data-toggle="modal" data-target=".{{$post->id}}">
                                Delete
                              </a>

                            </div>
                            <div class="modal fade {{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    <small>Are you sure to delete event image</small>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn btn-secondary " data-dismiss="modal">Cancel</button>
                                    <a type="button" href="{{route('admin.delete-event-story-content', $post->id)}}" class="btn btn-sm btn-danger">Delete</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        <div class="input-group mt-3 text-center">
                          <input type="file" name="eventimages[]" multiple class="form-control">
                          @error('eventimages') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <small class="text-primary mt-1">You can select many images at once</small>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix text-center">
                    <div class="col-sm-8 offset-sm-2"><button type="submit" class="btn btn-raised buttons btn-primary p-2 btn-round waves-effect">Update Event</button></div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @if($Events->hasPages())
  <div> {{ $Events->links() }}</div>
  @endif
</section>
@endsection
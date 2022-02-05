<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\eventCategory;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Nette\Utils\Random;
use Tymon\JWTAuth\Facades\JWTAuth;

use function PHPUnit\Framework\fileExists;

class EventController extends Controller
{
  // view the event story page
  public function viewEvents()
  {
    $categories = eventCategory::all();
    return view('event-story.create-event-story', [
      'categories' => $categories,
    ]);
  }

  //create the event story
  public function CreateEventStory(Request $request)
  {
    $request->validate([
      'eventtitle' => 'required',
      'eventcategory' => 'required',
      'eventdescription' => 'required',
      'eventtype' => 'required',
      'startdate' => 'required',
      'enddate' => 'required',
      'eventimages' => 'required|array',
    ]);

    $event = Event::create([
      'title' => $request->eventtitle,
      'event_category' => $request->eventcategory,
      'description' => $request->eventdescription,
      'event_type' => $request->eventtype,
      'start_date' => $request->startdate,
      'end_date' => $request->enddate,
    ]);


    // //linking the inputs to the model to save
    // $event->title = $request->eventtitle;
    // $event->event_category = $request->eventcategory;
    // $event->description = $request->eventdescription;
    // $event->event_type = $request->eventtype;


    $posts = [];
    //move images to the post
    foreach ($request->file('eventimages') as $image) {
      $filename =  Str::random(12) . "." . $image->extension();
      $path = "images/event/" . $event->id . "/";
      $image->move($path, $filename);

      $x = new Post();

      $x->filepath = asset($path . $filename);
      $posts[] = $x;
    }
    $event->posts()->saveMany($posts);
    if ($event->exists()) {
      return back()->with('success', 'event story uploaded successfully');
    }
  }

  public function eventGallery(Request $request)
  {
    $eventrecords = Event::paginate(10);

    $categories = eventCategory::all();

    return view('event-story.event-gallery', ['Events' => $eventrecords, 'Categories' => $categories]);
  }

  public function RemovePostImage(Post $post)
  {
    // $post->posts()->get()->each(function ($image) {
    //   if (file_exists($image->file)) {
    //     unlink($image->file);
    //   }
    // });
    $post->delete();

    return back()->with('success', 'One of the event posts has been deleted');
  }

  public function UpdateEvents(Event $event, Request $request)
  {

    // $validator = Validator::make($request->all(),[
    //     'eventtitle' => ['required'],
    //     'eventcategory' => ['required'],
    //     'eventdescription' => ['required'],
    //     'eventtype' => ['required'],
    //     'eventdate' => ['required'],
    //     'eventimages' => ['nullable','array'],
    //   ]);

    // if ($validator->fails()) {
    // }

    $request->validate([
      'eventtitle' => 'required',
      'eventcategory' => 'required',
      'eventdescription' => 'required',
      'eventtype' => 'required',
      'startdate' => 'nullable',
      'enddate' => 'nullable',
      'eventimages' => 'nullable|array',
    ]);

    //get the files
    if ($request->hasFile('eventimages')) {
      $posts = [];
      //move images to the post
      foreach ($request->file('eventimages') as $image) {
        $filename =  Str::random(12) . "." . $image->extension();
        $path = "images/event/" . $event->id . "/";
        $image->move($path, $filename);

        $x = new Post();

        $x->filepath = asset($path . $filename);
        $posts[] = $x;
      }
      $event->posts()->saveMany($posts);
    }

    $updated = $event->update([
      'title' => $request->eventtitle,
      'event_type' => $request->eventtype,
      'description' => $request->eventdescription,
      'event_category' => $request->eventcategory,
      'event_type' => $request->eventtype,
      'start_date' => $request->startdate,
      'end_date' => $request->enddate,
    ]);

    if ($updated) {
      return back()->with('success', $event->title . ' event has been updated successful');
    } else {
      return back()->with('error', $event->title . ' event failed to upload');
    }
  }

  public function DeleteEvent(Event $event)
  {
    // foreach ($event->posts() as $post ) {
    //   $post->delete();
    // }
    $event->forceDelete();
    return back()->with('success', $event->title . ' deleted successfully');
  }

  // public function Testing(Request $request)
  // {
  //   $token = JWTAuth::setToken($request->query('key'));
  //   $details = JWTAuth::getPayload($token)->toArray()['details'];
  //   dd($details);
  // }
}

<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportFile;
use Illuminate\Http\Request;

class ReportController extends Controller
{
  // creating report
  public function createReport(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required',
      'type' => 'required',
      'image' => 'required',
      'file' => 'required',
      'year' => 'required',
    ]);

    // moving the report pdf file
    $filename = time() . "." . $request->file('file')->extension();
    $filepath = "Report-File/PDF";
    $request->file('file')->move($filepath, $filename);

    // moving the report pdf-image file
    $fileimagename = time() . "." . $request->file('image')->extension();
    $imagepath = "Report-File/Images/";
    $request->file('image')->move($imagepath, $fileimagename);

    // creating a new Report Model
    $reportmodel = new Report();
    $reportmodel->file = $filepath . $filename;
    $reportmodel->fileimage = $imagepath . $fileimagename;
    $reportmodel->title = $request->title;
    $reportmodel->type = $request->type;
    $reportmodel->year = $request->year;

    if ($reportmodel->save()) {
      return redirect()->back()->with('success', 'report uploaded successfully');
    } else {
      return redirect()->back()->with('error', 'report failed to upload, try again');
    }
  }

  //viewing reports
  public function viewReports(Request $request)
  {
    $reports = Report::paginate(10);
    return view('report-pages.view-report', ['reports' => $reports]);
  }

  // editing report
  public function editReport(Report $report)
  {
    return view('report-pages.edit-report', compact('report'));
  }

  //updating reports
  public function updateReport(Report $report, Request $request)
  {
    $request->validate([
      'title' => 'required',
      'type' => 'required',
      'year' => 'required',
      'imagefile' => 'nullable|file|image',
      'file' => 'nullable|file|mimes:pdf',
    ]);

    //get the pdf file to upload
    if ($request->hasFile('file')) {

      $filename = time() . "." . $request->file('file')->extension();
      $filepath = "Report-File/PDF/";

      //remove old file(pdf) from the db
      if ($report->file && file_exists(public_path($report->file))) {
        unlink(public_path($report->file));
      }
      //move file
      $request->file('file')->move($filepath, $filename);
      $report->file = $filepath . $filename;
      $report->save();
    }

    //get the imagefile to upload
    if ($request->hasFile('imagefile')) {

      $imagefilename = time() . "." . $request->file('imagefile')->extension();
      $filepath = "Report-File/images/";

      //remove old imagefile
      if ($report->fileimage && file_exists(public_path($report->fileimage))) {
        unlink(public_path($report->fileimage));
      }

      $request->file('imagefile')->move($filepath, $imagefilename);
      $report->fileimage = $filepath . $imagefilename;
      $report->save();
    }

    $updated = $report->update([
      'title' => $request->title,
      'type' => $request->type,
      'year' => $request->year
    ]);

    if ($updated) {
      return back()->with('success', $report->title . ' file has been updated successfully');
    } else {
      return back()->with('error', $report->title . ' file failed to update');
    }
  }

  //deleting report
  public function deleteReport(Report $report)
  {
    $deleted = $report->title;
    if ($report->delete()) {
      return back()->with('success', $deleted . ' file has been removed');
    }
  }
}

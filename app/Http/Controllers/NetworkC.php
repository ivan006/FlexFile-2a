<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Report;
use App\Data;
use App\Entity;

class NetworkC extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param \Illuminate\Http\Request $request
  *
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $routeParameters = func_get_args();
    array_shift($routeParameters);

    if (!empty($routeParameters)) {
      Report::Store($routeParameters, $request);
      $allURLs = Report::ShowActions($routeParameters);

      return redirect($allURLs['sub_report_edit']);
    } else {
      Group::Add($request);
      $allURLs = Report::ShowActions($routeParameters);

      return redirect($allURLs['sub_report_edit']);
    }
  }

  /**
  * Display the specified resource.
  *
  * @param int $id
  *
  * @return \Illuminate\Http\Response
  */
  public function show()
  {
    $routeParameters = func_get_args();
    if (empty($routeParameters)) {
      $allURLs = Report::ShowActions($routeParameters);
      $ReportList = Group::ShowAll();

      return view('network-read', compact('ReportList', 'allURLs'));
    } else {
      $allURLs = Report::ShowActions($routeParameters);

      $DataShowRelSig = 'Rich.txt';
      $DataShowID = Data::ShowID($routeParameters, $DataShowRelSig);
      if (!empty($DataShowID)) {
        $DataValues = Data::Show($DataShowID);
      } else {
        $DataValues = null;
      }

      $Attr = Entity::ShowAttributeTypes();
      $RichDataShow = $DataValues[$Attr[2]];
      return view('group-read', compact('allURLs', 'RichDataShow'));
    }
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param int $id
  *
  * @return \Illuminate\Http\Response
  */
  public function edit()
  {
    $routeParameters = func_get_args();
    $arguments = func_get_args();
    if (!empty($arguments)) {
      array_shift($arguments);
      array_shift($arguments);
      $Attr = Entity::ShowAttributeTypes();
      $DataShowAll[$Attr[2]] = Data::ShowMultiForEdit($routeParameters);

      if (!empty($DataShowAll)) {
        $DataShowMultiStyledForEdit = Data::ShowMultiStyledForEdit($DataShowAll);
      } else {
        $DataShowMultiStyledForEdit = null ;
      }

      $SmartDataItemM_ShowActions = Data::ShowActions();

      $allURLs = Report::ShowActions($routeParameters);

      $DataShowRelSig = 'Rich.txt';
      $DataShowID = Data::ShowID($routeParameters, $DataShowRelSig);
      if (!empty($DataShowID)) {
        $DataValues = Data::Show($DataShowID);
      } else {
        $DataValues = null;
      }
      $RichDataShow = $DataValues[$Attr[2]];

      $ReportShowImSubReports = Report::ShowImmediateSubReport($routeParameters);

      $ReportShowSubReport = Report::ShowMultiForEdit($routeParameters);

      if (!empty($ReportShowSubReport)) {
        $ReportShowMultiStyledForEdit = Report::ShowMultiStyledForEdit($ReportShowSubReport);
      } else {
        $ReportShowMultiStyledForEdit =null;
      }

      return view('group-edit', compact('DataShowAll', 'allURLs', 'RichDataShow', 'Attr', 'ReportShowImSubReports', 'ReportShowMultiStyledForEdit', 'DataShowMultiStyledForEdit'));
    } else {
      $allURLs = Report::ShowActions(func_get_args());
      $ReportList = Group::ShowAll();
      $SmartDataItemM_ShowActions = Data::ShowActions();

      return view('network-edit', compact('ReportList', 'allURLs', 'SmartDataItemM_ShowActions'));
    }
  }

  /**
  * Update the specified resource in storage.
  *
  * @param \Illuminate\Http\Request $request
  * @param int                      $id
  *
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
  }

  /*
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
}

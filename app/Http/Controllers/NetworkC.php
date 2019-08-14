<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupM;
use App\PostM;
use App\MetadataM;
use App\RichDataM;
use App\SmartDataItemM;

use App\Group;
use App\Post;
use App\Data;
use App\Metadata;
use App\RichData;
use App\SmartDataItem;






class NetworkC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // $arguments = func_get_args();
      // array_shift($arguments);
      // if (!empty($arguments)) {
      //   PostM::Store($arguments, $request);
      //   $allURLs = PostM::ShowActions($arguments);
      //   return redirect($allURLs['sub_post_edit']);
      // } else {
      //   GroupM::Create($request);
      //   $allURLs = PostM::ShowActions($arguments);
      //   return redirect($allURLs['sub_post_edit']);
      // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){

      $arguments = func_get_args();
      if (empty($arguments)) {
        // dd(func_get_args());
        $allURLs = Post::ShowActions(func_get_args());
        $PostList = Group::ShowAll();
        return view('network-read', compact('PostList', 'allURLs'));
      } else {

        array_shift($arguments);
        array_shift($arguments);
        $allURLs = Post::ShowActions(func_get_args());



        $DataShowSig = Data::ShowSignature(func_get_args(),"Details/Rich.txt");

        $DataValues = Data::Show($DataShowSig);
        $RichDataShow = $DataValues['SmartDataContent'];
        // dd($RichDataShow);
        // $ShowBaseIDPlusBaseLocation = Post::ShowBaseIDPlusBaseLocation(func_get_args());
        // $headerDataShow = Data::$ShowBaseIDPlusBaseLocation  ."/header.txt";
        $headerDataShow = 12;
        return view('group-read', compact('allURLs', 'headerDataShow', 'RichDataShow'));
      }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(){
      // $arguments = func_get_args();
      // if (!empty($arguments)) {
      //   array_shift($arguments);
      //   array_shift($arguments);
      //   $ShowID = PostM::ShowID(func_get_args());
      //   $SmartDataArrayShowBaseLocation = SmartDataItemM::ShowBaseLocation();
      //   if (isset(SmartDataItemM::ShowAll($ShowID)[$SmartDataArrayShowBaseLocation])) {
      //     $ShowAllDeepSmartData = SmartDataItemM::ShowAll($ShowID);
      //   } else {
      //     $ShowAllDeepSmartData = null;
      //   }
      //   $ShowAllShallowSmartData = PostM::ShowAllShallowSmartData(func_get_args());
      //   $SmartDataItemM_ShowActions = SmartDataItemM::ShowActions();
      //   $SmartDataItemM_ShowAttributeTypes = SmartDataItemM::ShowAttributeTypes();
      //   $allURLs = PostM::ShowActions(func_get_args());
      //   $RichDataShow = RichDataM::Show(func_get_args());
      //   $SmartDataArrayShowBaseLocation = SmartDataItemM::ShowBaseLocation();
      //   return view('group-edit', compact(
      //     'ShowAllDeepSmartData',
      //     'allURLs',
      //     'RichDataShow',
      //     'ShowAllShallowSmartData',
      //     'SmartDataItemM_ShowActions',
      //     'SmartDataItemM_ShowAttributeTypes',
      //     'SmartDataArrayShowBaseLocation'
      //   ));
      // } else {
      //   $allURLs = PostM::ShowActions(func_get_args());
      //   $PostList = GroupM::ShowAll();
      //   $SmartDataItemM_ShowActions = SmartDataItemM::ShowActions();
      //   return view('network-edit', compact('PostList', 'allURLs', 'SmartDataItemM_ShowActions'));
      // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

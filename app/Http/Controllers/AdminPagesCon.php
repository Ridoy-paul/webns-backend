<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessage;
use App\Models\Essentials;
use App\Utilities\OthersUtil;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Division;
use App\Models\District;
use App\Models\Thana;
use App\Models\SubArea;
use App\Utilities\SMSUtility;

class AdminPagesCon extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['data'] = Essentials::where('type', 'page')->get();
        return view('backend.dynamic_page.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
        ]);

        $checkSlug = Essentials::where('slug', $request->slug)->first(['id']);
        if ($checkSlug) {
            return redirect()->back()->with('error', 'Slug already exists. Please choose a unique slug.');
        }

        $model = new Essentials();
        $model->title = $request->title;
        $model->type = 'page';
        $model->page_description = $request->page_description;
        $model->slug = $request->slug;
        $model->thumbnail = $request->thumbnail;
        $model->meta_info = OthersUtil::meta_info($request);
        $model->save();

        return redirect()->back()->with('success', 'Dynamic Page has been added.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['data'] = Essentials::find($id);
        return view('backend.dynamic_page.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = Essentials::findOrFail($id);

        $model->title = $request->title;
        $model->page_description = $request->page_description;
        $model->thumbnail = $request->thumbnail;
        $model->meta_info = OthersUtil::meta_info($request);
        $model->save();

        return Redirect()->route('pages.index')->with('success', 'Dynamic Page has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function DbDivision() {
        // Retrieve the divisions with the specified columns
        //$data = Division::select(['id', 'name', 'bn_name'])->get();
        //$data = District::select(['id', 'name', 'bn_name'])->get();
        $data = Thana::select(['id', 'name', 'bn_name'])->get();

        // Return the data as a JSON response
        return $data;
    }

    public function testSms() {
        //$send_sms = (new SMSUtility())->sms_send('Hello Ridoy', '01766622828');
        //return $send_sms;

        broadcast(new PrivateMessage(2, 'This is a private notification.'));
    }

    

}

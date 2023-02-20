<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $listings = Listing::latest()->filter(request(['tag']))->get(); //filtering using tag only
        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(4); //filtering using tags and search form
        return view('listings.index', ['listings' => $listings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $photoName = $file->getClientOriginalName();
            $updatedphotoName = time() . '_' . $photoName;
            $file->move('photos', $updatedphotoName);
            $formFields['logo'] = $updatedphotoName;
        }

        $formFields['user_id'] = auth()->user()->id;

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listing = Listing::findOrFail($id);
        return view('listings.show')->with('listing', $listing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        if (auth()->user()->id == $listing->user->id){
            return view('listings.edit')->with('listing', $listing);
        }else{
           return abort(401); //unauthorized
        }
        
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
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $photoName = $file->getClientOriginalName();
            $updatedphotoName = time() . '_' . $photoName;
            $file->move('photos', $updatedphotoName);
            $formFields['logo'] = $updatedphotoName;
        }

        $listing = Listing::findOrFail($id);

        $listing->update($formFields);

        return redirect('/')->with('message', 'Listing updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);
        (empty($listing->logo)) ? : unlink('photos/' . $listing->logo); 
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

      // Manage Listings
      public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings]);
    }
}

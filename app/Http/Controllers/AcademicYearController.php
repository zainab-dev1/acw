<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Alert;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academic_years = AcademicYear::all();

        return view('academicyear.index')
            ->with('academic_years',$academic_years);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academicyear.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AcademicYear::create($request->all());

        return redirect()->route('academicyear.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setactive($id)
    {
        \DB::table('academic_years')->update(['is_active'=>'0']);

        $ay = AcademicYear::findOrFail($id);

        $ay->update(['is_active'=>1]);

        return redirect()->route('academicyear.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setinactive($id)
    {
        
        $ay = AcademicYear::findOrFail($id);

        $ay->update(['is_active'=>0]);

        return redirect()->route('academicyear.index');
    }

    public function edit($id)
    {
        $ay = AcademicYear::findOrFail($id);

        return view('academicyear.edit')->with('ay',$ay);
    }

    public function update(Request $request, $id)
    {
        $ay = AcademicYear::findOrFail($id);

        $ay->update($request->all());

        Alert::success('Success','Academic Year / Semester Updated');

        return redirect()->route('academicyear.index');
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
<?php

namespace App\Http\Controllers;

use App\skill_definition;
use Illuminate\Http\Request;

class SkillDefinitionController extends Controller
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

    public function list(){
      $results = Skill_definition::select(['id', 'name as text'])->orderby('text')->get();

      return response()->json($results);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\skill_definition  $skill_definition
     * @return \Illuminate\Http\Response
     */
    public function show(skill_definition $skill_definition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\skill_definition  $skill_definition
     * @return \Illuminate\Http\Response
     */
    public function edit(skill_definition $skill_definition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\skill_definition  $skill_definition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, skill_definition $skill_definition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\skill_definition  $skill_definition
     * @return \Illuminate\Http\Response
     */
    public function destroy(skill_definition $skill_definition)
    {
        //
    }
}

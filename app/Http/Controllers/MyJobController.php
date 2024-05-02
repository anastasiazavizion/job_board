<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use Illuminate\Http\Request;
use App\Models\Job;
class MyJobController extends Controller
{
    public function __construct()
    {
        $this->middleware('employer');
    }

    public function index(){
        $this->authorize('viewAnyEmployer', Job::class);
        return view('my_job.index', ['jobs'=>auth()->user()->employer->jobs()->with(['employer','jobApplications','jobApplications.user'])->latest()->get()]);
    }

    public function create(){
        $this->authorize('create',Job::class);
        return view('my_job.create');
    }
    public function edit(Request $request, Job $myJob){
        $this->authorize('update',$myJob);
        return view('my_job.edit', ['job'=>$myJob]);
    }

    public function store(JobRequest $request){
        $this->authorize('create',Job::class);
        $request->user()->employer->jobs()->create($request->validated());
        return redirect()->route('my-jobs.index')
            ->with('success', 'Job created successfully.');
    }

    public function update(JobRequest $request, Job $myJob){
        $this->authorize('update',$myJob);
        $myJob->update($request->validated());
        return redirect()->route('my-jobs.index')
            ->with('success', 'Job updated successfully.');
    }
}

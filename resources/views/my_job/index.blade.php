<x-layout>
    <x-breadcrumbs class="mb-4" :links="['My Jobs'=>'#']"/>
    <x-card>
        <div class="text-right mb-8">
            <x-link-button :href="route('my-jobs.create')">Add new</x-link-button>
        </div>

        @forelse($jobs as $job)
            <x-job-card :$job>
                <div class="text-xs text-slate-500">
                    @forelse($job->jobApplications as $application)
                        <div class="mb-2 flex items-center justify-between">
                           <div>
                               <div>{{$application->user->name}}</div>
                               <div>Applied {{$application->created_at->diffForHumans()}}</div>
                               <div>Download CV</div>
                           </div>
                            <div>$ {{number_format($application->expected_salary)}}</div>
                        </div>
                    @empty
                        <div>No applications yet</div>
                    @endforelse
                </div>
            </x-job-card>

        @empty
            <div class="rounded-md border border-dashed border-slate-300 p-8">
                <div class="text-center font-medium">
                    You did not post any Jobs.
                </div>
                <div class="text-center">
                    Post your first job here <a class="text-indigo-500 hover:underline" href="{{route('my-jobs.create')}}">here</a>
                </div>
            </div>
        @endforelse

    </x-card>
</x-layout>

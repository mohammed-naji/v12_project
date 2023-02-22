<div class="single-job-items mb-30">
    <div class="job-items">
        <div class="job-tittle job-tittle2">
            <a href="{{ route('site.project', $project->slug) }}">
                <h4>{{ $project->trans_name }}</h4>
            </a>
            <ul>
                <li>{{ $project->user->name }}</li>
                {{-- <li><i class="fas fa-map-marker-alt"></i>Athens, Greece</li> --}}
                <li>$ {{ $project->budget }}</li>
            </ul>
        </div>
    </div>
    <div class="items-link items-link2 f-right">
        <a href="job_details.html">Full Time</a>
        <span>{{ $project->created_at->diffForHumans() }}</span>
    </div>
</div>

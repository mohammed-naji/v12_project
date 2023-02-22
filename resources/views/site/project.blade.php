@extends('site.master')

@section('title', $project->trans_name . ' Project')

@section('content')
        <!-- Hero Area Start-->
        <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset('siteassets/img/hero/about.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $project->trans_name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Hero Area End -->
        <!-- job post company Start -->
        <div class="job-post-company pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- Left Content -->
                    <div class="col-xl-7 col-lg-8">
                        <!-- job single -->
                        <div class="single-job-items mb-50">
                            <div class="job-items">
                                <div class="company-img company-img-details">
                                    <a href="#"><img src="assets/img/icon/job-list1.png" alt=""></a>
                                </div>
                                <div class="job-tittle">
                                    <a href="#">
                                        <h4>{{ $project->trans_name }}</h4>
                                    </a>
                                    <ul>
                                        <li>{{ $project->user->name }}</li>
                                        <li><i class="fas fa-map-marker-alt"></i>{{ $project->location }}</li>
                                        <li>${{ $project->budget }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                          <!-- job single End -->

                        <div class="job-post-details">
                            <div class="post-details1 mb-50">
                                <!-- Small Section Tittle -->
                                <h4>Job Description</h4>
                                {!! $project->trans_description !!}
                            </div>
                        </div>

                        <hr>

                        <h3 class="mb-5">Proposals</h3>

                        @if ($project->proposals->count() > 0)
                        @foreach ($project->proposals as $proposal)
                            <h6>{{ $proposal->freelancer->name }}</h6>
                            <p>{{ $proposal->content }}</p>

                            @if (Auth::id() == $proposal->employee_id)
                                <p>{{ $proposal->cost }}</p>
                                <a onclick="return confirm('Are you sure?!')" href="{{ route('site.delete_proposal', $proposal->id) }}" class="text-danger">Delete</a>
                            @endif

                            @if (!$loop->last)
                            <hr>
                            @endif

                        @endforeach
                        @else
                            <p>There is no proposals yet, be the first one</p>
                        @endif



                    </div>
                    <!-- Right Content -->
                    <div class="col-xl-4 col-lg-4">
                        <div class="post-details3  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Job Overview</h4>
                           </div>
                          <ul>
                              <li>Posted date : <span>{{ $project->created_at->format('d M Y') }}</span></li>
                              <li>Location : <span>{{ $project->location }}</span></li>
                              <li>Vacancy : <span>{{ $project->vacancy }}</span></li>
                              <li>Job nature : <span>{{ $project->job_type }}</span></li>
                              <li>Salary :  <span>${{ $project->budget }}</span></li>
                          </ul>
                         <div class="apply-btn2">

                            @if (!Auth::user()->proposals()->where('project_id', $project->id)->exists())
                                <a href="{{ route('site.apply_now', $project->slug) }}" class="btn">Apply Now</a>
                            @endif

                         </div>
                       </div>
                        <div class="post-details4  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Company Information</h4>
                           </div>
                            <ul>
                                <li>Name: <span>{{ $project->user->name }} </span></li>
                                <li>Phone : <span> {{ $project->user->phone }}</span></li>
                                <li>Email: <span>{{ $project->user->email }}</span></li>
                            </ul>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- job post company End -->
@stop

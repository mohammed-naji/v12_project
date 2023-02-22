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
        <section class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Apply Now</h2>
                    </div>
                    <div class="col-lg-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-contact contact_form" action="{{ route('site.apply_now_data', $project->slug) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Employee</label>
                                        <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name" disabled value="{{ Auth::user()->name }}">
                                        <input type="hidden" name="employee_id" value="{{ Auth::id() }}" />
                                        <input type="hidden" name="project_id" value="{{ $project->id }}" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Project</label>
                                        <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email" disabled value="{{ $project->trans_name }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Cost</label>
                                        <input class="form-control" name="cost" id="cost" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Cost'" placeholder="Enter Cost">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Time</label>
                                        <input class="form-control" name="time" id="time" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Time'" placeholder="Enter Time">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Proposal</label>
                                        <textarea class="form-control w-100" name="content" id="content" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Proposal'" placeholder="Enter Proposal"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- job post company End -->
@stop

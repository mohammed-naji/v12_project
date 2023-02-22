@extends('site.master')

@section('title', 'User Profile')

@section('content')
        <!-- Hero Area Start-->
        <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset('siteassets/img/hero/about.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ Auth::user()->name }} Profile</h2>
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
                        <h4>Notifications ( {{ Auth::user()->unreadnotifications->count() }} )</h4>
                        <div class="list-group">
                            @foreach (Auth::user()->notifications
                             as $item)
                                {{-- {{ $item->read_at }} --}}

                                <form action="{{ route('site.read_notify', $item->id) }}" method="post">
                                    @csrf
                                    <button class="list-group-item list-group-item-action

                                    {{ is_null($item->read_at) ? 'active' : '' }}

                                                                    ">{{ $item->data['msg'] }}</button>
                                </form>

                                {{-- <a href="{{ route('site.read_notify', $item->id) }}" class="list-group-item list-group-item-action

{{ is_null($item->read_at) ? 'active' : '' }}

                                ">{{ $item->data['msg'] }}</a> --}}
                            @endforeach

                          </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- job post company End -->
@stop

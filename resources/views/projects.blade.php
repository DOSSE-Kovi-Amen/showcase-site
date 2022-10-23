@extends('layouts.site')

@section('content')
    <div id="top_banner"
        style="background-image: url({{ asset('images/bg_banner1.jpg') }}); background-size:cover;
        background-position:center center;">
        <div class="d-flex flex-row justify-content-center align-items-center"
            style="height:300px;width:100%; background: linear-gradient(rgba(73, 73, 73, 0.377), rgba(0, 0, 0, 0.897));">
            <h1 class="text-center text-white mb-5"><strong>Projets</strong></h1>

        </div>
    </div>
    <section class="bg-light">
        <div class="container">
            <div class="row">
                @foreach ($projects as $project)
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="project">
                            <a
                            href="#"  data-bs-toggle="modal"  data-bs-target="#project{{$project->id }}">
                            <div class="overlay"></div>

                            <img class="project-img" src="{{ asset(Voyager::image($project->image)) }}" alt="">
                            <div class="content d-flex justify-content-between px-4">
                                <div>
                                    <h4 class="text-white">{{ $project->title }}</h4 class="text-white">
                                      @if ($project->status =="coming")
                                      <span class="badge rounded-pill text-bg-info fs-6">A venir</span>
    
                                          @elseif($project->status =="closed")
                                          <span class="badge rounded-pill text-bg-dark fs-6">Terminés</span>
    
                                          @else
                                          <span class="badge rounded-pill text-bg-success fs-6">En cours</span>
    
                                      @endif
    
                                </div>
                                <div style="align-self: flex-end">
                                    <a style=" position: relative; bottom: 0;" class="text-white"
                                  href="#"  data-bs-toggle="modal"  data-bs-target="#project{{$project->id }}">En savoir plus</a>
                                </div>
                                
    
                            </div>
                            </a>
                        </div>
                    </div>
                    @include('includes.modals.project')
                @endforeach
                <div class="d-flex justify-content-center">
                    {{ $projects->onEachSide(1)->links() }}

                </div>

            </div>
        </div>
    </section>
    @include('includes.services')
@endsection

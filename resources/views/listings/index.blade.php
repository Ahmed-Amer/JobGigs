@extends('layouts.app')



@section('content')

@include('inc.hero')
<main>

    <!-- Search -->
    @include('inc.search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        <!-- Item 1 -->
        @if (count($listings) > 0)
        @foreach ($listings as $listing)
            {{-- listing card component --}}
            <x-listing-card :listing="$listing" />
        @endforeach
        @else
        <p>No Listings</p>
        @endif

    </div>
    
  <div class="mt-6 p-4">
    {{$listings->links()}}
  </div>
</main>
@endsection
@extends('layouts.app')

@section('content')

<main>
  <!-- Search -->
  @include('inc.search')
  <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
    {{-- listing card component --}}
    <x-listing-card :listing="$listing" />
  </div>

  @auth
    @if (auth()->user()->id == $listing->user->id)
    <div class="mt-4 p-2 flex space-x-6">
      <a href="/listings/{{$listing->id}}/edit">
        <i class="fa-solid fa-pencil"></i> Edit
      </a>

      <form method="POST" action="/listings/{{$listing->id}}">
        @csrf
        @method('DELETE')
        <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
      </form>
    </div>
    @endif
  @endauth

</main>
@endsection
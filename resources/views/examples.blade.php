@extends('layouts.app')

@section('content')
    <div>
        <div class="h-96"></div>
        <div class="h-96"></div>
    </div>

    <h2 class="text-lg font-semibold">Standard Contact Form</h2>

    <!-- <livewire:contact-form /> -->
    <!-- <livewire:search-dropdown /> -->
    <!-- <livewire:datatable /> -->

    <div class="my-8">
        <h2 class="text-lg font-semibold mt-4">Livewire Blog Posts w/ Comments</h2>

        <ul class="list-disc mt-4">
            @foreach ($posts as $post)
                <li>
                    <a href="{{ route('post.show', $post) }}" class="text-blue-600">{{ $post->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
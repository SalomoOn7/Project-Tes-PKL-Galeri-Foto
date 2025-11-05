@extends('layouts.main')
@section('title', 'Molery - Web Based Galery')
@section('content')
    <div class="navigation-bar">
      <span class="brand">Molery</span>
      <div class="ctas">
        @guest
            <a href="/login" class="login">Login</a>
        <a href="/register" class="signup">Sign Up</a>
        @endguest
        @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        @endauth
      </div>
    </div>
    <div class="main-content">
      <header class="header">
        <span class="motto">Molery – Galeri Foto Digital</span>
        <span class="description">Molery adalah aplikasi galeri foto berbasis web melalui koleksi foto beresolusi tinggi.</span>
      </header>
      <section class="posts">
        @foreach ($posts as $post)
        <div x-data="{ open: false }" class="relative">
      <!-- Thumbnail -->
      <div class="post cursor-pointer" @click="open = true">
        <img data-src="{{ asset('storage/' . $post->filename) }}" 
             alt="{{ $post->title }}" 
             class="lazy-image w-full rounded-xl shadow hover:shadow-lg transition"
             src="https://placehold.co/600x400.png"
             loading="lazy">
      </div>

      <!-- Modal -->
      <div x-show="open"
           x-transition.opacity
           class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
           @click.self="open = false">
        <div class="bg-white p-6 rounded-xl max-w-md w-full shadow-lg relative">
          <button @click="open = false"
                  class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl">&times;</button>

          <img src="{{ asset('storage/' . $post->filename) }}" class="w-full rounded-lg mb-4" style="margin-top: 20px">
          <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
          <p class="text-gray-600 text-sm mb-2">{{ $post->description }}</p>
          <p class="text-xs text-gray-500 mb-2">
            Diposting oleh <b>{{ $post->user->name }}</b>
          </p>

          @auth
          <form method="POST" action="/likes/store" class="like-form">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit"
                    class="bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700 text-sm">
              ❤️ Like ({{ $post->like->count() }})
            </button> 
          </form>
          @endauth
        </div>
      </div>
    </div>
@endforeach
      </section>
    </div>
    <script>
  document.addEventListener("DOMContentLoaded", function() {
    const lazyImages = document.querySelectorAll("img.lazy-image");

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src; 
          img.classList.add('loaded');
          observer.unobserve(img);
        }
      });
    });

    lazyImages.forEach(img => observer.observe(img));
  });
</script>


@endsection
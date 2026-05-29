@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="container-custom">
        <div class="flex flex-col items-center mb-16">
            <div class="flex items-center gap-4 mb-4 w-full justify-center">
                <div class="flex-1 flex flex-col gap-[2px] max-w-[100px] md:max-w-[200px]">
                    <div class="h-[3px] bg-primary w-full"></div>
                    <div class="h-[3px] bg-primary w-full"></div>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-primary tracking-tighter px-6 whitespace-nowrap uppercase text-center">
                    Tim Redaksi
                </h1>
                <div class="flex-1 flex flex-col gap-[2px] max-w-[100px] md:max-w-[200px]">
                    <div class="h-[3px] bg-primary w-full"></div>
                    <div class="h-[3px] bg-primary w-full"></div>
                </div>
            </div>
            <p class="text-gray-500 font-medium text-center max-w-2xl mx-auto">
                Susunan redaksi {{ config('news_portal.site.name') }} yang berdedikasi untuk menyajikan informasi lalu lintas dan berita Mojokerto yang akurat dan terpercaya.
            </p>
        </div>

        @if($groupedTeams->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto mb-4 text-gray-300"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Tim Redaksi Belum Ditambahkan</h3>
                <p class="text-gray-500 text-sm">Informasi tim redaksi akan segera diperbarui.</p>
            </div>
        @else
            <div class="flex flex-col max-w-5xl mx-auto">
                @foreach($groupedTeams as $role => $teams)
                    <div class="mb-16">
                        {{-- Role Header --}}
                        <div class="flex items-center justify-center mb-8 relative">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="bg-gray-50 px-6 text-sm font-black text-gray-800 uppercase tracking-[0.2em]">{{ $role }}</span>
                            </div>
                        </div>

                        {{-- Members Grid --}}
                        <div class="flex flex-wrap justify-center items-start gap-x-10 gap-y-12">
                            @foreach($teams as $team)
                                <div class="flex flex-col items-center justify-start text-center group w-48 md:w-56">
                                    <div class="w-40 h-56 md:w-48 md:h-64 shrink-0 rounded-2xl overflow-hidden bg-white shadow-lg border-4 border-white mb-5 relative">
                                        @if($team->photo)
                                            <img loading="lazy" src="{{ Storage::url($team->photo) }}" alt="{{ $team->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-300"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 border-4 border-primary/0 group-hover:border-primary/20 rounded-2xl transition-colors duration-300 pointer-events-none"></div>
                                    </div>
                                    
                                    <h3 class="text-base md:text-lg font-black text-gray-900 group-hover:text-primary transition-colors leading-tight mb-0">{{ $team->name }}</h3>
                                    
                                    @if($team->description)
                                        <span class="inline-block px-3 py-1 bg-gray-200 text-gray-600 text-[10px] font-bold uppercase tracking-wider rounded-full mt-1">
                                            {{ $team->description }}
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

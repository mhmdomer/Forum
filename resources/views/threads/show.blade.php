@extends('layouts.app')

@section('content')
<thread-view inline-template :initial-count="{{ $thread->replies_count }}">
    <div class="container mx-auto">
        <div class="lg:flex lg:mx-12">
            <div class="lg:w-2/3 mx-4 lg-mx-8">
                @include('partials.thread')
                <h4 class="mt-4 text-xl md:ml-4">Replies:</h4>
                <div class="md:mx-12 mx-2 md:mt-6 mt-2">
                    <replies
                    @deleted="repliesCount--"
                    @added="repliesCount++"
                    islocked="{{ $thread->locked }}">
                </replies>
                </div>
            </div>
            <div class="lg:w-1/3">
                <div class="bg-white mt-4 p-4 rounded text-md md:mx-12">
                    <p>This thread is published {{ $thread->created_at->diffForHumans() }} by <a href="{{ route('profile', $thread->user->name) }}" class="text-purple-700">{{ $thread->user->name }}</a> and
                        it has <span v-text="repliesCount"></span> {{ str_plural('reply', $thread->replies_count) }}
                    </p>
                    <div class="md:flex">
                        <subscribe-button
                            class="mr-2"
                            v-if="signedIn"
                            :active={{ json_encode($thread->isSubscribed) }}>
                        </subscribe-button>
                        <lock-button
                            v-if="authorize('admin')"
                            :thread="{{ $thread }}">
                        </lock-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection

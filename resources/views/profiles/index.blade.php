@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <img src="{{ $user->profile->profileImage() }}"  alt="Profile Image" class="img-fluid rounded-circle w-100">
        </div>
        <div class="col-9 p-5">
            <div class="d-flex justify-content-between align-item-baseline">

                <div class="pb-3 d-flex align-items-center">
                    <div class="h4">{{ $user->username }}</div>
                    <follow-button user-id = "{{ $user->id }}" follows = "{{ $follows }}"></follow-button>
                    <!-- user-id is a prop -->
                </div>
                @can ('update', $user->profile)
                    <a href="/p/create">Add Post</a>
                @endcan

                @can ('update', $user->profile)
                    <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                @endcan
            </div>
            <div class="d-flex">
                <div class="pr-5" ><strong>{{ $postCount }}</strong> Posts</div>
                <div class="pr-5"><strong>{{ $followersCount }} </strong>Followers </div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> Following </div>
            </div>

            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
 
        </div>
    </div>

    <div class="row pt-5">
            @foreach( $user->posts as $post )
                <div class="col-4 pb-4" >
                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->image }}" style="height: auto; max-width: 100%;" class="w-100" >
                    </a>
                </div>
            @endforeach
    </div>

</div>  
@endsection

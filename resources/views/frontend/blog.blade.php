@extends('layouts.app')
@section('content')
@include('layouts.frontend_partial.main_navbar')

<div class="blog">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2>{{$page->page_title}}</h2>
                    </div>
                    @foreach($blogs as $blog)
                    @php 
                        $blog_category = DB::table('blog_category')->where('id', $blog->blog_category_id)->first();
                    @endphp
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img height="300px" width="300px" src="{{asset($blog->thumbnail)}}" alt="">
                            </div>
                            <div class="col-8">
                                <h3>{{$blog->title}}</h3>
                                <p>{{$blog_category->category_name}}</p>
                                <p>{{$blog->description}}</p>
                                <strong>Published On: {{$blog->publish_date}}</strong>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
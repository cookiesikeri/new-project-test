<div class="col-lg-4 sidebar-area">
    <div class="single_widget search_widget">
      <div id="imaginary_container">

      </div>
    </div>
    <div class="single_widget cat_widget">
      <h4 class="text-uppercase pb-20">post categories</h4>
      <ul>

      </ul>
    </div>

    <div class="single_widget recent_widget">
      <h4 class="text-uppercase pb-20">Recent Posts</h4>
      <div class="active-recent-carusel">
        @foreach ($recentPosts as $recentPost)
        <div class="item">
        <img src="{{ $post->image }}" alt="{{$recentPost->image}}" width="200px" />
        <a href="{{route('post', $recentPost->slug)}}">
        <p class="mt-20 title text-uppercase">
            {{$recentPost->title}}
        </p>
        </a>
        <p>
        {{$recentPost->created_at->diffForHumans()}}
          <span>
            <i class="fa fa-heart-o" aria-hidden="true"></i> 06
            <i class="fa fa-comment-o" aria-hidden="true"></i
            >02</span
          >
        </p>
      </div>
    @endforeach
      </div>
    </div>
    <div class="single_widget tag_widget">
      <h4 class="text-uppercase pb-20">Tag Clouds</h4>
      <ul>
       @foreach ($recentTags->unique('name')->take(10) as $recentTag)
       <li><a href="{{route('tag.posts', $recentTag->name)}}">{{$recentTag->name}}</a></li>
       @endforeach
      </ul>
    </div>
  </div>

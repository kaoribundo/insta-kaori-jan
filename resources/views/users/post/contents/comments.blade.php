<div class="mt-3">
  {{-- show all the comments --}}
  @if ($post->comments->isNotEmpty())
      <ul class="list-group mt-2">
          @foreach ($post->comments->take(3) as $comment)
              <li class="list-group-item border-0 p-0 mb-2">
                  <a href="#" class="text-decoration-none text-dark fw-bold">{{$comment->user->name}}</a>
                  &nbsp;
                  <p class="d-inline fw-bold">{{ $comment->body}}</p>

                  <form action="{{route('comment.delete',$comment->id)}}" method="post">
                      @csrf
                      @method('DELETE')

                       <span class="text-muted xsmall">
                          {{$comment->created_at->diffForHumans()}}
                       </span>
                       @if ($comment->user->id == Auth::user()->id)
                          &middot;
                          <button type="submit" class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                       @endif
                  </form>
              </li>
              <li class="list-group-item border-0 p-0 mb-2">
                  @if ($loop->last AND $post->comments->count() > 3)
                     <a href="{{route('post.show',$post->id)}}" class="text-decoration-none">View all comments ({{$post->comments->count()}}) </a>
                  @endif
              </li>
          @endforeach

      </ul>
  @endif

  <form action="{{route('comment.store',$post->id)}}" method="post">
      @csrf

      <div class="input-group">
          <textarea name="body" id="" rows="1" class="form-control"></textarea>
          <button type="submit" class="btn btn-outline-secondary btn-sm">Post</button>
      </div>
  </form>
</div>
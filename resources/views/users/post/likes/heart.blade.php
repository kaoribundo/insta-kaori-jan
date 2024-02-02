<div class="col-auto">
  {{-- heart button --}}
  @if ($post->likes->isNotEmpty())
    @foreach($post->likes as $user)
    @if($user->user_id == Auth::user()->id)
    <form action="{{route('like.delete',$post->id)}}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn shadow-none icon-sm">
          <i class="fa-solid fa-heart text-danger"></i>
      </button>
    </form>             
    @else
    <form action="{{route('like.store',$post->id)}}" method="post">
        @csrf
        <button type="submit" class="btn shadow-none icon-sm">
            <i class="fa-regular fa-heart"></i>
        </button>
    </form>        
    @endif
    @endforeach
  @else
    <form action="{{route('like.store',$post->id)}}" method="post">
    @csrf
    <button type="submit" class="btn shadow-none icon-sm">
        <i class="fa-regular fa-heart"></i>
    </button>
    </form>
  @endif

</div>
<div class="col-auto px-0">
  {{-- counter --}}
  @if($post->likes)
    {{$post->likes->count()}}
  
  @else
    0
  @endif
</div>
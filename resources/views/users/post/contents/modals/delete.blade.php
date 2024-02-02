
<div class="modal fade" id="delete-post-{{$post->id}}" >
  <div class="modal-dialog">
      <div class="modal-content border-danger">
          <div class="modal-header border-danger">
              <h5 class="modal-title text-danger" id="modalTitleId">
                  Delete Post
              </h5>
          </div>
          <div class="modal-body">
              <p>Are you sure to delete this post?</p>
              <div class="mt-3">
                  
                  <img src="{{$post->image}}" alt="" class="img-fluid">
                  <p class="text-muted mt-1">{{ $post->description }}</p>
              </div>
          </div>
          <div class="modal-footer">
             <form action="{{route('post.delete',$post->id)}}" method="post">
              @csrf
              @method('DELETE')

              <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                  Cancel
              </button>
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
             </form>
          </div>
      </div>
  </div>
</div>

<!-- Optional: Place to the bottom of scripts -->
<script>
  const myModal = new bootstrap.Modal(
      document.getElementById("modalId"),
      options,
  );
</script>
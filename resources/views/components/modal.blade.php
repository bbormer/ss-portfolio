<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="/contact">
        @csrf
        <div class="mx-auto">
        <div class="mx-auto form-group mb-4 {{ $errors->has('name') ? 'has-error' : '' }}">
            {{-- <label for="name">Name</label> --}}
            <input name="name" type="text" class="form-control w-[300px] rounded border-green-300 border-2 p-2" id="name" aria-describedby="name" placeholder=" name" required>
            <span class="text-danger">{{ $errors->first('name') }}</span>

        </div>
        <div class="form-group mx-auto mb-4 {{ $errors->has('name') ? 'has-error' : '' }}">
            {{-- <label for="email">Email address</label> --}}
            <input name="email" type="email" class="form-control w-[300px] rounded border-green-300 border-2 p-2" id="email" aria-describedby="emailHelp"
                placeholder=" email" required>
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>
        <div class="form-group mb-4 {{ $errors->has('name') ? 'has-error' : '' }}">
            {{-- <label for="exampleInputPassword1">Comment</label> --}}
            <textarea name="comment" placeholder=" message" class="form-control w-[300px] rounded border-green-300 border-2 p-2" id="exampleFormControlTextarea1" rows="3" required></textarea>
            <span class="text-danger">{{ $errors->first('comment') }}</span>
        </div>
        </div>
        <button type="submit" class="btn btn-primary rounded-lg px-2 py-1 lowercase hover:animate-pulse">send</button>
    </form>
</div>

@extends('layouts') @section('conten')

<div class="container">
    @if($errors->any())
    <div class="alert alert-danger" id="errors_box">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}} </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="container">
    @if (Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{{ Session::get('success') }}</li>
        </ul>
    </div>
    @elseif ((Session::has('failed')))
    <div class="alert alert-danger">
        <ul>
            <li>{{ Session::get('failed') }}</li>
        </ul>
    </div>
    @endif
</div>

<div class="container">
    <div class="row">
        <div class="col-12 pt-5">
            <div class="box-shadow pb-1">
                <div class="card-body">
                    <h5 class="card-title m-b-0 ">
                        <div>
                            <form class="inline md-form mr-auto mb-4 multiple-submits" action="{{asset( 'todos')}}" method="POST">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control mr-sm-2" name="name" placeholder="Input Todo"
                                        required autocomplete="off " />
                                    <div class="input-group-append">
                                        <button type="submit"
                                            class="btn btn-success multiple-submits-create">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <div class="font-weight-light">Max allow up to 300 characters</div>
                        </div>

                    </h5>
                </div>

                @foreach($todo as $temp)
                <div class="align-items-center d-flex justify-content-between bd-highlight mb-3">
                    <div class="d-flex justify-content-start">
                    <div class="p-2 bd-highlight">
                        <form action="{{route('todos.edit',$temp['id']) }}" method="POST">
                        @csrf
                        @method('GET')
                        <label class="checkbox_todos">
                                <input type="checkbox" class="multiple-submits-checkbox" onchange="this.form.submit()" <?php if ($temp->completed):
                            echo 'checked';
                            endif;
                            ?>
                            > <span class="checkmark"></span> </label>
                    </form>
                    </div>
                    <div class="p-2 bd-highlight">
                            @if ($temp->completed)
                                <span class="text-break text-decoration-line-through">{{$temp->name}} </span>
                            @else
                                <span class="text-break">{{$temp->name}} </span>
                            @endif
                    </div>
                    </div>
                    <div class="p-2 bd-highlight">
                       <form class="multiple-submits" action="{{route('todos.destroy',$temp['id']) }}" method="POST"
                        onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger multiple-submits-delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                          </svg>
                        </button>
                    </form> 
                    </div>
                    
                </div>

                @endforeach



            </div>
        </div>
    </div>
</div>

@endsection

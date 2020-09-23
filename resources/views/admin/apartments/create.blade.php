@extends('layouts.app')

@section('content')
  <div class="container">

      <h1>Add apartment</h1>

      {{-- Errors --}}
      <div class="errors">
        @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
      </div>

      <div class="row">
          <div class="col-md-4 col-sm-12">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
          </div>
          <div class="col-md-8 col-sm-12">
            <form action="{{'admin.apartments.store'}}" method="post">
                @csrf
                @method('POST')

                <div class="form-group col-md-8">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group col-md-8">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-check col-md-8">
                    <input type="submit" class="btn btn-primary align-self-end" value="Salva">
                </div>


            </form>
          </div>
      </div>
  </div>

@endsection

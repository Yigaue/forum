@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="post" action="/threads"> 
                            {{csrf_field()}}
                            <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id ="name" class="form-control"/>
                            </div>
                            <div class="form-group">
                                    <label for="body">Body:</label>
                                    <textarea name="body" id ="body" class="form-control" placeholder="start a discussion" rows="8"></textarea>
                                    </div>
                            <button type="submit" class="btn btn-primary">Publish</button>
                           </form>
                        
                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage Your Table</div>
                <div class="card-body">
                  @foreach($books as $book)
                  <div class="u-table row">
                    <div class="col-6 col-md-2">
                      Table #{{ $book->table_id }}
                      <div class="text-left">
                        <small>Total Person: {{ $book->total_person }}</small>
                      </div>
                    </div>
                    <div class="col-6 col-md-3">
                      @foreach($book->category as $category)
                      {{ $category->name }}
                      <div class="text-left">
                        <small>₱{{ $category->price }}</small>
                      </div>
                      @endforeach
                    </div>
                    <div class="col-6 col-md-3">
                      {{ $book->time  }}
                    </div>
                    <div class="col-6 col-md-4">
                      <p class="{{ (\Carbon\Carbon::now()->timestamp <= $book->time->timestamp) ? 'text-success' : 'text-secondary' }}">
                        {{ (\Carbon\Carbon::now()->timestamp <= $book->time->timestamp) ? 'On Going' : 'Completed' }}
                      </p>
                    </div>
                  </div>
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

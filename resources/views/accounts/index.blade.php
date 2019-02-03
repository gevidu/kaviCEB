@extends('accounts.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CEB sample DB</h2>
            </div>
            <div class="pull-right">
          
                <a class="btn btn-success" href="{{ route('accounts.create') }}"> Add New Record</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            
            <th>Year</th>
            <th>File Number</th>
            <th>File Color</th>
            <th>Rack Number</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($accounts as $account)
        <tr>
            <td>{{ $account->year }}</td>
            <td>{{ $account->fileno }}</td>
            <td>{{ $account->color }}</td>
            <td>{{ $account->rackno }}</td>
            
            <td>
                <form action="{{ route('accounts.destroy',$account->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('accounts.show',$account->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('accounts.edit',$account->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $accounts->links() !!}
      
@endsection
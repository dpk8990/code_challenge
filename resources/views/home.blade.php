@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(Session::has('doneMessage'))                        
                            <div class="alert alert-success m-b-0">
                                {{ Session::get('doneMessage') }}
                            </div>                               
                        @endif

                        @if(Session::has('errorMessage'))
                            <div class="alert alert-danger m-b-0">
                                {{ Session::get('errorMessage') }}
                            </div>
                        @endif
                        <form method="POST" action="{{route('random_words')}}"> 
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            </div><br>
                            <div class="form-group">
                                <label for="random_words">Random Words Type</label>
                                <select class="form-control" id="random_words" name="random_words">
                                    <option value="alphabet">Alphabet</option>
                                    <option value="numerical">Numerical</option>
                                    <option value="both">both</option>                                
                                </select>
                            </div><br>
                            <div class="form-group">
                                <label for="quantity">Select Quantity of Random Words</label>
                                <select class="form-control" id="quantity" name="quantity">
                                    <option value="1">1</option>
                                    <option value="100">100</option>
                                    <option value="1000">1000</option>                                
                                    <option value="10000">10000</option>                                
                                </select>
                            </div><br>

                            <input type="submit" name="save"  class="btn btn-primary">
                        </form> <br>

                        <div class="box nav-active-border b-info document-detail-section p-x-2">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="font-size38 sm-font-size32 xs-font-size30 branchName">Random Words List</h4>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered m-a-0">
                                        <thead class="dker">
                                            <tr>
                                                <th>Sr. no</th>
                                                <th>Name</th>
                                                <th>Word</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($randomWords)>0)
                                                @foreach($randomWords as $key=> $randomWord)
                                                    <tr>
                                                        <td>{{$key=$key+1}} </td>
                                                        <td>{!! $randomWord->name ?? 'NA' !!} </td>
                                                        <td>{!! $randomWord->word ?? 'NA' !!} </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3" align="center"><p>{{ __('backend.NoData') }}</p></td>
                                                </tr>
                                            @endif    
                                        </tbody>
                                    </table>
                                </div>       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

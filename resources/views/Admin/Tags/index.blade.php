@extends('Admin.layouts.master')

@section('page')

View Tags

@endsection

@section('content')

				<div class="row">

                    <div class="col-md-12">
                    	@include('Admin.layouts.message')
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All Tags</h4>
                                <p class="category">List of all stock</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tag title</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($tags as $tag)
                                    <tr>
                                        <td>{{$tag->id}}</td>
                                        <td>{{$tag->tag_title}}</td>
                                    <td>
             {!! Form::open(['route' => ['tags.destroy', $tag->id] , 'method'=>'DELETE' ])!!}

                                            {{Form::button('<span class="fa fa-trash"></span>',['type'=>'submit', 'class'=>'btn btn-sm btn-danger','onClick'=>'return confirm("Are You Sure ? ")' ])}}

                                            {{link_to_route('tags.edit','',$tag->id,['type'=>'submit', 'class'=>'btn btn-sm btn-info ti-pencil-alt'])}}

                                            {{link_to_route('tags.show','',$tag->id,['type'=>'submit', 'class'=>'btn btn-sm btn-primary ti-view-list-alt' ])}}                      
                                            {!! Form::close() !!}
                                     	</td>
                                 	</tr>
                                 		@endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

@endsection
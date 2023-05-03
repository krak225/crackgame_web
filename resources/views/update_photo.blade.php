@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Mon compte</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Modifier mon avatar</h3> 
</div>


<section class="panel panel-default"> 
	<div class="row m-l-none m-r-none bg-light lter">
	
		@if (session('message'))
		<div class="alert alert-success">
			{{ session('message') }}
		</div>
		@endif
		
		@if (session('warning'))
		<div class="alert alert-warning">
			{{ session('warning') }}
		</div>
		@endif
		
		<form method="post" class="form-horizontal" action="{{route('UpdatePhoto')}}">
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1" style="padding-top:20px;padding-bottom:20px;"> 
			
				<div class="col-md-12"> 
					
					@foreach($avatars as $avatar)
					<div class="col-sm-1 col-md-1 padder-v b-r b-light"> 
						<span class="fa-stack fa-1x m-r-sm"> 
							<img src="{{ asset('images/avatars/'.$avatar) }}" style="width:100%"> 
						</span>
						@if($avatar == Auth::user()->photo)
						<input type="radio" name="photo" value="{{$avatar}}" checked>
						@else
						<input type="radio" name="photo" value="{{$avatar}}">
						@endif
					</div> 
					@endforeach
					
				</div> 
				
				<div class="col-md-12"> 
				
					<button type="submit" class="btn btn-primary btn-sm">Enregistrer </button> 
				
				</div>
				
				<br style="clear:both;"/>
				
			</div>

		</form>
		
	</div>
	
</section>



@endsection
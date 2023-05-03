@extends('layouts.app')

@section('content')

			<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
			<li class="active"><i class="fa fa-dashboard "></i> Tableau de bord</li>
			</ul> 
			<div class="m-b-md"> 
			<h3 class="m-b-none">Tableau de bord</h3>
			</div> 
			
			@if(Session::has('warning'))
				<div class="alert alert-warning">
				  {{Session::get('warning')}}
				</div>
			@endif

			@if(Session::has('message'))
				<div class="alert alert-success">
				  {{Session::get('message')}}
				</div>
			@endif

			<section class="panel panel-default"> 
				<div class="row m-l-none m-r-none bg-light lter"> 
				
				<div class="col-sm-8 col-md-4 padder-v b-r b-light" style="height: 150px;"> 
					@if(Auth::user()->statut_abonnement == 'ACTIVE')
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
						<i class="fa fa-circle fa-stack-2x text-success"></i> 
						<i class="fa fa-check fa-stack-1x text-white"></i> 
					</span> 
					<a class="clear" href="#"> 
						<span class="h3 block m-t-xs"><strong class="text-success">DISPONIBLE</strong></span> 
						<small class="text-muted text-uc">STATUT DUEL</small> 
					</a> 
					@else
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
						<i class="fa fa-circle fa-stack-2x text-danger"></i> 
						<i class="fa fa-times fa-stack-1x text-white"></i> 
					</span> 
					<a class="clear" href="{{ route('sabonner') }}"> 
						<span class="h3 block m-t-xs"><strong class="text-danger">INDISPONIBLE</strong></span> 
						<small class="text-muted text-uc">STATUT DUEL</small> 
					</a>
					@endif
				</div> 
				
				<div class="col-sm-16 col-md-8 padder-v b-r b-light"> 
					<div class="col-sm-4 col-md-4">
						@if($statut_abonnement_chap_encours == 1)
						<span class="fa-stack fa-2x pull-left m-r-sm"> 
							<i class="fa fa-circle fa-stack-2x text-success"></i> 
							<i class="fa fa-check fa-stack-1x text-white"></i> 
						</span> 
						<a class="clear" href="#"> 
							<span class="h3 block m-t-xs"><strong class="text-success">ABONNÉ</strong></span> 
							<small class="text-muted text-uc">CHAP EN COURS</small> 
						</a> 
						@else
						<span class="fa-stack fa-2x pull-left m-r-sm"> 
							<i class="fa fa-circle fa-stack-2x text-danger"></i> 
							<i class="fa fa-times fa-stack-1x text-white"></i> 
						</span> 
						<a class="clear" href="{{ route('sabonner_chap') }}"> 
							<span class="h3 block m-t-xs"><strong class="text-danger">S'ABONNER</strong></span> 
							<small class="text-muted text-uc">CHAP EN COURS</small> 
						</a> 
						@endif
					</div>
					<div class="col-sm-8 col-md-8">
						<div id="flipclock_view" data-time="{{$temps_restant}}">flipclock_view</div>
						<!--span class="fa-stack fa-2x" style="font-weight: bold;font-size: px;"> 
							@if(!empty($chap_encours)) {{ substr($chap_encours->chap_date_debut,10,9) }} @endif
						</span--> 
					</div>	
				</div> 
								
				<!--div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
						<i class="fa fa-circle fa-stack-2x text-info"></i> 
						<i class="fa fa-users fa-stack-1x text-white"></i> 
					</span> 
					<a class="clear" href="{{ route('duels') }}"> 
						<span class="h3 block m-t-xs"><strong>{{$nombre_duels}}</strong></span> 
						<small class="text-muted text-uc">DUELS</small> 
					</a> 
				</div--> 
				
				
				</div> 
			</section>

			<div class="row"> 
			
				<div class="col-md-8"> 
					
					
					<section class="panel panel-default"> 
						<header class="panel-heading font-bold"> LES DUELISTES CONNECTÉS  <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
						<a href="{{ route('duelistes') }}"> 
							 <span class="label label-success pull-right" style="font-weight:normal">Afficher tout</span> 
						</a> 
						</header> 
						<div class="panel-body"> 
							<input type="hidden" id="my_user_id" value="{{Auth::user()->id}}"/>
							<div class="table-responsive"> 
								<table class="table table-striped m-b-none"> 
									<thead> 
										<tr> 
											<th width="">Pseudo</th>
											<th width="">Duels</th>
											<th width="">Victoires</th>
											<th width="">Meilleur score</th>
											<th width="">Actions</th>
										</tr> 
									</thead> 
									<tbody id="users_connected">
									@if(isset($duelistes_connectes))
									 @foreach($duelistes_connectes as $user)
										@if($user->id != Auth::user()->id)
										<!--tr> 
											<td>
												{{ ucfirst($user->pseudo) }}
											</td>
											<td>0</td>
											<td>0</td>
											<td>0</td>
											<td>
												@if(Auth::user()->statut_abonnement == 'ACTIVE')
												<span class="btnSendInvitation btn" data-to_user_id="{{ $user->id }}" > 
													<span>Inviter</span> 
												</span>
												@endif
											</td>
										 </tr-->
										 @endif
									 @endforeach
									 @endif
									</tbody> 
								</table> 
							</div>  
						</div> 
						<footer class="panel-footer bg-white no-padder"> 
							<div class="row text-center no-gutter">
							
								
							</div> 
						</footer> 
					</section>

					
					
				</div> 
			
				<div class="col-md-4"> 
				
					<section class="panel panel-default"> 
						<header class="panel-heading font-bold">
							TOP VAINQUEURS
						</header> 
						<div class="panel-body"> 
							<div id="flot-1ine" style="height:90px"></div> 
						</div> 
						<footer class="panel-footer bg-white no-padder"> 
							
						</footer> 
					</section> 
					
				</div> 
				
			</div> 

			

@endsection

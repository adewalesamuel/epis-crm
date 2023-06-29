@extends('admin.layouts.main')
@section('content')
    {{-- <div class="header-bg"> 
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mb-4 pt-5">
                    <div id="morris-bar-example" class="dash-chart"></div>
    
                    <div class="mt-4 text-center">
                        <button type="button" class="btn btn-outline-primary ml-1 waves-effect waves-light">Year 2017</button>
                        <button type="button" class="btn btn-outline-info ml-1 waves-effect waves-light">Year 2018</button>
                        <button type="button" class="btn btn-outline-primary ml-1 waves-effect waves-light">Year 2019</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30" style="border-left: 5px solid red">
                    <div class="card-body text-muted">
                        <h5>Bonjour Admin! Bienvenu sur la plateforme de gestion de clients et services de Epistrophe.</h5>
                        <div class="text-muted">Pour commencer vous pouvez : </div>
                        <div class="container-fluid">
                            <ul class="row mt-3" style="list-style-type: none; padding: 0">
                                <li class="col-lg-4 col-sm-12">
                                    <b><a href="{{ route('admin.clients.create') }}">Créer un client</a></b>
                                </li>
                                <li class="col-lg-4 col-sm-12">
                                    <b><a href="{{ route('admin.clients.index') }}">Créer un abonnement</a></b>
                                </li>
                                <li class="col-lg-4 col-sm-12">
                                    <b><a href="javascript:void(0)" class="toggle-search" data-target="#search-wrap">Rechercher un client</a></b>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-info">{{ isset($counts) ? $counts['client'] : '0' }}
</h3>
                        Clients
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-purple">{{ isset($counts) ? $counts['domaine'] : '0' }}</h3>
                        Domaines
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-primary">{{ isset($counts) ? $counts['hebergement'] : '0' }}</h3>
                        Hebergements
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card text-center m-b-30">
                    <div class="mb-2 card-body text-muted">
                        <h3 class="text-primary">{{ isset($counts) ? $counts['siteweb'] : '0' }}</h3>
                        Sites Web
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    
        <div class="row">
    
            <div class="col-xl-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Graphique 1</h4>
    
                        {{-- <div class="row text-center m-t-20">
                            <div class="col-6">
                                <h5 class="">56241</h5>
                                <p class="text-muted font-14">Marketplace</p>
                            </div>
                            <div class="col-6">
                                <h5 class="">23651</h5>
                                <p class="text-muted font-14">Total Income</p>
                            </div>
                        </div> --}}
    
                        <div id="morris-donut-example" class="dash-chart"></div>
                    </div>
                </div>
            </div>
    
            <div class="col-xl-8">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Graphique 2</h4>
    
                        {{-- <div class="row text-center m-t-20">
                            <div class="col-4">
                                <h5 class="">56241</h5>
                                <p class="text-muted font-14">Marketplace</p>
                            </div>
                            <div class="col-4">
                                <h5 class="">23651</h5>
                                <p class="text-muted font-14">Total Income</p>
                            </div>
                            <div class="col-4">
                                <h5 class="">23651</h5>
                                <p class="text-muted font-14">Last Month</p>
                            </div>
                        </div> --}}
    
                        <div id="morris-area-example" class="dash-chart"></div>
                    </div>
                </div>
            </div>
    
        </div>
        <!-- end row -->
    
        <div class="row">
            <div class="col-xl-9">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 m-b-30 header-title">Abonnements récents</h4>
    
                        <div class="table-responsive">
                            <table class="table m-t-20 mb-0 table-vertical">
                                <tbody>
                                    <tr>
                                        <td>Client</td>
                                        <td>Service</td>
                                        <td>Status</td>
                                        <td>Date de création</td>
                                        <td></td>
                                    </tr>
                                    @for ($i = 0; $i <= count($abonnements) - 1; $i++)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="user-image" class="thumb-sm rounded-circle mr-2"/>
                                            {{ $abonnements[$i]->client->username ?? '' }}
                                        </td>
                                        <td>
                                            {{ isset($abonnements[$i]->service->designation) ? ucfirst($abonnements[$i]->service->designation) : '' }}
                                            {{ $abonnements[$i]->service->designation_spe ?? '' }}
                                        </td>
                                        <td>
                                            @if (isset($abonnements[$i]->date_fin) && date('Y-m-d', strtotime('today')) > $abonnements[$i]->date_fin)
                                                <i class="mdi mdi-checkbox-blank-circle text-danger"></i> Expiré
                                            @else
                                                <i class="mdi mdi-checkbox-blank-circle text-success"></i> Actif
                                            @endif
                                        </td>
                                        <td>
                                            {{ date_format(new DateTime($abonnements[$i]->date_debut), 'd-m-Y') }}
                                        </td>
                                        <td>
                                            <a type="button" href="/admin/abonnements/{{ $abonnements[$i]->service->designation . 's/' . $abonnements[$i]->id }}"class="btn btn-secondary btn-sm waves-effect">Voir</a>
                                        </td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 m-b-30 header-title">Recherche abonnements</h4>

                        <form action="/admin/recherche" method="GET" accept-charset="utf-8">
                            <div class="form-group row">
                                <label for="" class="col-12 col-form-label">Date début</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" value="{{  date('Y-m-d', strtotime('-1 year')) }}" id="date_debut" name="date_debut" data-parsley-excluded="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-12 col-form-label">Date fin</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" value="{{ date('Y-m-d') }}" id="date_fin" name="date_fin" data-parsley-excluded="true">
                                </div>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-primary w-md waves-effect waves-light w-100" type="submit">Rechercher</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    {{-- 
            <div class="col-xl-4">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 m-b-15 header-title">Recent Activity Feed</h4>
    
                        <ol class="activity-feed mb-0">
                            <li class="feed-item">
                                <span class="date">Sep 25</span>
                                <span class="activity-text">Responded to need “Volunteer Activities”</span>
                            </li>
    
                            <li class="feed-item">
                                <span class="date">Sep 24</span>
                                <span class="activity-text">Added an interest “Volunteer Activities”</span>
                            </li>
                            <li class="feed-item">
                                <span class="date">Sep 23</span>
                                <span class="activity-text">Joined the group “Boardsmanship Forum”</span>
                            </li>
                            <li class="feed-item">
                                <span class="date">Sep 21</span>
                                <span class="activity-text">Responded to need “In-Kind Opportunity”</span>
                            </li>
                            <li class="feed-item">
                                <span class="date">Sep 18</span>
                                <span class="activity-text">Created need “Volunteer Activities”</span>
                            </li>
                            <li class="feed-item">
                                <span class="date">Sep 17</span>
                                <span class="activity-text">Attending the event “Some New Event”. Responded to needed.</span>
                            </li>
                            <li class="feed-item pb-1">
                                <span class="activity-text">
                                    <a href="" class="text-primary">More Activities</a>
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div> --}}
    
    
        </div>
        <!-- end row -->
    
     </div>
    
@endsection
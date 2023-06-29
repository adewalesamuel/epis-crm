@extends('admin.layouts.main')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-xl-3">
                <a href="/admin/services/domaines">
                    <div class="card text-center m-b-30">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-info">{{ isset($counts) ? $counts['domaine'] : '0' }}</h3>
                            Domaines
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a href="/admin/services/hebergements">
                    <div class="card text-center m-b-30">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-purple">{{ isset($counts) ? $counts['hebergement'] : '0' }}</h3>
                            Hebergements
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a href="/admin/services/sitewebs">
                    <div class="card text-center m-b-30">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-primary">{{ isset($counts) ? $counts['siteweb'] : '0' }}</h3>
                            Sites Web
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a href="/admin/services/messageriepros">
                    <div class="card text-center m-b-30">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-warning">{{ isset($counts) ? $counts['messageriepro'] : '0' }}</h3>
                            Messagerie Pro
                        </div>
                    </div>                    
                </a>

            </div>
            <div class="col-6 col-xl-3">
                <a href="/admin/services/certificatssls">
                    <div class="card text-center m-b-30">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-success">{{ isset($counts) ? $counts['certificatssl'] : '0' }}</h3>
                             Certificats SSL
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a href="/admin/services/service_particuliers">
                    <div class="card text-center m-b-30">
                        <div class="mb-2 card-body text-muted">
                            <h3 class="text-danger">{{ isset($counts) ? $counts['autre'] : '0' }}</h3>
                            Autres
                        </div>
                    </div>
                </a>
            </div>
        </div>
    
     </div>
    
@endsection
@extends('layouts.app-mail')

@section('content')
    <table class="panel" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td class="panel-content">
                <h1 class="panel-item">Bonjour! {{ $data->name }}</h1>
               @if ($action === "created")
               <p class="panel-item break-all">Un administrateur a activé votre compte sur la plateforme <strong>UTA School GENIUS</strong> en tant  qu'étudiant.</p>
               @else
               <p class="panel-item break-all">Un administrateur a mis à jour votre compte sur la plateforme <strong>UTA School GENIUS</strong> en tant  qu'étudiant.</p>
               @endif
                <p class="panel-item break-all">Vous pouvez maintenant vous connecter à votre compte.</p>
                <p class="panel-item break-all">Vos données de connexion sont les suivantes:</p>
                <p class="panel-item break-all">Email: {{ $data->email }}</p>
                <p class="panel-item break-all">Mot de passe: {{ $password }}</p>
                <p class="panel-item break-all"><strong style="color: red;">NB:</strong> Vous pouvez changer votre mot de passe une fois connecté.</p>
                {{-- connexion button --}}
                <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0"
                    role="presentation">
                    <tr>
                        <td align="center">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td align="center">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td>
                                                    <a href="https://uta-school.eveecorp.link" class="button button-blue"
                                                        target="_blank" rel="noopener">
                                                        Se connecter
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
@endsection

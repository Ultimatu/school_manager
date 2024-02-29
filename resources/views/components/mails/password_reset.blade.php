@extends('layouts.app-mail')

@section('content')
    <table class="panel" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td class="panel-content">
                <h1 class="panel-item">Bonjour! {{ $data->name  }}</h1>
               <p class="panel-item break-all">Votre mot de passe a été réinitialiser avec success</p>
                <p class="panel-item break-all">Vous pouvez maintenant vous connecter à votre compte.</p>
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
                                                    <a href="https://uta-school.eveecorp.link" class="button button-success"
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

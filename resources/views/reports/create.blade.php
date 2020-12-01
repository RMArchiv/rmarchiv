@extends('layouts.app')
@section('pagetitle', trans('app.report_game'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>
                        @if($game->subtitle)
                            {{ $game->title }}
                            <small> - {{ $game->subtitle }}</small> - {{ trans('app.report_game') }}
                        @else
                            {{ $game->title }} - {{ trans('app.report_game') }}
                        @endif

                    </h1>
                    {!! Breadcrumbs::render('game-report', $game) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Hinweise für das Melden von Spielen
                    </div>
                    <div class="card-body">
                        <p>Liebe Community,</p>
                        <p>Da es diverse Verbesserungsw&uuml;nsche und Ideen gab, wie man Spieledownloads im Archiv l&ouml;schen lassen kann, haben wir uns mit einigen Leuten zusammengetan um Konzepte zu erarbeiten, die konstruktiv f&uuml;r die Community, die Prinzipien des Archivs als umfrangreiche Sammlung diverser RPGMaker-Spiele aus mehreren Jahrzehnten, den Schutz des pers&ouml;nlichen Rechts und in Teilen auch des Urheberrechts sind.</p>
                        <p>Spiele k&ouml;nnen gemeldet werden, wenn:</p>
                        <ul>
                            <li>ihr der Entwickler seid und eure Spiele nicht auf unserer Plattform gelistet haben wollt.</li>
                            <li>strafrechtlich relevante Inhalte (verfassungsfeindliche Symbole, Volksverhetzung, Kinderpornografie) in dem Spiel erkennbar sind.</li>
                            <li>Sexueller Content mit sichtbaren Genitalien gezeigt wird.</li>
                            <li>Menschen systematisch diskriminiert werden aufgrund von Geschlecht, Herkunft oder Religion.</li>
                            <li>Ohne euer Einverst&auml;ndnis in dem Spiel pers&ouml;nliche Daten von euch offenbart werden. (Klar erkennbare Fotos, Adressen, etc.)</li>
                            <li>Ihr zweifelsfrei belegen k&ouml;nnt, dass ihr der Urheber einer Grafik oder Audiodatei seid, die in einem Spiel im Archiv ohne eure Erlaubnis verwendet wurde.</li>
                        </ul>
                        <p>Wir werden die Spiele dann zeitnah pr&uuml;fen und uns mit euch in Kontakt setzen.</p>
                        <p>Wir m&ouml;chten euch darauf hinweisen, dass die Eintr&auml;ge der Spiele im Archiv weiterhin bestehen bleiben, es werden lediglich die Downloadlinks entfernt um somit den Entwicklern, wie bereits in der Vergangenheit erfolgt, die M&ouml;glichkeit zu geben, die Inhalte nachzubessern und somit eine neue Version zur Verf&uuml;gung zu stellen.</p>
                        <p>Es wird im Moment an L&ouml;sungen gearbeitet, dass man Spiele direkt auf der Plattform melden kann und dies effizienter und ggfs. automatisierter ablaufen k&ouml;nnte.</p>
                        <p>Bis dahin, bieten wir euch an, Ryg, Erisch oder Yokariko zu kontaktieren.</p>
                        <p>Ihr k&ouml;nnt uns auf mehreren Wegen erreichen:</p>
                        <p>Entweder im RMArchiv-Discord, wo wir extra einen Kanal daf&uuml;r angelegt haben. Den Link zum Discord-Server, findet ihr hier: <a href="https://discord.gg/teWCkZ6">https://discord.gg/teWCkZ6</a>&nbsp;</p>
                        <p>Es gibt auch die M&ouml;glichkeit, eine E-Mail an <a href="mailto:webmaster@rmarchiv.de">webmaster@rmarchiv.de</a> zu schreiben und dort ein Spiel zu melden.</p>
                        <p>Alternativ k&ouml;nnt ihr uns auch direkt auf folgenden Wegen erreichen:</p>
                        <p>Ryg <br />Discord: ryg#3553 <br />PN: <a href="https://www.multimediaxis.de/members/889-ryg">Multimediaxis/Atelier</a> &amp; <a href="https://rpgmaker-mv.de/user/549-ryg/">MV-Forum </a></p>
                        <p>Erisch <br />Discord: waschb&auml;r#6337</p>
                        <p>Yoraiko <br />Discord: In_Pace#9664 <br />PN: <a href="https://rpgmaker-mv.de/user/521-yoraiko/">MV-Forum </a></p>
                        <p>&nbsp;</p>
                        <p>mit freundlichen Gr&uuml;&szlig;en, <br />euer RMArchiv Putzteufelteam.</p>
                    </div>
                    <div class="card-footer">
                        Vielen Dank für euer Verständnis
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if(Auth::check())
                    <div class="col-md-12">
                        {!! Form::open(['method' => 'POST', 'route' => ['game-report.store', $game->id]]) !!}
                        <div class="card">
                            <div class="card-header">
                                {{ trans('app.report_game') }}
                            </div>
                            <div class="card-body">
                                @include('_partials.markdown_editor')
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="{{trans('app.submit')}}" class="btn btn-primary">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
            @else
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Keine Berechtigung / Missing Permissions
                        </div>
                        <div class="card-body">
                            Momentan können Spiele Repots in diesem System nur mit einem registrierten Benutzeraccount gesendet werden.<br>
                            Alternativ kann eine E-Mail an <a href="mailto:report@rmarchiv.de">report@rmarchiv.de</a> gesendet werden<br>
                            <br>
                            Currently, system-side game reports can only be created with an registered user account.<br>
                            Alternatively you can send an e-mail to <a href="mailto:report@rmarchiv.de">report@rmarchiv.de</a><br>
                            <br>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
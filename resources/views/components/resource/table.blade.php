<div class="container" id="content">
    <h1>{{ $title ?? "" }}</h1>
    @include('resources.'. ($type ?? '') .'._partials.nav')
    @php
        $currentSort = request('sort', 'created_at');
        $currentDirection = request('direction', 'desc');
        $sortLink = function (string $column) use ($currentSort, $currentDirection) {
            $nextDirection = $currentSort === $column && $currentDirection === 'asc' ? 'desc' : 'asc';
            return request()->fullUrlWithQuery([
                'sort' => $column,
                'direction' => $nextDirection,
                'page' => 1,
            ]);
        };
        $sortIndicator = function (string $column) use ($currentSort, $currentDirection) {
            if ($currentSort !== $column) {
                return '';
            }

            return $currentDirection === 'asc' ? ' ^' : ' v';
        };
    @endphp
    <div class="card">
    <table id='rmarchiv_prodlist' class='boxtable pagedtable table table-striped'>
        <thead>
        <tr class='sortable'>
            <th><a href="{{ $sortLink('type') }}">Typ{{ $sortIndicator('type') }}</a></th>
            <th><a href="{{ $sortLink('category') }}">Kategorie{{ $sortIndicator('category') }}</a></th>
            <th><a href="{{ $sortLink('author') }}">Autor{{ $sortIndicator('author') }}</a></th>
            <th><a href="{{ $sortLink('created_at') }}">Hinzugefügt{{ $sortIndicator('created_at') }}</a></th>
            <th><a href="{{ $sortLink('title') }}">Titel{{ $sortIndicator('title') }}</a></th>
            <th><a href="{{ $sortLink('content_type') }}">Inhalt{{ $sortIndicator('content_type') }}</a></th>
            <th><a href="{{ $sortLink('upvotes') }}">Likes{{ $sortIndicator('upvotes') }}</a></th>
            <th><a href="{{ $sortLink('downvotes') }}">Dislikes{{ $sortIndicator('downvotes') }}</a></th>
            <th><a href="{{ $sortLink('rating') }}">Bewertung{{ $sortIndicator('rating') }}</a></th>
            <th><a href="{{ $sortLink('popularity') }}">Popularität{{ $sortIndicator('popularity') }}</a></th>
            <th><a href="{{ $sortLink('comments') }}">Kommentare{{ $sortIndicator('comments') }}</a></th>
        </tr>
        </thead>

        @foreach($resources as $res)
            <tr>
                <td>{{ $res->restype }}</td>
                <td>{{ $res->rescat }}</td>
                <td class=>{{ $res->username }}</td>
                <td class='date'><time datetime='{{ $res->rescreatedat }}' title='{{ $res->rescreatedat }}'>{{ \Carbon\Carbon::parse($res->rescreatedat)->diffForHumans() }}</time></td>
                <td><a href="{{ route('resources.show', [$res->restype, $res->rescat, $res->resid]) }}">{{ $res->restitle }}</a></td>
                <td>{{ $res->contenttype }}</td>
                <td class='votes'>{{ $res->voteup ?? 0 }}</td>
                <td class='votes'>{{ $res->votedown ?? 0 }}</td>
                @php $avg = @(($res->voteup - $res->votedown) / ($res->voteup + $res->votedown != 0 ? $res->voteup + $res->votedown : 1)) @endphp
                <td class='votes'>{{ number_format($avg, 2) }}&nbsp;
                    @if($avg > 0)
                        <img src='/assets/rate_up.gif' alt='up' />
                    @elseif($avg == 0)
                        <img src='/assets/rate_neut.gif' alt='neut' />
                    @elseif($avg < 0)
                        <img src='/assets/rate_down.gif' alt='down' />
                    @endif
                </td>
                @php
                    $perc = \App\Helpers\MiscHelper::getPopularity($res->commentcount, $commentsmax);
                @endphp
                <td><div class='innerbar_solo' style='width: {{ $perc }}%' title='{{ number_format($perc, 2) }}%'><span>{{ $perc }}</span></div></td>
                <td>{{ $res->commentcount }}</td>
            </tr>
        @endforeach
    </table>
        @if(method_exists($resources, 'links'))
            <div class="card-footer">
                {{ $resources->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </div>
</div>

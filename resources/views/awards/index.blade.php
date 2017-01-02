@extends('layouts.app')
@section('content')
    <div class="content">
        @include('awards._partials.nav')

        {{ $ayear = null }}
        <div style="width: 80%" class="rmarchivtbl" id="rmarchivbox_awards">
            <h1>Awards</h1>
            @foreach($awards as $aw)
                @if($ayear != $aw->year)
                    @if($ayear != null)
                        </table>
                    @endif

            <?php $ayear = $aw->year ?>
            <h2>{{ $ayear }}</h2>
            <table class="boxtable">
                @endif
                <tr>
                    <td width="30%">
                        {{ $aw->awardpage }}
                    </td>
                    <td>
                        <a href="{{ url('awards', $aw->id) }}">{{ $aw->title }}</a>
                        @if($aw->month <> 0)
                            :: ({{ trans('app.misc.month.'.$aw->month) }})
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
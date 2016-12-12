@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="rmarchivtbl" id="rmarchivbox_cdcmoderator" style="width: 80%">
            <h1>{{ data.0.page }}: {{ data.0.title }} - {{ data.0.year }} </h1>

            {% for aw in data %}
            <h2>{{ aw.subtitle }}</h2>
            <table class="boxtable">
                {% for row in aw.places %}
                <tr>
                    <td width="60px">
                        {% if row.medal != 'no' %}
                        Platz {{ row.place }}<img src="/assets/imgs/{{ row.medal }}" alt="{{ row.place }}" title="{{ row.place }}">
                        {% else %}
                        Platz {{ row.place }}
                        {% endif %}
                    </td>
                    <td width="60%">
                    <span class='typeiconlist'>
                        <span class='typei type_{{ row.game.game_type }}' title='{{ row.game.game_type }}'>{{ row.game.game_type }}</span>
                    </span>
                        <span class='platformiconlist'>
                        <span class='typei type_{{ row.game.maker.short }}' title='{{ row.game.maker.name }}'>{{ row.game.maker.name }}</span>
                    </span>
                        <span class='prod'>
                        <a href='/?page=game&id={{ row.game.id }}'>
                            {{ row.game.title }}
                            {% if row.game.subtitle %}
                                <small> - {{ row.game.subtitle }}</small>
                            {% endif %}
                        </a>
                    </span>
                    </td>
                    <td width="14%">
                        <a href='/?page=creator&id={{ row.game.creator.id }}'>{{ row.game.creator.name }}</a>
                    </td>
                    <td>
                        {{ row.reason }}
                    </td>
                </tr>
                <tr>
                    {% endfor %}
            </table>
            {% endfor %}
        </div>
    </div>
@endsection
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{ trans('app.tag_cloud') }}
            </div>
            <div class="card-body">
                @php
                    $cloud = new \LithiumDev\TagCloud\TagCloud();
                @endphp

                @foreach(\App\Models\TagRelation::with('tag')->get() as $tag)
                    @php
                        $cloud->addTag([
                            'tag' => $tag->tag->title,
                            'url' => action('TaggingController@showGames', $tag->tag->id),
                            'id' => $tag->tag->id,
                        ])
                    @endphp
                @endforeach
                @php
                    $cloud->setHtmlizeTagFunction(function($tag, $size) {
                        $btnsize = '';
                        if($size <= 3){
                            $btnsize = 'btn-xs';
                        }elseif($size <= 5){
                            $btnsize = 'btn-sm';
                        }elseif($size <= 7){
                            $btnsize = '';
                        }else{
                            $btnsize = 'btn-lg';
                        }
                        $counter = \App\Models\TagRelation::whereTagId($tag['id'])->count();
                        $link = '<a class="btn btn-secondary '.$btnsize.'" href="'.$tag['url'].'">'.$tag['tag'].'<span class="badge">'.$counter.'</span></a> ';
                        return $link;
                        //return "<span  class='tag size{$size}'>{$link}</span> ";
                    });
                    $cloud->setLimit(30);
                @endphp
                {!!  $cloud->render() !!}
            </div>
            <div class="card-footer">
                <a href="{{ url('tags') }}">{{ trans('app.more') }}...</a>
            </div>
        </div>
    </div>
</div>
<div class="progress">
    <div class="progress-bar border" style="width: {{  number_format($percent, 2) }}%;">
        @if(isset($hasText))
            @if($hasText)
                {{number_format($percent, 2).'%'}}
            @endif
        @endif
    </div>
</div>
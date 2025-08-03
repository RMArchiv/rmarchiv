<li class="{{ request()->is(ltrim($href, '/')) ? 'badge rounded-pill bg-secondary' : 'badge rounded-pill bg-dark' }}">
    <a href="{{request()->is(ltrim($href, '/')) ? url( implode('/', array_slice( explode('/', $href), 0, -1) ) ) : url($href) }}">
        {{ trans($trans) }}
    </a>
</li>

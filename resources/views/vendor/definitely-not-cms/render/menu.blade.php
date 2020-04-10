@extends('vendor.definitely-not-cms.render.main')
@section('content')
<nav id="navbar" style="position: fixed; width: 100%; z-index: 50; top:0">
    @if($page->menu)
    <header class="header {{'Menu-' . $page->menu->id }}">
        {{-- <a href="" class="logo">CSS Nav</a> --}}
        <input class="menu-btn" type="checkbox" id="menu-btn" style="color: inherit;" />
        <label class="menu-icon" style="color: inherit;" for="menu-btn"><span style="color: inherit;" class="navicon"></span></label>
        <ul class="menu">
            @foreach($page->menu->items->sortBy('order') as $menuItem)
                <li><a class="MenuItem-{{ $menuItem->id }}" href="{{ $menuItem->link ? $menuItem->link->url : '' }}">{{ $menuItem->name }}</a></li>
            @endforeach
        </ul>
    </header>
    @endif
</nav>

<style>
    /* header */

    .header {
        box-shadow: 1px 1px 4px 0 rgba(0,0,0,.1);
        position: fixed;
        width: 100%;
        z-index: 3;
        display: block;
    }

    .header ul {
        margin: 0;
        padding: 0;
        list-style: none;
        overflow: hidden;
    }

    .header li a {
    display: block;
    padding: 10px 20px;
    text-decoration: none;
    }

    .header li a:hover,
    .header .menu-btn:hover {
    color: gray;
    }

    .header .logo {
    display: block;
    float: left;
    font-size: 2em;
    padding: 10px 20px;
    text-decoration: none;
    }

    /* menu */

    .header .menu {
    clear: both;
    max-height: 0;
    transition: max-height .2s ease-out;
    }

    /* menu icon */

    .header .menu-icon {
    cursor: pointer;
    display: inline-block;
    float: right;
    padding: 28px 20px;
    position: relative;
    user-select: none;
    }

    .header .menu-icon .navicon {
    background: #333;
    display: block;
    height: 2px;
    position: relative;
    transition: background .2s ease-out;
    width: 18px;
    }

    .header .menu-icon .navicon:before,
    .header .menu-icon .navicon:after {
    background: #333;
    content: '';
    display: block;
    height: 100%;
    position: absolute;
    transition: all .2s ease-out;
    width: 100%;
    }

    .header .menu-icon .navicon:before {
    top: 5px;
    }

    .header .menu-icon .navicon:after {
    top: -5px;
    }

    /* menu btn */

    .header .menu-btn {
    display: none;
    }

    .header .menu-btn:checked ~ .menu {
    max-height: 240px;
    }

    .header .menu-btn:checked ~ .menu-icon .navicon {
    background: transparent;
    }

    .header .menu-btn:checked ~ .menu-icon .navicon:before {
    transform: rotate(-45deg);
    }

    .header .menu-btn:checked ~ .menu-icon .navicon:after {
    transform: rotate(45deg);
    }

    .header .menu-btn:checked ~ .menu-icon:not(.steps) .navicon:before,
    .header .menu-btn:checked ~ .menu-icon:not(.steps) .navicon:after {
    top: 0;
    }

    /* 48em = 768px */

    @media (min-width: 1024px) {
        .header {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .header li {
            float: left;
        }
        .header li a {
            padding: 20px 30px;
        }
        .header .menu {
            clear: none;
            float: right;
            max-height: none;
        }
        .header .menu-icon {
            display: none;
        }

        .header ul {
            display: flex;
            align-items: center;
        }
    }
</style>
@endsection

<nav id="navbar" style="position: fixed; width: 100%; z-index: 50; top:0">
    @if($page->menu)
    <header id="{{'Menu-' . $page->menu->id }}" class="header {{'Menu-' . $page->menu->id }}"
            @if(auth()->check())
            onmouseover="EventBus.$emit('menuHovered', { menuId: '{{ 'Menu-' . $page->menu->id }}', event: event })"
            onclick="EventBus.$emit('menuSelected', { menuId: '{{ 'Menu-' . $page->menu->id }}', event: event })"
            @endif
    >
        <input class="menu-btn" type="checkbox" id="menu-btn" style="color: inherit;" />
        <label class="menu-icon" style="color: inherit;" for="menu-btn"><span style="color: inherit;" class="navicon"></span></label>
        <ul class="menu">
            @foreach($page->menu->items->sortBy('order') as $menuItem)
                <li>
                    <a
                        href="{{ $menuItem->link->url }}"
                        id="MenuItem-{{ $menuItem->id }}"
                        @if(auth()->check())
                        onmouseover="EventBus.$emit('menuItemHovered', { menuItemId: '{{ 'MenuItem-' . $menuItem->id }}', event: event })"
                        onclick="EventBus.$emit('menuItemSelected', { menuItemId: '{{ 'MenuItem-' . $menuItem->id }}', event: event }); return false;"
                        @endif
                        class="MenuItem-{{ $menuItem->id }}" href="{{ $menuItem->link ? $menuItem->link->url : '' }}"
                    >
                    {{ $menuItem->name }}
                    </a>
                </li>
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
    background: white;
    display: block;
    height: 2px;
    position: relative;
    transition: background .2s ease-out;
    width: 18px;
    }

    .header .menu-icon .navicon:before,
    .header .menu-icon .navicon:after {
    background: white;
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
            height: 50px
        }
        .header .menu li {
            height: 50px;
        }

        .header .menu li a {
            height: 100%;
            line-height: 2.5;
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

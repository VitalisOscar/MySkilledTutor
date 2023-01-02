<aside class="sidenav px-lg-4" id="sidenav" onclick="if(event.target == this){ this.classList.remove('open') }">
    <div>
        <div class="text-center mb-4">
            <div><strong>{{ $user->name }}</strong>
            </div>
            <div class="mb-2">{{ $user->email }}</div>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn-outline-default btn-rounded btn-sm py-2 px-4 shadow-none py-2"><i class="fa fa-power-off"></i> Sign Out</button>
            </form>
        </div>

        <div class="sidenav-items mb-4">
            <a href="{{ route('client.dashboard') }}"
                @if($current_route->getName() == 'client.dashboard') class="active" @endif>
                <i class="fa fa-user bg-warning"></i>Dashboard
            </a>

            <a href="{{ route('client.orders.create') }}"
                @if($current_route->getName() == 'client.orders.create') class="active" @endif>
                <i class="fa fa-plus bg-primary"></i>Create an order
            </a>

            <a href="{{ route('client.orders.all', 'active') }}"
                @if($current_route->getName() == 'client.orders.all') class="active" @endif>
                <i class="fa fa-tasks bg-default"></i>My Orders
            </a>

            <a href="{{ route('client.account') }}"
                @if($current_route->getName() == 'client.account') class="active" @endif>
                <i class="fa fa-user bg-indigo"></i>Account Settings
            </a>

            <a href="{{ route('client.notifications') }}"
                @if($current_route->getName() == 'client.notifications') class="active" @endif>
                <i class="fa fa-bell bg-danger"></i>My Notifications
            </a>
        </div>
    </div>
</aside>

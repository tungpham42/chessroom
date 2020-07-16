<header class="site-header shadow-lg fixed-top">
  <div class="container mx-auto">
    <div class="row align-items-center">
      <a class="navbar-brand mr-auto my-0" href="{{ url('/') }}"><img src="{{ URL::to('/') }}/img/app-icons/logo-chess.png" class="chess-logo" alt="chess logo"><span>Chess</span><span id="header-status"></span></a>
      <div class="menu-toggle open" title="Menu"></div>
      <nav class="navbar py-0">
        <ul class="nav navbar-nav">
          <li class="pt-4">
            <a class="home" href="{{ url('/') }}">Home</a>
          </li>
          <li class="pt-4">
            <a class="room" href="{{ url('/rooms') }}">Rooms</a>
          </li>
          <li class="pt-4">
            <a class="about" href="{{ url('/about-us') }}">About Us</a>
          </li>
          <li class="pt-4">
            <a class="contact" href="{{ url('/contact-us') }}">Contact Us</a>
          </li>
          <li class="pt-4">
            <a class="blog" href="{{ url('/blog') }}">Blog</a>
          </li>
          <li class="pt-4">
            <a target="_blank" class="buy" href="https://www.codester.com/items/23609/chess-game-with-ai-php-script?ref=tungpham"><i class="fal fa-usd-circle"></i> BUY</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</header>
@extends('frontend.layouts.template_landing')
@php
$landing_banner = "style=background-image:url(/assets/images/bg-app.png)";
$landing_banner2 = "style=background-image:url(/assets/images/ld-banner-02.png)";
@endphp
@section('main')

<body class="template-coming-soon">
    <video autoplay muted loop playsinline id="myVideo" width='100%' height='100%' style="object-fit: cover;
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;">
        <source src="{{asset('assets/video/vid.mp4')}}" type="video/mp4">
        <source src="{{asset('assets/video/vid.mp4')}}" type="video/webm">

    </video>
    <script>
        // Get the video
        var video = document.getElementById("myVideo");

        // Get the button
        var btn = document.getElementById("myBtn");

        // Pause and play the video, and change the button text
        function myFunction() {
            if (video.paused) {
                video.play();
                btn.innerHTML = "Pause";
            } else {
                video.pause();
                btn.innerHTML = "Play";
            }
        }
    </script>
    <div id="wrapper">

        <header id="header" class="site-header">
            <div class="container">
                <div class="site__brand">
                    <a title="Logo" href="{{route('home')}}" class="site__brand__logo"><img src="{{asset('assets/images/assets/logo.png')}}" alt="Golo"></a>
                </div><!-- .site__brand -->
            </div><!-- .container-fluid -->
        </header><!-- .site-header -->

        <main id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="cs-info">
                            <h1>Under Construction!</h1>
                            <p>To make somethings right we need some time to rebuild. Get notified when we are done.</p>
                            <form action="{{route('subscribe')}}" method="POST" class="site-banner__search cs-newletter">
                                @csrf
                                <div class="site-banner__search__field">
                                    <!-- .site-banner__search__icon -->
                                    <input class="site-banner__search__input" type="text" name="email" placeholder="Email address">
                                    <button type="submit" class="site-banner__search__icon" syle="border:none">
                                        <i class="las la-arrow-right"></i>
                                    </button>
                                </div><!-- .site-banner__search__input -->
                            </form><!-- .site-banner__search -->
                        </div><!-- .cs-info -->
                    </div>

                </div>
            </div>
        </main><!-- .site-main -->

        <footer id="footer" class="footer">
            <div class="container">
                <div class="footer-socials">
                    <ul>
                        <li>
                            <a title="Facebook" href="#">
                                <i class="lab la-facebook-square"></i>
                            </a>
                        </li>
                        <li>
                            <a title="Instagram" href="#">
                                <i class="la la-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a title="Twitter" href="#">
                                <i class="lab la-twitter-square"></i>
                            </a>
                        </li>
                        <li>
                            <a title="Youtube" href="#">
                                <i class="lab la-youtube-square"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div><!-- .container -->
        </footer><!-- site-footer -->
    </div><!-- #wrapper -->
</body>

@stop
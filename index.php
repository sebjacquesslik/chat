<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Chat Test Test</title>


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="./css/pygments-borland.css" />
    <link rel="stylesheet" href="./css/styles.css" />
    <link href="images/favicon.ico" rel="shortcut icon" />
</head>

<body class="home-page">


    <header id="top-content">
        <div class="header-title">

        </div>

        <div class="header-content">
            <div class="container text-center">
                <div class="row">

                </div>
                <div class="row">
                    <div class="span6 offset3">
                        <div id="firechat-container" class="clearfix"></div>
                        <div id="user-info">
                            Logged in as <span id="user-name">.</span>
                            <a href="javascript:logout();">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
    </header>


    <div class="container" id="bottom-container">

        <div class="row">



            <div id="auth-modal" class="modal hide fade" tabindex="-1" role="dialog">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 id="myModalLabel">Authenticate to continue</h4>
                </div>
                <div class="modal-body text-center">
                    <p>
                        <a id="twitter-signin" href="javascript:login('twitter');">
                            <img id="twitter-signin-btn" src="images/sign-in-with-twitter.png">
                        </a>
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal">Cancel</button>
                </div>
            </div>

            <!-- Firechat -->
            <script src="https://cdn.firebase.com/js/client/2.0.2/firebase.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap-modal.min.js"></script>

            <!-- Download from https://github.com/firebase/Firechat -->
            <link rel="stylesheet" href="firechat/2.0.0/firechat-default.css" />
            <script src="firechat/2.0.0/firechat-default.js"></script>
            <script>
                var chatRef = new Firebase('https://charterhallchat.firebaseio.com'),
                    target = document.getElementById("firechat-container"),
                    authModal = $('#auth-modal').modal({
                        show: false
                    }),
                    chat = new FirechatUI(chatRef, target);

                chat.on('auth-required', function () {
                    authModal.modal('show');
                    return false;
                });

                chatRef.onAuth(function (authData) {
                    if (authData) {
                        var userId = authData.uid,
                            username = authData[authData.provider].displayName;

                        chat.setUser(userId, username);
                        $('#user-name').text(username);
                        $('#user-info').show();
                        setTimeout(function () {
                            chat._chat.enterRoom('-Iy1N3xs4kN8iALHV0QA')
                        }, 500);
                    } else {
                        $('#user-info').hide();
                        chat._chat.enterRoom('-Iy1N3xs4kN8iALHV0QA')
                    }
                });

                function login(provider) {
                    authModal.modal('hide');
                    chatRef.authWithOAuthPopup(provider, function (error, authData) {
                        if (error) {
                            console.log(error);
                        }
                    });
                }

                function logout() {
                    chatRef.unauth();
                    location.reload();
                }
            </script>

            <!-- Twitter / Facebook / Google -->
            <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
            <div id="fb-root"></div>
            <script>
                // If loaded on GitHub pages, redirect to Firebase-hosted version.
                if (window.location.host === 'firebase.github.io') {
                    window.location = window.location.href.replace('firebase.github.io/firechat', 'firechat.firebaseapp.com')
                }

                (function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));

                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-37102688-1']);
                _gaq.push(['_trackPageview']);

                (function () {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();
                
                
            </script>
</body>

</html>

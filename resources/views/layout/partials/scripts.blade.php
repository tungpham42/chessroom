<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js" integrity="sha256-U1mGlmAJ9EtQbmI39+qR12ar8kk5Zm2zskTIUmwCS88=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blockadblock/3.2.1/blockadblock.min.js" integrity="sha256-3zU5Lr4nIt3K/BgGOQMduajtZcPV9elIM/23RDXRp3o=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha256-tSRROoGfGWTveRpDHFiWVz+UXt+xKNe90wwGn25lpw8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" integrity="sha256-0rguYS0qgS6L4qVzANq4kjxPLtvnp5nn2nB5G1lWRv4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" integrity="sha256-sfG8c9ILUB8EXQ5muswfjZsKICbRIJUG/kBogvvV5sY=" crossorigin="anonymous"></script>
<script src="{{ URL::to('/') }}/js/scripts.js"></script>
<script src="{{ URL::to('/') }}/js/manipulation.js"></script>
<script src="{{ URL::to('/') }}/js/chessboard.js?v=1"></script>
<script src="{{ URL::to('/') }}/js/chess.js?v=3"></script>
<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$('#create-room').on('click', function() {
  bootbox.prompt({
    title: "Please create a password for your new Room:",
    required: true,
    centerVertical: true,
    callback: function(password){
      $.ajax({
        type: "POST",
        url: '/createRoom',
        data: {
          'room-code': $('#create-room').attr('data-room'),
          'FEN': 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
          'pass': password
        },
        dataType: 'text'
      }).done(function() {
        window.location.href = $('#create-room').attr('data-url');
      });
    }
  });
});
$('#url-white, #url-black').on('click', function() {
  copyToClipboard('#url');
  selectText('#url')
});
const nuocCo = document.getElementById("nuoc-co");
const hetTran = document.getElementById("het-tran");

$(function () {
  $('.dropdown-toggle').dropdown();
  if (!Modernizr.touch) {
    $('[data-toggle="tooltip"]').tooltip();
    document.addEventListener('contextmenu', function(e) {
      e.preventDefault();
    });
  }
});

var is_iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
if (is_iOS) {
  document.addEventListener('touchstart touchend touchcancel touchmove', event => {
    event.preventDefault();
  }, {passive: false});
}
window.onload = () => {
  'use strict';
  if ('serviceWorker' in navigator) {
    console.log("Will the service worker register?");
    navigator.serviceWorker
    .register('{{ URL::to('/') }}/serviceWorker.js')
    .then(function(reg) {
      console.log("Yes, it did.");
    }).catch(function(err) {
      console.log("No it didn't. This happened:", err)
    });
  }
}
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e73268767defa7b"></script>
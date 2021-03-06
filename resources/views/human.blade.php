@extends('layout.gamelayout')
@section('aboveContent')
<h3 class="text-center my-2">Playing with friend</h3>
@endsection
@section('belowContent')
<p class="w-100 text-center mt-4">
  <a class="w-25 btn btn-dark btn-lg" href="{{ url('/') }}"><i class="fad fa-desktop"></i> Play with AI</a>
  <a id="reset" class="w-25 btn btn-light btn-lg"><i class="fad fa-redo-alt"></i> Restart</a>
</p>
<script>
let board = null;
let game = new Chess();

var whiteSquareGrey = '#a9a9a9'
var blackSquareGrey = '#696969'

function removeGreySquares () {
  $('#chess-board .square-55d63').css('background', '')
}

function greySquare (square) {
  var $square = $('#chess-board .square-' + square)

  var background = whiteSquareGrey
  if ($square.hasClass('black-3c85d')) {
    background = blackSquareGrey
  }

  $square.css('background', background)
}

function onDragStart (source, piece, position, orientation) {
  // do not pick up pieces if the game is over
  if (game.game_over()) return false

  // only pick up pieces for the side to move
  if ((game.turn() === 'w' && piece.search(/^b/) !== -1) ||
      (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
    return false
  }
}

function onDrop (source, target) {
  removeGreySquares();

  // see if the move is legal
  let move = game.move({
    from: source,
    to: target,
    promotion: 'q'
  });

  // illegal move
  if (move === null) return 'snapback';
  updateStatus()
}

function onMouseoverSquare (square, piece) {
  // get list of possible moves for this square
  let moves = game.moves({
    square: square,
    verbose: true
  });

  // exit if there are no moves available for this square
  if (moves.length === 0) return;

  // highlight the square they moused over
  greySquare(square);

  // highlight the possible squares for this piece
  for (let i = 0; i < moves.length; i++) {
    greySquare(moves[i].to);
  }
}

function onMouseoutSquare (square, piece) {
  removeGreySquares();
}

function onSnapEnd () {
  board.position(game.fen());
  $('#FEN').val(game.fen());
  nuocCo.play();
  if (game.game_over()) {
    hetTran.play();
    $('#game-over').removeClass('d-none').addClass('d-inline-block');
  }
}

function updateStatus () {
  var status = ''

  var moveColor = 'White'
  if (game.turn() === 'b') {
    moveColor = 'Black'
  }

  // checkmate?
  if (game.in_checkmate()) {
    status = moveColor + ' is in checkmate'
  }

  // draw?
  else if (game.in_draw()) {
    status = 'Drawn position'
  }

  // game still on
  else {
    status = moveColor + "'s turn to move"

    // check?
    if (game.in_check()) {
      status += ', ' + moveColor + ' is in check'
    }
  }

  $('#game-status').html(status);
  $('#header-status').html(': '+status);
  if (game.game_over()) {
    $('#header-status').html(': '+status+' - Game over');
  }
}

let config = {
  draggable: true,
  position: 'start',
  onDragStart: onDragStart,
  onDrop: onDrop,
  onMouseoutSquare: onMouseoutSquare,
  onMouseoverSquare: onMouseoverSquare,
  onSnapEnd: onSnapEnd,
  showNotation: false
  //pieceTheme: '/static/img/xiangqipieces/traditional/{piece}.svg'
};
board = Chessboard('chess-board', config)

updateStatus();
$('#reset').on('click', function() {
  board.position('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR');
  game.load('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1');
  updateStatus();
  $('#game-over').removeClass('d-inline-block').addClass('d-none');
});
</script>
@endsection

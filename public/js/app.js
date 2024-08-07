document.addEventListener('DOMContentLoaded', function() {

    console.info('DOM loaded');

    // call /api/game
    fetch('/api/game')
        .then(response => response.json())
        .then(data => {
            game = data;

            initgame(game);
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

function initgame(tiles) {
    console.info('initgame');

    // create game board
    const board = document.querySelector('#board');

    console.log(tiles)
    tiles.forEach(tile => {
        const div = document.createElement('div');
        div.classList.add('tile');

        // set position
        div.style.setProperty('--row', tile.row);
        div.style.setProperty('--column', tile.column);

        // set tile type
        if (tile.isMine) {
            div.setAttribute('data-value', '💣')
        } else {
            div.setAttribute('data-value', tile.neighbouringMines > 0 ? tile.neighbouringMines : '');
        }

        div.addEventListener('click', function(e) {
            console.log('click', e.target);

            if (e.target.classList.contains('tile--flagged')) {
                console.log('tile is flagged')
                return;
            }

            const tile = e.target;
            tile.classList.add('tile--revealed');

            if (tile.getAttribute('data-value') === '') {
                revealAdjacentTiles(tile, true);
            }

            if (tile.getAttribute('data-value') === '💣') {
                revealMines();
                alert('Game over!');
            }

            // check if all non-mine tiles are revealed
            const tiles = document.querySelectorAll('.tile');
            const nonMineTiles = Array.from(tiles).filter(tile => tile.getAttribute('data-value') !== '💣');
            const revealedTiles = Array.from(tiles).filter(tile => tile.classList.contains('tile--revealed'));

            if (nonMineTiles.length === revealedTiles.length) {
                alert('You won!');
            }
        });

        div.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            console.log('contextmenu', e.target);

            const tile = e.target;
            tile.classList.toggle('tile--flagged');


            if (tile.classList.contains('tile--flagged')) {
                const originalValue = tile.getAttribute('data-value');
                tile.setAttribute('data-originalValue', originalValue)
                tile.setAttribute('data-value', '🚩')
            } else {
                const originalValue = tile.getAttribute('data-originalValue');
                tile.removeAttribute('data-originalValue')
                tile.setAttribute('data-value', originalValue)
            }
        });

        board.appendChild(div);
    });
}

function revealMines() {
    const tiles = document.querySelectorAll('.tile');

    tiles.forEach(tile => {
        // if (tile.getAttribute('data-value') === '💣') {
        if ([
            tile.getAttribute('data-value'),
            tile.getAttribute('data-originalValue')
        ].includes('💣')) {
            tile.classList.add('tile--revealed');
            tile.setAttribute('data-value', '💣');
        }
    });
}

function revealAdjacentTiles(tile, sourceTile) {
    const row = tile.style.getPropertyValue('--row');
    const column = tile.style.getPropertyValue('--column');

    const tiles = document.querySelectorAll('.tile');

    tiles.forEach(tile => {
        const tileRow = tile.style.getPropertyValue('--row');
        const tileColumn = tile.style.getPropertyValue('--column');

        if (tileRow === row && tileColumn === column) {
            return;
        }

        // return if revealed
        if (tile.classList.contains('tile--revealed')) {
            return;
        }

        // return if not adjacent (left, top, right, bottom), and not diagonal
        const isAdjacent = Math.abs(tileRow - row) <= 1 && Math.abs(tileColumn - column) <= 1;
        const isDiagonal = Math.abs(tileRow - row) === 1 && Math.abs(tileColumn - column) === 1;
        if (!isAdjacent && isDiagonal) {
            return;
        }


        if (isAdjacent) {
            if (['🚩','💣'].includes(tile.getAttribute('data-value'))) {
                return;
            }

            tile.classList.add('tile--revealed');

            if (tile.getAttribute('data-value') === '') {
                revealAdjacentTiles(tile, false);
            }

        }
    });
}

function range(size, startAt = 0) {
    return [...Array(size).keys()].map(i => i + startAt);
}
export class UI {
    constructor(game) {
        this.game = game;
        this.fontSize = 40;
        this.fontFamily = 'Courier New';
    }
    draw(context) {
        context.font = this.fontSize + 'px ' + this.fontFamily;
        context.textAlign = 'left';
        context.fillStyle = this.game.fontColor;
        //score text
        context.fillText('Score: ' + this.game.score, 20, 40);
        //number of players who generated same number string
        context.font = this.fontSize * 0.75 + 'px ' + this.fontFamily;
        context.fillText('Number string generated ' + window.TIMESGENNED + ' times', 20, 70);  //placeholder is where actual # will go
        //timer text (not working, dt is wonky :/)
        // context.font = this.fontSize * 0.9 + 'px ' + this.fontFamily;
        // context.fillText('Time: ' + (this.game.gameTimer/1000).toFixed(1), 20, 90);
        //game over message
        if (this.game.gameOver) {
            context.textAlign = 'center';
            context.font = this.fontSize * 3 + 'px ' + this.fontFamily;
            context.fillText('GAME OVER', this.game.width/2, this.game.height/2 - 40);
            context.font = this.fontSize + 'px ' + this.fontFamily;
            context.fillText('Press Space to restart game', this.game.width/2, this.game.height/2);
        }

        //pause screen text
        if (this.game.pause) {
            context.textAlign = 'center';
            context.font = this.fontSize * 3 + 'px ' + this.fontFamily;
            context.fillText('PAUSED', this.game.width/2, this.game.height/2 - 40);
            context.font = this.fontSize + 'px ' + this.fontFamily;
            context.fillText('Press Space to resume', this.game.width/2, this.game.height/2);

        }
    }
}
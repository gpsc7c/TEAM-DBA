class Particle {
    constructor(game) {
        this.game = game;
        this.offScreen = false; //when too small to be visible, erase
    }
    update() {
        this.x -= this.speedX + this.game.speed;
        this.y -= this.speedY;
        this.size *= 0.95;
        if (this.size < 0.5)    //when size becomes smaller than half a pixel, remove from screen
            this.offScreen = true;
    }
}

export class Dust extends Particle {
    constructor(game, x, y) {
        super(game);
        this.size = Math.random() * 10 + 7;  //generate particle size between 5 to 10 px
        this.x = x;
        this.y = y;
        this.speedX = Math.random();    //x and y movement speeds random number between 0 to 1
        this.speedY = Math.random();
        this.color = 'rgba(230, 230, 230, 0.2)';
    }
    draw(context) {
        //draw a square with width/height of size
        context.fillStyle = this.color;
        context.fillRect(this.x, this.y, this.size, this.size);
    }
}

export class Burst extends Particle {
    constructor(game, x, y) {
        super(game);
        this.size = Math.random() * 20 + 7;  //generate particle size between 5 to 10 px
        this.x = x;
        this.y = y;
        this.speedX = Math.random();    //x and y movement speeds random number between 0 to 1
        this.speedY = Math.random();
        this.color = 'rgba(230, 230, 230, 0.2)';
    }
    draw(context) {
        //draw a square with width/height of size
        context.fillStyle = this.color;
        context.fillRect(this.x, this.y, this.size, this.size);
    }
}
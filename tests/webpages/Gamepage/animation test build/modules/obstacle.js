class Obstacle {
    constructor() {
        //properties that may be needed if objects are animated
        //this.animFrame = 0    //animate obstacle/enemy sprite
        //measures for calculating delta time
        this.fps = 10;
        this.animInterval = 1000/this.fps;
        this.frameTimer = 0;
        this.offScreen = false;
    }
    update(dt) {
        this.speedX = this.game.speed;
        this.x -= this.speedX;
        this.y += this.speedY;
        //same handler as player for movement/animation fps
        if (this.frameTimer > this.animInterval) {
            this.frameTimer = 0;
            /*if(this.animFrame < this.maxFrame)
                this.animFrame++;
                else
                    this.animFrame = 0; */
        }
        else {
            this.frameTimer += dt;
        }
        //check if obstacle has moved off screen to the left
        if (this.x + this.width < 0) {
            this.offScreen = true;  //obstacle is off screen and can be deleted
            this.game.score++; //test UI text; score increases when object moves offscreen
        }
    }
    draw(context) {
        //draw obstacle hitbox when test mode active
        if (this.game.testMode == true) {
            context.strokeRect(this.x, this.y, this.width, this.height);
        }
        context.fillStyle = 'red';
        //context.fillRect(this.x, this.y, this.width, this.height);
        //context.drawImage(this.image, this.x, this.y)
    }
}

export class JumpObstacle extends Obstacle {
    constructor(game) {
        super();
        this.game = game;
        this.type = "Jump";
        this.width = 64; //will need to be updated based on final sprite size
        this.height = 64;
        this.x = this.game.width;
        this.y = this.game.height - this.height - this.game.groundHeight - 10;
        this.image = document.getElementById("jumpObs");
        this.speedX = 0;
        this.speedY = 0;
        //this.maxFrame = 0; //in case this obstacle is animated
    }
    draw(context) {
        super.draw(context);
        //context.fillStyle = 'red';
        context.drawImage(this.image, this.x, this.y);
    }
}

export class AttackObstacle extends Obstacle {
    constructor(game) {
        super();
        this.game = game;
        this.type = "Attack";
        this.width = 62;
        this.height = 130;
        this.x = this.game.width;
        this.y = this.game.height - this.height - this.game.groundHeight - 10;
        this.image = document.getElementById("attackObs");
        this.speedX = 0;
        this.speedY = 0;
        //this.maxFrame = 0;    //in case this obstacle is animated
    }
    draw(context) {
        super.draw(context);
        //context.fillStyle = 'green';
        //context.fillRect(this.x, this.y, this.width, this.height);
        context.drawImage(this.image, this.x, this.y);
    }
}

export class DuckObstacle extends Obstacle {
    constructor(game) {
        super();
        this.game = game;
        this.type = "Duck";
        this.width = 64; //will be based on whatever sprite size is (hitbox will be separate)
        this.height = 64;
        this.x = this.game.width; //will need to start off screen
        this.y = this.game.height - 220; //since player MUST duck this obstacle, should be about the height of standing sprite but too tall to jump over
        this.speedX = 0; //speed of movement on x-axis
        this.speedY = 0; //speed of movement on y-axis (maybe not needed unless we're doing some sine wave type movement or something)
        //this.maxFrame; //sets up total number of frames on obstacle's spritesheet
        this.image = document.getElementById("duckObs");
    }
    update(dt) {
        super.update(dt); //call parent class update method
        //any extra behaviors for this particular child class can be called here
    }
    draw(context) {
        super.draw(context);
        //context.fillStyle = 'blue';
        //context.fillRect(this.x, this.y, this.width, this.height);
        context.drawImage(this.image, this.x, this.y);
    }
}
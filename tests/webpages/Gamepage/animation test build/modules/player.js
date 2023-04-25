 import { Running, Jumping, Falling, Ducking } from './states.js';

 //class for functions relating to player
 export class Player {
    //updated constructor method?
    constructor(game) {
        this.game = game;
        this.width = 96; //width and height based on pixel sheet; base size is 32x32 but can be scaled up in aseprite
        this.height = 96;
        this.ground = this.game.height - this.height - this.game.groundHeight; //variable to store "ground" plane that player will stand on
        this.x = 100; //screen position x
        this.y = this.ground; //sets current y to ground
        //hitbox variables
        this.hitWidth = this.width * 0.3;
        this.hitHeight = this.height * 0.6;
        this.hitX = this.x + this.hitWidth;
        this.hitY = this.y + 30;
        this.duckYOffset = 20;
        this.jumpYOffset = -5;
        this.velY = 0; //velocity for jump
        this.gravity = 1.1; //counterbalance to velY variable; will allow character to fall after reaching peak of jump
        //add in spritesheet info here
        this.stateImage = "Stationary";
        this.animFrame = 0; //tracks current frame in sprite animation
        //this.image = document.getElementById("dino" + this.stateImage + this.animFrame);
        this.maxFrame; //tracks total number of frames in each animation
        this.fps = 10;
        this.animInterval = 1000/this.fps;
        this.frameTimer = 0;
        //this.image = document.getElementById("dinoStationary0");
        //state management
        this.states = [new Running(this), new Jumping(this), new Falling(this), new Ducking(this)];
        this.currentState = this.states[0];
        this.currentState.enter();
        console.log(this.ground);
    }
    //draw method for player sprite
    draw(context) {
        //draw hitbox when debug mode is on
        if (this.game.testMode == true) {
            context.strokeRect(this.hitX, this.hitY, this.hitWidth, this.hitHeight);
        }
        this.image = document.getElementById("base" + this.stateImage + this.animFrame);
        //console.log(this.image);
        context.drawImage(this.image, this.x, this.y);
    }
    update(input, dt) {
        //check for collisions
        this.checkCollision();
        //call handleInput function in state manager
        this.currentState.handleInput(input);
        //updating player actions based on received input
        this.y += this.velY; //update player y position based on velY variable
        this.hitY += this.velY; //update hitbox y pos
        if (!this.grounded())
            this.velY += this.gravity; //adds gravity to velY to make player fall after jumping
        else {
            this.velY = 0; //should prevent player from falling past ground plane
            this.y = this.ground;
        }
        //fps management
        if (this.frameTimer > this.animInterval) {
            this.frameTimer = 0;
            //change animation frame number
            if (this.animFrame < this.maxFrame) {
                this.animFrame++;
                //this.image = document.getElementById("dino" + this.stateImage + this.animFrame);
            }
            else {
                this.animFrame = 0;
                //this.image = document.getElementById("dino" + this.stateImage + this.animFrame);
            }
        }
        else {
            this.frameTimer += dt;
        }
        //change image based on state
        //this.image = document.getElementById("dino" + this.stateImage + this.animFrame);
    }
    grounded() {
        //will return true or false; true if player is on ground, false if player is not on ground
        return this.y >= this.ground;
    }
    //switch between player states
    setState(state) {
        //set current state
        this.currentState = this.states[state];
        //call enter method for passed state
        this.currentState.enter();
    }
    checkCollision() {
        this.game.obstacles.forEach(obstacle => {
            //STANDING COLLISION CHECK
            if (
                obstacle.x < this.hitX + this.hitWidth &&
                obstacle.x + obstacle.width > this.hitX &&
                obstacle.y < this.hitY + this.hitHeight &&
                obstacle.y + obstacle.height > this.hitY
            ) {
                obstacle.offScreen = true; //remove obstacle on collision?
                //play a death animation and then game over probably
            }
            //DUCKING COLLISION CHECK
            // if (

            // ) {

            // }
        });
    }
}
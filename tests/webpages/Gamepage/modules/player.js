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
        this.velY = 0; //velocity for jump
        this.gravity = 0.8; //counterbalance to velY variable; will allow character to fall after reaching peak of jump
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
        //context.fillStyle = 'red';
        //context.fillRect(this.x, this.y, this.width, this.height);
        this.image = document.getElementById("base" + this.stateImage + this.animFrame);
        //console.log(this.image);
        context.drawImage(this.image, this.x, this.y);
    }
    update(input, dt) {
        //call handleInput function in state manager
        this.currentState.handleInput(input);
        //updating player actions based on received input
        this.y += this.velY; //update player y position based on velY variable
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
}
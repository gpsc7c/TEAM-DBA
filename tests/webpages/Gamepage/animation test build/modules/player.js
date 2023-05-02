 import { Running, Jumping, Falling, Ducking, Attacking, Lose } from './states.js';

 //class for functions relating to player
 export class Player {
    //updated constructor method?
    constructor(game, character) {
        this.game = game;
        this.width = 128; //width and height based on pixel sheet; base size is 32x32 but can be scaled up in aseprite
        this.height = 128;
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
        this.character = character;
        this.stateImage = "Static";
        this.animFrame = 0; //tracks current frame in sprite animation
        //this.image = document.getElementById("dino" + this.stateImage + this.animFrame);
        this.maxFrame; //tracks total number of frames in each animation
        this.fps = 10;
        this.animInterval = 1000/this.fps;
        this.frameTimer = 0;
        this.attackTimer = 0;   //timer for how long attack action is active
        this.loseTimer = 0;     //timer for lose animation, will be replaced later with just frame management from lose state
        this.dead = false;
        //this.image = document.getElementById("dinoStationary0");
        //state management
        this.states = [new Running(this.game), new Jumping(this.game), new Falling(this.game), new Ducking(this.game), new Attacking(this.game), new Lose(this.game)];
        //console.log(this.ground);
    }
    //draw method for player sprite
    draw(context) {
        //draw hitbox when debug mode is on
        if (this.game.testMode == true) {
            context.strokeRect(this.hitX, this.hitY, this.hitWidth, this.hitHeight);
        }
        this.image = document.getElementById(this.character + this.stateImage + this.animFrame);
        //console.log(this.image);
        context.drawImage(this.image, this.x, this.y);
    }
    update(input, dt) {
        if (!this.dead)
            this.game.gameTimer += dt;
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
            }
            else {
                this.animFrame = 0;
            }
        }
        else {
            this.frameTimer += dt;
        }

        //attack timer
        if (this.currentState === this.states[4] && this.attackTimer > 0) { //if player is in attacking state and attack timer is not at zero
            this.attackTimer -= dt;
        }
        if (this.currentState === this.states[5] && this.loseTimer > 0) //replace later with frame management from states
            this.loseTimer -= dt;
    }
    grounded() {
        //will return true or false; true if player is on ground, false if player is not on ground
        return this.y >= this.ground;
    }
    //switch between player states
    setState(state, speed) {
        //set current state
        this.currentState = this.states[state];
        //set game speed for current state (slightly faster during attack, normal during run)
        this.game.speed = this.game.maxSpeed * speed;
        //call enter method for passed state
        this.currentState.enter();
    }
    checkCollision() {
        this.game.obstacles.forEach(obstacle => {
            //STANDING COLLISION CHECK
            if ( //checks for collision between player hitbox and obstacle (may need refactoring for obstacle hitbox later)
                obstacle.x < this.hitX + this.hitWidth &&
                obstacle.x + obstacle.width > this.hitX &&
                obstacle.y < this.hitY + this.hitHeight &&
                obstacle.y + obstacle.height > this.hitY
            ) {
                //obstacle.offScreen = true; //always remove obstacle on collision? may change that later
                //if player is in attacking state and object is a wall, destroy obstacle
                if (this.currentState === this.states[4] && obstacle.type === "Attack") {
                    obstacle.offScreen = true;  //destroy obstacle
                    this.game.score++;
                }
                else {
                    obstacle.offScreen = true;
                    this.setState(5, 0);
                }

            }
        });
    }
    reset() {
        this.y = this.ground;   //reset so player starts out on the ground again
        this.hitY = this.y + 30;    //reset player hitbox position
        this.dead = false;
        this.setState(0, 1);
    }
}
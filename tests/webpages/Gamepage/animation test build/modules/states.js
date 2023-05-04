import { Dust, Burst } from './effects.js';

//enum to track player states for readability and better control of spritesheet animation
const playerStates = {
    // STILL: 0,
    RUNNING: 0,
    JUMPING: 1,
    FALLING: 2,
    DUCKING: 3,
    ATTACKING: 4, 
    LOSE: 5,
    RESTART: 6
}

class State {
    constructor(state, game) {
        this.state = state;
        this.game = game;
    }
}

// export class Still extends State {
//     constructor(player) {
//         super('STILL');
//         this.player = player
//     }
//     enter() {
//         this.player.stateImage = "Stationary";
//         this.player.animFrame = 0;
//         this.player.maxFrame = 0;
//         this.player.image = document.getElementById("dino" + this.player.stateImage + this.player.animFrame);
//     }
//     handleInput(input) {
//         if (input.includes(window.JUMP) || input.includes(window.DUCK) || input.includes(window.ATTACK)) {
//             this.player.setState(playerStates.RUNNING);
//         }
//     }
// }

export class Running extends State {
    constructor(game) {
        //call constructor for parent class State
        super('RUNNING', game);
    }
    enter() {
        this.game.player.stateImage = "Run"
        this.game.player.animFrame = 0;
        this.game.player.maxFrame = 3;
        this.game.player.image = document.getElementById(this.game.player.character + this.game.player.stateImage + this.game.player.animFrame);
        //reset hitbox radius
        this.game.player.hitY = this.game.player.y + 30;
    }
    handleInput(input) {
        //add dust particles while player is running
        this.game.particles.unshift(new Dust(this.game, this.game.player.x + this.game.player.width/2 - 15, this.game.player.y + this.game.player.height - 20));

        if (input.includes(window.JUMP)) {
            this.game.player.setState(playerStates.JUMPING, 1);
        }
        else if (input.includes(window.DUCK)) {
            this.game.player.setState(playerStates.DUCKING, 1);
        }
        else if (input.includes(window.ATTACK)) {
            this.game.player.setState(playerStates.ATTACKING, 1.6);
        }
    }
}

export class Jumping extends State {
    constructor(game) {
        //call constructor for parent class State
        super('JUMPING', game);
    }
    enter() {
        //will need to change jump image later
        if (this.game.player.grounded())
            this.game.player.velY -= 23;
        this.game.player.stateImage = "Jump"
        this.game.player.animFrame = 0;
        this.game.player.maxFrame = 0;
        this.game.player.image = document.getElementById(this.game.player.character + this.game.player.stateImage + this.game.player.animFrame);
        //move hitbox up just a bit
        this.game.player.hitY = this.game.player.hitY + this.game.player.jumpYOffset;
    }
    handleInput(input) {
        //logic for handling falling animation
        if (this.game.player.velY > this.game.player.gravity) { //once player hits peak of jump and starts to fall, switches to falling state
            this.game.player.setState(playerStates.FALLING, 1);
        }
    }
}

export class Falling extends State {
    constructor(game) {
        //call constructor for parent class State
        super('FALLING', game);
    }
    enter() {
        //will need to change fall image later
        this.game.player.stateImage = "Fall"
        this.game.player.animFrame = 0;
        this.game.player.maxFrame = 0;
        this.image = document.getElementById(this.game.player.character + this.stateImage + this.animFrame);
    }
    handleInput(input) {
        //logic for handling falling animation
        if (this.game.player.grounded()) { //changes state once player is on ground again
            this.game.player.setState(playerStates.RUNNING, 1);
        }
    }
}

//NOTE: seeing some odd -y offset with ducking state; test with character base sprites to see if y-offset issue
//persists and if adjustment needs to be made with some kind of +y offset in enter method
export class Ducking extends State {
    constructor(game) {
        //call constructor for parent class State
        super('DUCKING', game);
    }
    enter() {
        this.game.player.stateImage = "Duck"
        this.game.player.animFrame = 0;
        this.game.player.maxFrame = 3;
        this.game.player.image = document.getElementById(this.game.player.character + this.game.player.stateImage + this.game.player.animFrame);
        //change hitbox y coordinate on entering ducking state
        this.game.player.hitY = this.game.player.hitY + this.game.player.duckYOffset;
    }
    handleInput(input) {
        //add dust particles while player is running
        this.game.particles.unshift(new Dust(this.game, this.game.player.x + this.game.player.width/2 - 15, this.game.player.y + this.game.player.height - 20));

        if (!input.includes(window.DUCK)) {
            this.game.player.setState(playerStates.RUNNING, 1);
        }
        // else if (input.includes(window.JUMP)) {
        //     this.game.player.setState(playerStates.JUMPING);
        // }
    }
}

export class Attacking extends State {
    constructor(game) {
        //call constructor for parent class State
        super('ATTACKING', game);
    }
    enter() { //attacking can be entered from running only for the time being
        this.game.player.stateImage = "Attack"
        this.game.player.animFrame = 0;
        this.game.player.maxFrame = 0;
        this.game.player.image = document.getElementById(this.game.player.character + this.game.player.stateImage + this.game.player.animFrame);
        //maybe an attack timer of some sort? attack frame plays for x frames then stops?
        this.game.player.attackTimer = 500; //set attack timer to 0.5 second
    }
    handleInput(input) {
        //add dust particles while player is running
        this.game.particles.unshift(new Burst(this.game, this.game.player.x + this.game.player.width/2 - 15, this.game.player.y + this.game.player.height - 25));

        if (this.game.player.attackTimer <= 0) { //when attack timer expires, switch back to running state
            this.game.player.setState(playerStates.RUNNING, 1);
        }
    }
}

export class Lose extends State {
    constructor(game) {
        //call constructor for parent class State
        super('LOSE', game);
    }
    enter() {   
        //GAME OVER STATE IS TRIGGERED HERE; THIS IS PROBABLY BEST PLACE TO OUTPUT SCORE TO DATABASE
        this.game.player.stateImage = "Hurt"
        this.game.player.animFrame = 0;
        this.game.player.maxFrame = 0;
        this.image = document.getElementById(this.game.player.character + this.stateImage + this.animFrame);
        this.game.player.dead = true;
        this.game.player.loseTimer = 500;
    }
    handleInput(input) {
        //pause for a moment before displaying game over screen
        if (this.game.player.loseTimer <= 0) {
            this.game.gameOver = true;
        }
    }
}
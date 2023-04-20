//enum to track player states for readability and better control of spritesheet animation
const playerStates = {
    // STILL: 0,
    RUNNING: 0,
    JUMPING: 1,
    FALLING: 2,
    DUCKING: 3,
    ATTACKING: 4
}

class State {
    constructor(state) {
        this.state = state;
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
    constructor(player) {
        //call constructor for parent class State
        super('RUNNING');
        this.player = player;
    }
    enter() {
        this.player.stateImage = "Run"
        this.player.animFrame = 0;
        this.player.maxFrame = 3;
        this.player.image = document.getElementById("base" + this.player.stateImage + this.player.animFrame);
    }
    handleInput(input) {
        if (input.includes(window.JUMP)) {
            this.player.setState(playerStates.JUMPING);
        }
        else if (input.includes(window.DUCK)) {
            this.player.setState(playerStates.DUCKING);
        }
    }
}

export class Jumping extends State {
    constructor(player) {
        //call constructor for parent class State
        super('JUMPING');
        this.player = player;
    }
    enter() {
        //will need to change jump image later
        if (this.player.grounded())
            this.player.velY -= 20;
        this.player.stateImage = "Jump"
        this.player.animFrame = 0;
        this.player.maxFrame = 0;
        this.player.image = document.getElementById("base" + this.player.stateImage + this.player.animFrame);
    }
    handleInput(input) {
        //logic for handling falling animation
        if (this.player.velY > this.player.gravity) { //once player hits peak of jump and starts to fall, switches to falling state
            this.player.setState(playerStates.FALLING);
        }
    }
}

export class Falling extends State {
    constructor(player) {
        //call constructor for parent class State
        super('FALLING');
        this.player = player;
    }
    enter() {
        //will need to change fall image later
        this.player.stateImage = "Fall"
        this.player.animFrame = 0;
        this.player.maxFrame = 0;
        this.image = document.getElementById("base" + this.stateImage + this.animFrame);
    }
    handleInput(input) {
        //logic for handling falling animation
        if (this.player.grounded()) { //changes state once player is on ground again
            this.player.setState(playerStates.RUNNING);
        }
    }
}

//NOTE: seeing some odd -y offset with ducking state; test with character base sprites to see if y-offset issue
//persists and if adjustment needs to be made with some kind of +y offset in enter method
export class Ducking extends State {
    constructor(player) {
        //call constructor for parent class State
        super('DUCKING');
        this.player = player;
    }
    enter() {
        this.player.stateImage = "Duck"
        this.player.animFrame = 0;
        this.player.maxFrame = 3;
        this.player.image = document.getElementById("base" + this.player.stateImage + this.player.animFrame);
    }
    handleInput(input) {
        if (!input.includes(window.DUCK)) {
            this.player.setState(playerStates.RUNNING);
        }
        // else if (input.includes(window.JUMP)) {
        //     this.player.setState(playerStates.JUMPING);
        // }
    }
}
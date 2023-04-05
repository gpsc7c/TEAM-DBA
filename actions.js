class Character {
    constructor(x, y, width, height) {
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
        this.isJumping = false;
        this.isDucking = false;
    }

    jump() {
        if (!this.isJumping && !this.isDucking) {
            // jump code here
        }
    }

    duck() {
        if (!this.isJumping && !this.isDucking) {
            this.isDucking = true;
            this.height = this.height / 2; // reduce the character's height to make it look like it's ducking
        }
    }

    standUp() {
        this.isDucking = false;
        this.height = this.height * 2; // restore the character's original height
    }

    handleKeyDown(event) {
        if (event.code === 'Space') {
            this.jump();
        } else if (event.code === 'ArrowDown') {
            this.duck();
        }
    }

    handleKeyUp(event) {
        if (event.code === 'ArrowDown') {
            this.standUp();
        }
    }

    // other methods for drawing the character and handling collisions with other objects
}

const character = new Character(100, 200, 50, 100); // example width and height

document.addEventListener('keydown', (event) => {
    character.handleKeyDown(event);
});

document.addEventListener('keyup', (event) => {
    character.handleKeyUp(event);
});
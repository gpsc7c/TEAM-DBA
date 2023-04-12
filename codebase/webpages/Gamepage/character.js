class Character {
    constructor(x, y, width, height, maxHealth) {
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
        this.isJumping = false;
        this.jumpSpeed = 10; // The speed at which the character jumps
        this.jumpHeight = 100; // The maximum height of the character's jump
        this.jumpDuration = 20; // The number of frames the jump will take
        this.jumpFrames = 0; // The number of frames the character has been jumping
        this.jumpDirection = 1; // 1 means the character is going up, -1 means the character is going down
        this.isDucking = false;
        this.health = maxHealth;
    }



    jump() {
            if (!this.isJumping && !this.isDucking && !this.isAttacking) {
              this.isJumping = true;
              this.jumpFrames = 0;
              this.jumpDirection = 1;
            }     
    }

    update() {
        if (this.isJumping) {
          this.jumpFrames++;
    
          // Calculate the character's vertical position based on the current jump frame
          const yDelta = this.jumpSpeed * this.jumpDirection;
          const newY = this.y - yDelta;
    
          // If the character has reached the maximum jump height, start descending
          if (this.jumpFrames >= this.jumpDuration || newY <= this.jumpHeight) {
            this.jumpDirection = -1;
          }
    
          // If the character has landed, reset the jump state
          if (newY >= 200) {
            this.isJumping = false;
            this.jumpFrames = 0;
            this.jumpDirection = 1;
          }
    
          // Update the character's position
          this.y = newY;
        }
      }

    duck() {
        if (!this.isJumping && !this.isDucking && !this.isAttacking) {
            this.isDucking = true;
            this.height = this.height / 2; // reduce the character's height to make it look like it's ducking
        }
    }

    standUp() {
        this.isDucking = false;
        this.height = this.height * 2; // restore the character's original height
    }

    isTouching(obj) {
        return (
          this.x < obj.x + obj.width &&
          this.x + this.width > obj.x &&
          this.y < obj.y + obj.height &&
          this.y + this.height > obj.y
        );
      }

    attack(enemy) {
        if (!this.isJumping && !this.isDucking && !this.isAttacking) {
            this.isAttacking = true;
            // attack code here, for example:
            if (this.isTouching(enemy)) {
                enemy.takeDamage();
            }
           
        }
    }

    takeDamage() {
        if(this.isTouching(enemy))
        this.health -= 10; // Character loses 10 health points when hit by an enemy
        if (this.health <= 0) {
          this.die();
        }
      }

      die() {
        // Code to handle the character's death
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



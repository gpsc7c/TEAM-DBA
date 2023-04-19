class Enemy {
    constructor(x, y, width, height) {
      this.x = x;
      this.y = y;
      this.width = width;
      this.height = height;
      this.isAlive = true;
    }
  
    draw() {
      // Code to draw the enemy on the canvas
    }
  
    takeDamage() {
      this.isAlive = false;
      this.die();
    }
  
    die() {
      // Code to remove the enemy from the canvas and update the game state
    }
  }
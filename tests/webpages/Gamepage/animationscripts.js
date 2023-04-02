//waits for images to fully load before executing function
window.addEventListener("load", function() {
    //get canvas element
    const canvas = document.getElementById("canvas1");

    //canvas mode set to 2d
    const ctx = canvas.getContext("2d");

    //global speed variable
    let SPEED = 8;

    //manually setting canvas width and height for correct image scaling
    //please come back and adjust aspect ratios at some point :')
    const CANVAS_WIDTH = canvas.width = 960;
    const CANVAS_HEIGHT = canvas.height = 540;

    //input handler class here?
    /*class InputHandler {

    } */

    //class for functions relating to player
    class Player {
        constructor(cnvWidth, cnvHeight) {
            //save height and width of canvas as class properties
            this.cnvWidth = cnvWidth;
            this.cnvHeight = cnvHeight;
            //height and width of sprites
            this.width = 88;
            this.height = 94;
            //x and y position of character
            this.x = 0;
            this.y = this.cnvHeight - this.height-72;
            this.image = document.getElementById("dinoStationary");
        }
        //draw method for player sprite
        draw(context) {
            //context.fillStyle = 'black';
            //context.fillRect(this.x, this.y, this.width, this.height);
            context.drawImage(this.image, this.x, this.y);
        }
        /*update(input) {
            //will update player position based on input
            this.x++;
            //vertical movement

        }*/
    }

    //class for handling background scroll
    class Background {
        constructor(cnvWidth, cnvHeight) {
            //save canvas width and height as class properties
            this.cnvWidth = cnvWidth;
            this.cnvHeight = cnvHeight;
            //set bg image (will change later)
            this.image = document.getElementById("ground");
            //height and width of ground image
            this.width = 2399;
            this.height = 24;
            //set x and y position of ground image
            this.x = 0;
            //trying to leave some space to display a number string undereath player
            this.y = cnvHeight-(this.height*4);
            //speed of horizontal movement for bg
            this.speed = SPEED;
        }
        draw(context) {
            //draws image twice so that there's no gap when image loops
            context.drawImage(this.image, this.x, this.y, this.width, this.height);
            context.drawImage(this.image, this.x + this.width, this.y, this.width, this.height);
        }
        update() {
            //moves bg to left for scrolling
            this.x -= this.speed;
            //update position of bg to create endless bg
            if (this.x < 0 - this.width)
                this.x = 0;
        }

    }

    //class for input string scroll
    /*NOTE: anything that needs to be input or selected has to be done BEFORE first call to animate function*/
    class NumberString{
        constructor(cnvWidth, cnvHeight) {
            //saves canvas width and height as object properties
            this.cnvWidth = cnvWidth;
            this.cnvHeight = cnvHeight;
            //setting up strings for number scroll
            this.numPrefix = "0.";
            this.scrollNum = "";
            //setting up width properties for scrolling
            this.prefixWidth = 0;
            this.scrollWidth = 0;
            this.totalWidth = 0;
            //x and y position for number string obj
            this.x = 0;
            //accounting for ground height and a bit of extra space
            this.y = cnvHeight-20;
            //speed for number string scroll
            this.speed = SPEED;
            this.firstScroll;
            //get repeating number string; validate that it's within bounds
            let num = prompt("Please enter your repeating digits.\nMust be between 1-9 digits.");
            while (num.length < 1 || num.length > 9) {
                num = prompt("Please enter your repeating digits.\nMust be between 1-9 digits.");
            }
            //fill scrollNum to hopefully fill canvas
            while (this.scrollNum.length < 30) {
                this.scrollNum += num;
            }
            //console.log(this.scrollNum);
        }
        draw(context) {
            //set font properties
            context.font = "68px Courier New";
            //draw the text
            //context.fillText(this.numPrefix + this.scrollNum, this.x, this.y);
            //set width property to draw second (and maybe third?) scroll text element
            //this.prefixWidth = ctx.measureText(this.numPrefix).width;
            //this.scrollWidth = ctx.measureText(this.scrollNum).width;
            //this.totalWidth = this.prefixWidth + this.scrollWidth;
            //console.log(this.prefixWidth);
            //console.log(this.scrollWidth);
            //draw second text element at the end previous element
            context.fillText(this.scrollNum, this.x, this.y);
            this.scrollWidth = context.measureText(this.scrollNum).width;
            context.fillText(this.scrollNum, (this.x + this.scrollWidth), this.y);
            //context.fillText(this.scrollNum, (this.x + this.totalWidth + this.scrollWidth), this.y)
        }
        update() {
            //moving text to the left for scrolling
            this.x -= this.speed;
            //resets string for endless scroll
            if (this.x < 0 - this.scrollWidth) {
                this.x = 0;
            }
        }
    }

    //class for functions relating to obstacles


    //function for handling obstacles


    //function for UI text


    //class instances
    const player = new Player(CANVAS_WIDTH, CANVAS_HEIGHT);
    const ground = new Background(CANVAS_WIDTH, CANVAS_HEIGHT);
    const repDigits = new NumberString(CANVAS_WIDTH, CANVAS_HEIGHT, ctx);
    //draw ground element
    ground.draw(ctx);
    //draw player sprite
    player.draw(ctx);
    //draw repeating digits
    repDigits.draw(ctx);

    //animation function
    function animate() {
        //clear canvas at beginning of each animation loop
        ctx.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
        //draw ground element
        ground.draw(ctx);
        //update ground element position
        ground.update();
        //draw player sprite
        player.draw(ctx);
        //update player position
        //player.update();
        //draw repeating digits
        repDigits.draw(ctx);
        //update repeating digits for scroll
        repDigits.update();
        //call built in function for looping animation
        requestAnimationFrame(animate);
    }

    canvas.addEventListener("click", ()=> {
        animate();
    });
});
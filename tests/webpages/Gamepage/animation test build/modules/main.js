import { Player } from './player.js';
import { InputHandler } from './input.js';
import { Background, NumberString } from './background.js';

//waits for webpage to fully load before executing function
window.addEventListener("load", function() {
    //get HTML page elements
    const gameContainer = document.getElementById("canvas-container");
    const optContainer = this.document.getElementById("start-container");
    const canvas = document.getElementById("canvas1");
    const startBtn = document.getElementById("game-start");
    const inputBar = document.getElementById("user-num");
    const numMessage = document.getElementById("invalid-num");

    //canvas mode set to 2d
    const ctx = canvas.getContext("2d");

    // //global speed variable
    // let SPEED = 8;

    //manually setting canvas width and height for correct image scaling
    //please come back and adjust aspect ratios at some point :')
    const CANVAS_WIDTH = canvas.width = 960;
    const CANVAS_HEIGHT = canvas.height = 540;

    //input handler class here?
    /*class InputHandler {

    } */

    //class for handling background scroll
    // class Background {
    //     constructor(cnvWidth, cnvHeight) {
    //         //save canvas width and height as class properties
    //         this.cnvWidth = cnvWidth;
    //         this.cnvHeight = cnvHeight;
    //         //set bg image (will change later)
    //         this.image = document.getElementById("ground");
    //         //height and width of ground image
    //         this.width = 2399;
    //         this.height = 24;
    //         //set x and y position of ground image
    //         this.x = 0;
    //         //trying to leave some space to display a number string undereath player
    //         this.y = cnvHeight-(this.height*4);
    //         //speed of horizontal movement for bg
    //         this.speed = SPEED;
    //     }
    //     draw(context) {
    //         //draws image twice so that there's no gap when image loops
    //         context.drawImage(this.image, this.x, this.y, this.width, this.height);
    //         context.drawImage(this.image, this.x + this.width, this.y, this.width, this.height);
    //     }
    //     update() {
    //         //moves bg to left for scrolling
    //         this.x -= this.speed;
    //         //update position of bg to create endless bg
    //         if (this.x < 0 - this.width)
    //             this.x = 0;
    //     }

    // }

    //REFACTORING FOR BETTER ORGANIZATION
    //GAME CLASS: instantiates objects required for game to function
    class Game {
        constructor(width, height) {
            this.width = width;
            this.height = height;
            this.speed = 3;
            this.scroll;
            this.userNum = inputBar.value;
            this.bg = new Background(this);
            this.player = new Player(this);
            this.input = new InputHandler();
            //implement a pause options/menu later
            this.pause = false;
        }
        update(dt) {
            this.bg.update();
            this.player.update(this.input.keys, dt);
        }
        draw(context) {
            this.bg.draw(context);
            this.player.draw(context);
        }
    }

    //class for functions relating to obstacles


    //function for handling obstacles


    //function for UI text


    //class instances
    //const player = new Player(CANVAS_WIDTH, CANVAS_HEIGHT);
    // const ground = new Background(CANVAS_WIDTH, CANVAS_HEIGHT);
    // const repDigits = new NumberString(CANVAS_WIDTH, CANVAS_HEIGHT, ctx);
    // //draw ground element
    // ground.draw(ctx);
    // //draw player sprite
    // player.draw(ctx);
    // //draw repeating digits
    // repDigits.draw(ctx);

    // //animation function
    // function animate() {
    //     //clear canvas at beginning of each animation loop
    //     ctx.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
    //     //draw ground element
    //     ground.draw(ctx);
    //     //update ground element position
    //     ground.update();
    //     //draw player sprite
    //     player.draw(ctx);
    //     //update player position
    //     //player.update();
    //     //draw repeating digits
    //     repDigits.draw(ctx);
    //     //update repeating digits for scroll
    //     repDigits.update();
    //     //call built in function for looping animation
    //     requestAnimationFrame(animate);
    // }

    // canvas.addEventListener("click", ()=> {
    //     animate();
    // });
    const g = new Game(CANVAS_WIDTH, CANVAS_HEIGHT);
    //console.log(g);
    //value needed to calculate delta time for frame rate delta time for frame rate
    let prevTime = 0;

    function animate(newTime) {
        const dt = newTime - prevTime;
        prevTime = newTime;
        ctx.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
        g.update(dt);
        g.draw(ctx);
        requestAnimationFrame(animate);
    }

    //validate user input from button click
    startBtn.addEventListener("click", () => {
        if (inputBar.value < 1 || inputBar.value > 999999999 || inputBar.value == "") {
            //invalid input, reveals error messaging, will not allow game start
            numMessage.classList.remove("invisible");
            inputBar.classList.add("error");
        }
        else {
            //complete setup before hiding game start options and starting game
            g.scroll = new NumberString(g, inputBar.value, 1);
            numMessage.classList.add("invisible");
            inputBar.classList.remove("error");
            optContainer.classList.add("hide");
            gameContainer.classList.remove("hide");
            //put any and all prerequisites to game play BEFORE first call to animate() in an event listener (maybe also a start message)
            animate(0);
        }
        //console.log(inputBar.value);
    });


    
});
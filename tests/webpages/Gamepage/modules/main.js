import { Player } from './player.js';
import { InputHandler } from './input.js';
import { Background, NumberString } from './background.js';
import { JumpObstacle, DuckObstacle, AttackObstacle } from './obstacle.js';

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

    //REFACTORING FOR BETTER ORGANIZATION
    //GAME CLASS: instantiates objects required for game to function
    class Game {
        constructor(width, height) {
            this.width = width;
            this.height = height;
            this.speed = 3;
            this.groundHeight = 72; //height of ground that player/obstacles needs to stand on top of
            this.scroll;
            this.userNum = inputBar.value;
            this.bg = new Background(this);
            this.player = new Player(this);
            this.input = new InputHandler();
            //implement a pause options/menu later
            this.pause = false;
            this.obstacles = []; //array to hold existing game obstacles
            this.spawnTimer = 0; //when timer reaches value in interval, spawn new obstacle
            this.spawnInterval = 1000; //initialize time to new obstacle to one second (measure in ms)
        }
        update(dt) {
            //call bg update function
            this.bg.update();
            //call player update function
            this.player.update(this.input.keys, dt);
            //handle obstacle update here
            if (this.spawnTimer > this.spawnInterval) {
                this.addObstacle();
                this.spawnTimer = 0; //reset timer back to zero
                this.spawnInterval = Math.floor(Math.random() * (3000 - 1000 + 1)) + 1000; //randomize spawn interval to between 1-3s
            }
            else {
                this.spawnTimer += dt; //add delta time to spawn timer
            }
            this.obstacles.forEach(obstacle => {
                obstacle.update(dt);
            });
        }
        draw(context) {
            this.bg.draw(context);
            this.player.draw(context);
            this.obstacles.forEach(obstacle => {
                obstacle.draw(context);
                if (obstacle.offScreen) {
                    this.obstacles.splice(this.obstacles.indexOf(obstacle), 1); //splice method causes jittering in obstacles :/, research an alternative
                }
            });
        }
        addObstacle() {
            let getRandom = Math.random(); //gets a random value to determine type of object to spawn
            if (getRandom < 0.3) {
                this.obstacles.push(new JumpObstacle(this));
            }
            else if (getRandom >= 0.3 && getRandom < 0.6) {
                this.obstacles.push(new AttackObstacle(this));
            }
            else {
                this.obstacles.push(new DuckObstacle(this));
            }
            //console.log(this.obtacles);
        }
    }

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
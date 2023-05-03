import { Player } from './player.js';
import { InputHandler } from './input.js';
import { Background, NumberString } from './background.js';
import { JumpObstacle, DuckObstacle, AttackObstacle } from './obstacle.js';
import { UI } from './UI.js';


//waits for webpage to fully load before executing function
window.addEventListener("load", function() {
    //get HTML page elements
    const gameContainer = document.getElementById("canvas-container");
    const optContainer = this.document.getElementById("start-container");
    const canvas = document.getElementById("canvas1");
    const startBtn = document.getElementById("game-start");
    const inputBar = document.getElementById("user-num");
    const numMessage = document.getElementById("invalid-num");
    const charMessage = this.document.getElementById("no-char-selected");
    const charRed = document.getElementById("charred");
    const charBlue = this.document.getElementById("charblue");
    const charVio = this.document.getElementById("charvio");
    let selectedChar = "";  //variable to pass selected character to game
    //DB variables
    let divisor = "";
    let numerator;
    let userDecimal;

    //canvas mode set to 2d
    const ctx = canvas.getContext("2d");

    //value needed to calculate delta time for frame rate delta time for frame rate
    let dt = 0;
    let prevTime = 0;


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
            this.speed = 3; //set initial game speed
            this.maxSpeed = 3;
            this.groundHeight = 72; //height of ground that player/obstacles needs to stand on top of
            this.scroll;
            this.userNum = inputBar.value;
            this.bg = new Background(this);
            this.player = new Player(this, "charB");
            this.input = new InputHandler(this);
            this.UI = new UI(this);
            this.pause = false;
            this.obstacles = []; //array to hold existing game obstacles
            this.particles = []; //array to hold particle effects
            this.spawnTimer = 0; //when timer reaches value in interval, spawn new obstacle
            this.spawnInterval = 1000; //initialize time to new obstacle to one second (measure in ms)
            this.testMode = false;   //set test mode to true; hitboxes will be visible
            this.gameTimer = 0;          //initialize game timer
            this.gameOver = false;
            this.intro = true;     //indicates whether or not game is in division intro
            this.introActive = true;    //toggle whether or not game shows division intro
            this.score = 0; //initialize game score
            this.fontColor = 'black';   //color for UI text
            this.player.currentState = this.player.states[0];
            this.player.currentState.enter();
        }
        update(dt) {
            if (!this.pause && !this.gameOver) {  //calls update function if game is not paused or game over
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
                //updating particle effects
                this.particles.forEach((particle, index) => {
                    particle.update();
                });
                //use filter method to remove particles and obstacles that are off screen to avoid image jitter
                this.particles = this.particles.filter(particle => !particle.offScreen);
                this.obstacles = this.obstacles.filter(obstacle => !obstacle.offScreen);
                }
        }
        draw(context) {
            this.bg.draw(context);
            this.player.draw(context);
            this.obstacles.forEach(obstacle => {
                obstacle.draw(context);
            });
            this.particles.forEach((particle) => {
                particle.draw(context);
            });
            this.UI.draw(context);
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
        togglePause() {       //pause menu will need to draw some things to the canvas on top of player and enemy and stuff, may need to look into a way to do that WITHOUT stopping requestAnimationFrame
            this.pause = !this.pause;   //sets whatever pause boolean is to the opposite
        }
        showInitMenu() {
            //hide game container
            gameContainer.classList.add("hide");

            //empty input bar and divisor variables in preparation for more input
            inputBar.value = "";
            divisor = "";

            //pull up game options window again, since it has the first call to animate() shouldn't need to put that in manually?
            optContainer.classList.remove("hide");
        }
        reset() {   //reset all game data
            this.gameTimer = 0;
            this.score = 0;
            this.obstacles = [];    //empty the obstacle array
            this.speed = 3;         //reset initial game speed
            this.spawnTimer = 0;
            this.spawnInterval = 1000; //reset spawn interval
            this.gameOver = false; //reset game over and pause to false only before game start
            this.pause = false;
        }
        restart() {     //function to restart game, should be able to be called either from game over screen or generally from a pause menu
            //call object reset functions
            this.player.reset();
            this.bg.reset();
            this.reset();
        }
    }

    const g = new Game(CANVAS_WIDTH, CANVAS_HEIGHT);
    //console.log(g);

    function animate(newTime) {
        if (!g.gameOver) {
            dt = newTime - prevTime;
            prevTime = newTime;
            ctx.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
            g.update(dt);
            g.draw(ctx);
            requestAnimationFrame(animate);
        }
    }

    //EVENT LISTENERS FOR CHARACTER SELECT
    charBlue.addEventListener("click", ()=> {
        selectedChar = "charB";
        charBlue.classList.add("selected");
        charRed.classList.remove("selected");
        charVio.classList.remove("selected");
        charMessage.classList.add("invisible");
    });

    charRed.addEventListener("click", () => {
        selectedChar = "charR";
        charRed.classList.add("selected");
        charBlue.classList.remove("selected");
        charVio.classList.remove("selected");
        charMessage.classList.add("invisible");
    });

    charVio.addEventListener("click", () => {
        selectedChar = "charV";
        charVio.classList.add("selected");
        charBlue.classList.remove("selected");
        charRed.classList.remove("selected");
        charMessage.classList.add("invisible");
    });

    //validate user input from button click
    startBtn.addEventListener("click", () => {
        if (selectedChar == "") {
            charMessage.classList.remove("invisible");
        }
        else if (inputBar.value < 1 || inputBar.value > 999999999 || inputBar.value == "") {
            //invalid input, reveals error messaging, will not allow game start
            numMessage.classList.remove("invisible");
            inputBar.classList.add("error");
        }
        else {
            //complete setup before hiding game start options and starting game
            g.scroll = new NumberString(g, inputBar.value, 1);  //sets scrolling number string
            g.player.character = selectedChar;  //sets player character

            numMessage.classList.add("invisible");
            charMessage.classList.add("invisible");
            inputBar.classList.remove("error");
            optContainer.classList.add("hide");
            gameContainer.classList.remove("hide");
            //call to math animation function here before game start (maybe include an option to turn it off)
            //put any and all prerequisites to game play BEFORE first call to animate() in an event listener (maybe also a start message)
                g.restart();
                animate(0);
        }
        //console.log(inputBar.value);

        //gets numbers for database entry
        while (divisor.length < inputBar.value.length) {
            divisor += "9";
        }
        //setting up user decimal
        userDecimal = inputBar.value + inputBar.value;

        //these might be an issue for the PHP because js is a nightmare :/
        divisor = Number(divisor);
        numerator = Number(inputBar.value);
        userDecimal = BigInt(userDecimal);
        
        console.log("user input: " + numerator);
        console.log("divisor: " + divisor);
        console.log("decimal: " + userDecimal);

    });
});
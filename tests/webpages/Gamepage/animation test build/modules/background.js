//breaking up bg into layers for parallaxing with finalized art assets
class Layer {
    constructor(game, width, height, speedModifier, image) {
        this.game = game;
        this.width = width;
        this.height = height;
        this.speedModifier = speedModifier;
        this.image = image;
        this.x = 0;
        this.y = this.game.height - (this.height * 4); //temporarily setting manually; for finalized art assets, RESET TO 0
    }
    update(){
        if (this.x < -this.width)
            this.x = 0;
        else
            this.x -= this.game.speed * this.speedModifier;
    }
    draw(context){
        //draw first image
        context.drawImage(this.image, this.x, this.y, this.width, this.height);
        //draw second image for seamless repeat
        context.drawImage(this.image, this.x + this.width, this.y, this.width, this.height);        
    }
}

export class NumberString {
    constructor(game, userNum, speedModifier) {
        //basic object attributes
        this.game = game;
        this.baseNum = userNum;
        this.speedModifier = speedModifier;
        this.x = 0;
        this.y = this.game.height - 20;
        this.numPrefix = "0.";
        this.scrollNum = "";
        this.scrollWidth;
        //fill a string with numbers to scroll across bottom of canvas area
        while (this.scrollNum.length < 25) {
            this.scrollNum += this.baseNum;
        }
        console.log(this.scrollNum);
    }
    draw(context) {
        //set font properties
        context.font = "68px Courier New";
        //draw font portions
        //draw numPrefix first
        //context.fillText(this.numPrefix, this.x, this.y);
        //draw scroll num
        //get prefix width
        //let pWidth = context.measureText(this.numPrefix).width;
        context.fillText(this.scrollNum, this.x, this.y);
        //get width of repeating digits
        this.scrollWidth = context.measureText(this.scrollNum).width;
        //draw second instance of digit string
        context.fillText(this.scrollNum, (this.x + this.scrollWidth), this.y);

    }
    update() {
        this.x -= this.game.speed * this.speedModifier;
        //when object scrolls off screen, remove it and/or reset its position
        if (this.x < 0 - this.scrollWidth) {
            this.x = 0;
            }
            console.log(this.scrollWidth);
        }
}

//class for input string scroll
    /*NOTE: anything that needs to be input or selected has to be done BEFORE first call to animate function*/
    // class NumberString{
    //     constructor(cnvWidth, cnvHeight) {
    //         //saves canvas width and height as object properties
    //         this.cnvWidth = cnvWidth;
    //         this.cnvHeight = cnvHeight;
    //         //setting up strings for number scroll
    //         this.numPrefix = "0.";
    //         this.scrollNum = "";
    //         //setting up width properties for scrolling
    //         this.prefixWidth = 0;
    //         this.scrollWidth = 0;
    //         this.totalWidth = 0;
    //         //x and y position for number string obj
    //         this.x = 0;
    //         //accounting for ground height and a bit of extra space
    //         this.y = cnvHeight-20;
    //         //speed for number string scroll
    //         this.speed = SPEED;
    //         this.firstScroll;
    //         //get repeating number string; validate that it's within bounds
    //         let num = prompt("Please enter your repeating digits.\nMust be between 1-9 digits.");
    //         while (num.length < 1 || num.length > 9) {
    //             num = prompt("Please enter your repeating digits.\nMust be between 1-9 digits.");
    //         }
    //         //fill scrollNum to hopefully fill canvas
    //         while (this.scrollNum.length < 30) {
    //             this.scrollNum += num;
    //         }
    //         //console.log(this.scrollNum);
    //     }
    //     draw(context) {
    //         //set font properties
    //         context.font = "68px Courier New";
    //         //draw the text
    //         //context.fillText(this.numPrefix + this.scrollNum, this.x, this.y);
    //         //set width property to draw second (and maybe third?) scroll text element
    //         //this.prefixWidth = ctx.measureText(this.numPrefix).width;
    //         //this.scrollWidth = ctx.measureText(this.scrollNum).width;
    //         //this.totalWidth = this.prefixWidth + this.scrollWidth;
    //         //console.log(this.prefixWidth);
    //         //console.log(this.scrollWidth);
    //         //draw second text element at the end previous element
    //         context.fillText(this.scrollNum, this.x, this.y);
    //         this.scrollWidth = context.measureText(this.scrollNum).width;
    //         context.fillText(this.scrollNum, (this.x + this.scrollWidth), this.y);
    //         //context.fillText(this.scrollNum, (this.x + this.totalWidth + this.scrollWidth), this.y)
    //     }
    //     update() {
    //         //moving text to the left for scrolling
    //         this.x -= this.speed;
    //         //resets string for endless scroll
    //         if (this.x < 0 - this.scrollWidth) {
    //             this.x = 0;
    //         }
    //     }
    // }

//for refactoring numstring class: probably wrap it up in along with layers in bg class?
//can try to fix the issue with the weird hitching at the same time
export class Background {
    constructor(game) {
        this.game = game;
        this.width = 2399;
        this.height = 24; //would want to make each layer image same height as base canvas height
        this.layer1image = document.getElementById("ground");    //this will match the id of an image layer in the HTML document later; they will have the class .gameImg as well
        this.layer1 = new Layer(this.game, this.width, this.height, 1, this.layer1image);
        this.backgroundLayers = [this.layer1]; //array to hold each layer of bg
    }
    update(){
        //call update method for each layer in bg layers array
        this.backgroundLayers.forEach(layer => {
            layer.update();
        });
        this.game.scroll.update();
    }
    draw(context){
        this.backgroundLayers.forEach(layer => {
            layer.draw(context);
        });
        this.game.scroll.draw(context);
    }
}
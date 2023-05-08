//breaking up bg into layers for parallaxing with finalized art assets
class Layer {
    constructor(game, width, height, speedModifier, image) {
        this.game = game;
        this.width = width;
        this.height = height;
        this.speedModifier = speedModifier;
        this.image = image;
        this.x = 0;
        this.y = 0;
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
        //console.log(this.scrollNum);
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
        //reset fill style to draw text in black
        context.fillStyle = 'black';
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
            this.x = 0 - this.game.speed;
            }
            //console.log(this.scrollWidth);
    }
}

//for refactoring numstring class: probably wrap it up in along with layers in bg class?
//can try to fix the issue with the weird hitching at the same time
export class Background {
    constructor(game) {
        this.game = game;
        this.width = 960;
        this.height = 540; //would want to make each layer image same height as base canvas height
        this.layer1image = document.getElementById("bgLayer1");    //this will match the id of an image layer in the HTML document later; they will have the class .gameImg as well
        this.layer2image = document.getElementById("bgLayer2");    //this will match the id of an image layer in the HTML document later; they will have the class .gameImg as well
        this.layer3image = document.getElementById("bgLayer3");    //this will match the id of an image layer in the HTML document later; they will have the class .gameImg as well
        this.layer4image = document.getElementById("bgLayer4");    //this will match the id of an image layer in the HTML document later; they will have the class .gameImg as well
        this.layer1 = new Layer(this.game, this.width, this.height, 0, this.layer1image);
        this.layer2 = new Layer(this.game, this.width, this.height, 0.4, this.layer2image);
        this.layer3 = new Layer(this.game, this.width, this.height, 0.4, this.layer3image);
        this.layer4 = new Layer(this.game, this.width, this.height + 10, 1, this.layer4image);
        this.backgroundLayers = [this.layer1, this.layer2, this.layer3, this.layer4]; //array to hold each layer of bg
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
    reset() {
        this.backgroundLayers.forEach(layer => {
            layer.x = 0;
        });
    }
}
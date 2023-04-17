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
    }
    draw(context){
        this.backgroundLayers.forEach(layer => {
            layer.draw(context);
        });
    }
}
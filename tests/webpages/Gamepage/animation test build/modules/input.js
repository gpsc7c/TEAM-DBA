//global values for keyboard controls
window.JUMP = 'ArrowUp';
window.DUCK = 'ArrowDown';
window.ATTACK = 'Enter';
window.PAUSE = ' ';

export class InputHandler {
    constructor() {
        
        //similar to pygame getpressed function; array tracks all keys currently pressed?
        this.keys = [];
        //keydown event to add key pressed into keys array
        window.addEventListener("keydown", e => {
            //select which keys to add to keys array (connected to constant key values above)
            if ((e.key === window.JUMP
              || e.key === window.DUCK
              || e.key === window.ATTACK
              || e.key === window.PAUSE)
             && this.keys.indexOf(e.key) === -1) { //if key is one of specified controls and is not in keys array
                //add key in matched variable to keys array
                this.keys.push(e.key);
            }
            console.log(e.key, this.keys);
        });
        //remove key pressed from keys array on keyup event
        window.addEventListener("keyup", e => {
            if ((e.key === window.JUMP
              || e.key === window.DUCK
              || e.key === window.ATTACK
              || e.key === window.PAUSE)) {
                //splice method to remove key released from keys array
                //splice(i, num) takes index i of element to be removed and how many elements to remove; i.e. splice(2, 3) would remove 3 elements starting at index 2
                this.keys.splice(this.keys.indexOf(e.key), 1);
            }
            console.log(e.key, this.keys);
        });
    }
}
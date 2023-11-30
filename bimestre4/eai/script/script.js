const cavaloSound = new Audio("./audio/cavalo.mp3");
const discordSound = new Audio("./audio/discord.mp3");
const elegostaSound = new Audio("./audio/ele-gosta.mp3");
const fnafscreamSound = new Audio("./audio/fnaf-scream.mp3");
const loucoesonhadorSound = new Audio("./audio/louco-e-sonhador.mp3");
const megalovaniaSound = new Audio("./audio/megalovania.mp3");
const queissomeufilhoSound = new Audio("./audio/que-isso-meu-filho.mp3");
const sansSound = new Audio("./audio/sans.mp3");
const teleportSound = new Audio("./audio/teleport.mp3");
const tomeSound = new Audio("./audio/tome.mp3");
const uepaSound = new Audio("./audio/uepa.mp3");

sounds = [cavaloSound, discordSound, elegostaSound, fnafscreamSound, loucoesonhadorSound, megalovaniaSound, queissomeufilhoSound, sansSound, teleportSound, tomeSound, uepaSound];

function playSound() {
    let audioIndex = Math.floor(Math.random() * 1000) % sounds.length;
    let audioId = sounds[audioIndex];
    audioId.play();
}
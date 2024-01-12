function randomColors(count){
    var colors = [];
    for(i =0; i < count; i++){
        colors.push(randomColor());
    }
    return colors;
}

function randomColor(){
    let hex = ['0', '1','2','3','4','5','6','7','8','9','A','B','C','D','E','F'];
    var color = '#';
    for(j = 0; j < 6; j++){
        color += hex[Math.floor(Math.random()*16)];
    }
    return color;
}
function sexSelector()
{
    const selector = document.getElementById("sex_selector");
    document.getElementById("render-image").style.display = 'flex';
    console.log(selector.value)

    switch(selector.value){
        case 'M':
            document.getElementById("F-1").style.display = 'none';
            document.getElementById("F-2").style.display = 'none';
            document.getElementById("M-1").style.display = 'block';
            document.getElementById("M-2").style.display = 'block';
        break;
        case 'F':
            document.getElementById("F-1").style.display = 'block';
            document.getElementById("F-2").style.display = 'block';
            document.getElementById("M-1").style.display = 'none';
            document.getElementById("M-2").style.display = 'none';
        break;
    }
}   

function beLoad(){
    document.getElementById("render-image").style.display = 'none';
}
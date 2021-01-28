let x;
function showSuggestion(value){
    if(value.length == 0){
        document.getElementById('suggest').innerHTML = '';
    }else{
        //ajax request
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState === 4 && this.status === 200){
                document.getElementById('suggest').innerHTML = this.responseText;
            }
        }

        xml.open("GET", "names.php?q=" + value, true);
        xml.send();
    }
}
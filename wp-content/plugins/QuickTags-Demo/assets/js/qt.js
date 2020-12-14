QTags.addButton('qtsd-button-one','U','<u>','</u>'); 
QTags.addButton('qtsd-button-one','JS',qtsd_button_one); 
function qtsd_button_one(){
    let name = prompt('What is your?');
    let text = "Hello" + name;
    QTags.insertContent(text);
}
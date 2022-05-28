function triggerClick(e) {
  document.querySelector('#sec1').click();
}

function triggerClick2(e) {
  document.querySelector('#sec2').click();
}

function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
function displayImage2(e) {
  if (e.files[0]) {
    var reader2 = new FileReader();
    reader2.onload = function(e){
      document.querySelector('#profileDisplay2').setAttribute('src2', e.target.result);
    }
    reader2.readAsDataURL(e.files[0]);
  }
}
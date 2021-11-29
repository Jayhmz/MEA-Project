
  const dlink = document.getElementById("del");

  dlink.addEventListener('click', function (e) {
    var del = confirm('are you sure to delete?');
    if (del) {
      console.log('deleted');
    }else{
      e.preventDefault();
    }
  });


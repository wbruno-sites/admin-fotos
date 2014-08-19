(function(){
  'use strict';
  var $lis = document.querySelectorAll(".images-list li");
  $lis = [].slice.call($lis);

  $lis.forEach(function($li){
    $li.addEventListener("click", function(event){
      var img = $li.getAttribute('data-img').replace('../../', '/');

      XHR.post('/admin/controller/delete-img.php', 'image=' + img, function(data){
        $li.parentNode.removeChild($li);
      })
    });
  });
}());

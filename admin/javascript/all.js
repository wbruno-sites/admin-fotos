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

(function(){
  'use strict';
  var $dels = document.querySelectorAll(".del-model");

  $dels = [].slice.call($dels);

  $dels.forEach(function($del){
    $del.addEventListener("click", function(event){
      event.preventDefault();
      var id = $del.parentNode.getAttribute('data-id'),
          model = $del.parentNode.getAttribute('data-model');

      XHR.post('/admin/controller/delete.php', 'id=' + id + '&model=' + model, function(data){
        console.log(data);
        var $tr = $del.parentNode.parentNode;
        $tr.parentNode.removeChild($tr);
      })
    });
  });
}());

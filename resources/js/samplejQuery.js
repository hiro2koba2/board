// test_jquery.js
$(function () {

  // ajaxでのいいね
  $('#like').on('click', function() {
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ action('LikeController@like', $post->id)}}",
      type: 'POST',
      data: {}
    })

    .done(function(){

    })

    .fail(function(){

    })
  });

  // ajaxでのいいね消去
  $('#unlike').on('click', function() {
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "{{ action('LikeController@unlike', $post->id, $like->id) }}",
      type: 'POST',
      data: {'_method': 'DELETE'}
    })

    .done(function(){

    })

    .fail(function(){

    })
  });
});

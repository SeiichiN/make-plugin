'use strict';

$(function () {
  $('#start').on('click', function() {
    $('#area').css('display', 'block');
    $('#start').css('display', 'none');
  });

  $('#close').on('click', function() {
    $('#area').css('display', 'none');
    $('#start').css('display', 'block');
  });
});

/* 修正時刻: Sun Oct 31 09:54:18 2021*/

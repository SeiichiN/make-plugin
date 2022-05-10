'use strict';

jQuery(function () {
  jQuery('#start').on('click', function() {
    jQuery('#area').css('display', 'block');
    jQuery('#start').css('display', 'none');
  });

  jQuery('#close').on('click', function() {
    jQuery('#area').css('display', 'none');
    jQuery('#start').css('display', 'block');
  });
});

/* 修正時刻: Mon Nov 15 07:45:05 2021*/
